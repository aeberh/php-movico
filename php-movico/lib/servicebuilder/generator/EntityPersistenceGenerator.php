<?php
class EntityPersistenceGenerator {

	public function generate(Entity $entity) {
		$className = "{$entity->getName()}Persistence";
		$content = "<?php\nclass $className extends Persistence {\n\n".
			"\tconst TABLE = \"{$entity->getTable()}\";\n\n";
		foreach($entity->getFinders() as $finder) {
			$content .= $this->generateFinder($finder, $entity);
			$content .= $this->generateDeleteBy($finder, $entity);
		}
		$content .= $this->generateFindByPrimaryKey($entity);
		$content .= $this->generateCreate($entity);
		$content .= $this->generateRemove($entity);
		$content .= $this->generateUpdate($entity);
		$content .= $this->generateFindAll($entity);
		$content .= $this->generateGetCount($entity);
		$content .= $this->generateGetAsObject($entity);
		foreach(Singleton::create("ServiceBuilder")->getOneToManyMappedProperties($entity) as $property) {
			$content .= $this->generateOneToManyFinder($property);
		}
		foreach(Singleton::create("ServiceBuilder")->getManyToManyMappedProperties($entity) as $property) {
			$content .= $this->generateManyToManyFinder($property);
		}
		foreach($entity->getManyToManyProperties() as $property) {
			$content .= $this->generateManyToManySetter($property);
		}
		$content .= "}\n?>";
		$destination = "src/service/persistence/$className.php";
		FileUtil::storeFileContents($destination, $content);
	}
	
	private function generateManyToManySetter(ManyToManyProperty $property) {
		$containerProp = $property->getEntity()->getPrimaryKey()->getName();
		$containedProp = Singleton::create("ServiceBuilder")->getEntity($property->getEntityName())->getPrimaryKey()->getName();
		return "\tpublic function set".ucfirst($property->getName())."(\$$containerProp, \${$containedProp}s) {\n".
			"\t\t\$this->db->updateQuery(\"DELETE FROM ".$property->getMappingTable()." WHERE $containerProp='\$$containerProp'\");\n".
			"\t\tif(empty(\${$containedProp}s)) {\n".
			"\t\t\treturn;\n".
			"\t\t}\n".
			"\t\t\$insertValues = array();\n".
			"\t\tforeach(\${$containedProp}s as \${$containedProp}) {\n".
			"\t\t\t\$insertValues[] = \"('\$$containerProp', '\$$containedProp')\";\n".
			"\t\t}\n".
			"\t\t\$this->db->updateQuery(\"INSERT INTO ".$property->getMappingTable()." ($containerProp, $containedProp) VALUES ".
				"\".implode(\", \", \$insertValues));\n\t}\n\n";
	}
	
	private function generateManyToManyFinder(ManyToManyProperty $property) {
		$columnName = $property->getMappingKey();
		$pkName = $property->getEntity()->getPrimaryKey()->getName();
		$mappedPkName = Singleton::create("ServiceBuilder")->getEntity($property->getEntityName())->getPrimaryKey()->getName();
		return "\tpublic function {$property->getFinderSignature()} {\n".
			"\t\t\$rows = \$this->db->selectQuery(\"SELECT t.* FROM ".$property->getMappingTable()." mapping,\".self::TABLE.\" t WHERE mapping.$columnName='\$$columnName' ".
				"AND mapping.$mappedPkName=t.$mappedPkName LIMIT \$from,\$limit\")->getResult();\n".
			"\t\treturn \$this->getAsObjects(\$rows);\n\t}\n\n";
	}
	
	private function generateOneToManyFinder(OneToManyProperty $property) {
		$columnName = $property->getMappingKey();
		return "\tpublic function {$property->getFinderSignature()} {\n".
			"\t\t\$limitStr = (\$from == -1 && \$limit == -1) ? \"\" : \" LIMIT \$from,\$limit\";\n".
			"\t\t\$rows = \$this->db->selectQuery(\"SELECT * FROM \".self::TABLE.\" WHERE $columnName='\$$columnName' {$property->getEntity()->getOrderByClause()}\$limitStr\")->getResult();\n".
			"\t\treturn \$this->getAsObjects(\$rows);\n\t}\n\n";
	}
	
	private function generateGetCount(Entity $entity) {
		return "\tpublic function count() {\n".
			"\t\tif(parent::\$dbCache->hasAll('{$entity->getName()}', -1, -1)) {\n".
			"\t\t\treturn count(parent::\$dbCache->getAll('{$entity->getName()}', -1, -1));\n".
			"\t\t}\n".
			"\t\treturn \$this->db->selectQuery(\"SELECT COUNT(*) FROM \".self::TABLE)->getSingleton();\n".
			"\t}\n\n";
	}
	
	private function generateFinder(Finder $finder, Entity $entity) {
		$orderByClause = $finder->hasOrder() ? $finder->getOrderByClause() : $entity->getOrderByClause();
		$result = "\tpublic function {$finder->getMethodSignature()} {\n".
			"\t\t\$limitStr = (\$from == -1 && \$limit == -1) ? \"\" : \" LIMIT \$from,\$limit\";\n".
			"\t\t\$whereClause = \"".implode(" AND ",$finder->getWhereClauses()).$orderByClause."\".\$limitStr;\n";
		if($finder->isCacheable()) {
			$result .= "\t\tif(parent::\$dbCache->hasFinder('{$entity->getName()}', \$whereClause)) {\n".
				"\t\t\treturn parent::\$dbCache->getFinder('{$entity->getName()}', \$whereClause);\n".
				"\t\t}\n";
		}
		$result .= "\t\t\$result = \$this->db->selectQuery(\"SELECT * FROM \".self::TABLE.\" WHERE \$whereClause\");\n";
		if($finder->isUnique()) {
			$result .= "\t\tif(\$result->isEmpty()) {\n".
				"\t\t\tthrow new NoSuch{$entity->getName()}Exception();\n".
				"\t\t}\n".
				"\t\t\$result = \$this->getAsObject(\$result->getSingleRow());\n";
		} else {
			$result .= "\t\t\$result = \$this->getAsObjects(\$result->getResult());\n";
		}
		if($finder->isCacheable()) {
			$result .= "\t\tparent::\$dbCache->setFinder('{$entity->getName()}', \$whereClause, \$result);\n";
		}
		return $result."\t\treturn \$result;\n\t}\n\n";
	}
	
	private function generateDeleteBy(Finder $finder, Entity $entity) {
		$result = "\tpublic function {$finder->getDeleteByMethodSignature()} {\n".
			"\t\t\$whereClause = \"".implode(" AND ",$finder->getWhereClauses())."\";\n";
		$result .= "\t\t\$this->db->updateQuery(\"DELETE FROM \".self::TABLE.\" WHERE \$whereClause\");\n".
			"\t\tparent::\$dbCache->resetEntity(\"{$entity->getName()}\");\n\t}\n\n";
		return $result;
	}
	
	private function generateFindByPrimaryKey(Entity $entity) {
		$pk = $entity->getPrimaryKey()->getName();
		$name = $entity->getName();
		return "\tpublic function findByPrimaryKey(\$$pk) {\n".
			"\t\tif(parent::\$dbCache->hasSingle(\"{$entity->getName()}\", \$$pk)) {\n".
			"\t\t\treturn parent::\$dbCache->getSingle(\"{$entity->getName()}\", \$$pk);\n".
			"\t\t}\n".
			"\t\t\$result = \$this->db->selectQuery(\"SELECT * FROM \".self::TABLE.\" WHERE $pk='\".addslashes(\$$pk).\"'\");\n".
			"\t\tif(\$result->isEmpty()) {\n\t\t\tthrow new NoSuch{$name}Exception(\$$pk);\n\t\t}\n".
			"\t\t\$result = \$this->getAsObject(\$result->getSingleRow());\n".
			"\t\tparent::\$dbCache->setSingle(\"{$entity->getName()}\", \$$pk, \$result);\n".
			"\t\treturn \$result;\n".
			"\t}\n\n";
	}

	private function generateFindAll(Entity $entity) {
		return "\tpublic function findAll(\$from, \$limit) {\n".
			"\t\tif(parent::\$dbCache->hasAll('{$entity->getName()}', \$from, \$limit)) {\n".
			"\t\t\treturn parent::\$dbCache->getAll('{$entity->getName()}', \$from, \$limit);\n".
			"\t\t}\n".
			"\t\t\$rows = \$this->db->selectQuery(\"SELECT * FROM \".self::TABLE.\" {$entity->getOrderByClause()} LIMIT \$from,\$limit\")->getResult();\n".
			"\t\t\$objects = \$this->getAsObjects(\$rows);\n".
			"\t\tparent::\$dbCache->setAll('{$entity->getName()}', \$objects, \$from, \$limit);\n".
			"\t\treturn \$objects;\n".
			"\t}\n\n";
	}

	private function generateGetAsObject(Entity $entity) {
		$result = "\tprotected function getAsObject(\$row) {\n".
			"\t\t\$result = new {$entity->getName()}();\n".
			"\t\t\$result->setNew(false);\n";
		foreach($entity->getAllProperties() as $prop) {
			$propName = $prop->getName();
			$result .= "\t\t\$result->set".ucfirst($propName)."(Singleton::create(\"{$prop->getConverter()}\")->fromDBtoDOM(\$row[\"".$propName."\"]));\n";
		}
		foreach(Singleton::create("ServiceBuilder")->getOneToManyMappedProperties($entity) as $prop) {
			$propName = $prop->getMappingKey();
			$result .= "\t\t\$result->set".ucfirst($propName)."(Singleton::create(\"{$prop->getConverter()}\")->fromDBtoDOM(\$row[\"".$propName."\"]));\n";
		}
		return $result."\t\treturn \$result;\n\t}\n\n";
	}

	private function generateCreate(Entity $entity) {
		$pk = $entity->getPrimaryKey()->getName();
		$setPk = "set".ucfirst($pk);
		return "\tpublic function create(\$$pk) {\n".
			"\t\t\$obj = new {$entity->getName()}();\n".
			"\t\t\$obj->$setPk(\$$pk);\n".
			"\t\t\$obj->setNew(true);\n".
			"\t\treturn \$obj;\n\t}\n\n";
	}

	private function generateUpdate(Entity $entity) {
		$pk = $entity->getPrimaryKey();
		$result = "\tpublic function update({$entity->getName()} \$object) {\n";
		$updatePairs = $entity->getPropertyUpdatePairs("object");
		$propNames = $entity->getPropertyNames(false);
		$propGetters = $entity->getPropertyGetters("object", false);
		$allPropNames = $entity->getPropertyNames(true);
		$allPropGetters = $entity->getPropertyGetters("object", true);
		
		$result .= "\t\t\$q = \"UPDATE \".self::TABLE.\" SET ".implode(", ", $updatePairs)." WHERE {$pk->getName()}='\".addslashes(\$object->{$pk->getGetter()}).\"'\";\n".
			"\t\t\$pk = \$object->{$pk->getGetter()};\n".
			"\t\tif(\$object->isNew()) {\n".
			"\t\t\tif(empty(\$pk)) {\n".
			"\t\t\t\t\$q = \"INSERT INTO \".self::TABLE.\" (".implode(", ", $propNames).") VALUES ('".implode("', '", $propGetters)."')\";\n".
			"\t\t\t} else {\n".
			"\t\t\t\t\$q = \"INSERT INTO \".self::TABLE.\" (".implode(", ", $allPropNames).") VALUES ('".implode("', '", $allPropGetters)."')\";\n".
			"\t\t\t}\n".
			"\t\t}\n".
			"\t\t\$this->db->updateQuery(\$q);\n".
			"\t\tif(empty(\$pk)) {\n".
			"\t\t\t\$pk = \$this->db->selectQuery(\"SELECT {$pk->getName()} from \".self::TABLE.\" ORDER BY {$pk->getName()} DESC limit 1\")->getSingleton();\n".
			"\t\t}\n".
			"\t\t\$result = \$this->findByPrimaryKey(\$pk);\n".
			"\t\tparent::\$dbCache->resetEntity(\"{$entity->getName()}\");\n".
			"\t\tparent::\$dbCache->setSingle(\"{$entity->getName()}\", \$pk, \$result);\n".
			"\t\treturn \$result;\n".
			"\t}\n\n";
		return $result;
	}

	private function generateRemove(Entity $entity) {
		$pk = $entity->getPrimaryKey()->getName();
		return "\tpublic function remove(\$$pk) {\n".
			"\t\t\$this->findByPrimaryKey(\$$pk);\n".
			"\t\t\$this->db->updateQuery(\"DELETE FROM \".self::TABLE.\" WHERE $pk='\".addslashes(\$$pk).\"'\");\n".
			"\t\tparent::\$dbCache->resetEntity('{$entity->getName()}');\n".
			"\t\tparent::\$dbCache->resetSingle(\"{$entity->getName()}\", \$$pk);\n".
			"\t}\n\n";
	}

}
?>
