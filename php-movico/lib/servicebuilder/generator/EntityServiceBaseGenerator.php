<?php
class EntityServiceBaseGenerator {

	public function generate(Entity $entity) {
		$className = "{$entity->getName()}ServiceBase";
		$content = "<?php\nclass $className {\n\n";
		foreach($entity->getFinders() as $finder) {
			$content .= $this->generateFinder($finder->getMethodSignature());
		}
		$content .= $this->generateBaseServices($entity);
		foreach(Singleton::create("ServiceBuilder")->getOneToManyMappedProperties($entity) as $property) {
			$content .= $this->generateFinder($property->getFinderSignature());
		}
		foreach(Singleton::create("ServiceBuilder")->getManyToManyMappedProperties($entity) as $property) {
			$content .= $this->generateFinder($property->getFinderSignature());
		}
		foreach($entity->getManyToManyProperties() as $property) {
			$content .= $this->generateManyToManySetter($property);
		}
		$content .= "}\n?>";
		// Write file to class
		$destination = "src/service/service/$className.php";
		FileUtil::storeFileContents($destination, $content);
	}

	private function generateManyToManySetter(ManyToManyProperty $property) {
		$containerProp = $property->getEntity()->getPrimaryKey()->getName();
		$containedProp = Singleton::create("ServiceBuilder")->getEntity($property->getEntityName())->getPrimaryKey()->getName();
		$signature = "set".ucfirst($property->getName())."(\$$containerProp, \${$containedProp}s)";
		return "\tpublic function $signature {\n\t\t\$this->getPersistence()->$signature;\n\t}\n\n";
	}
	
	private function generateBaseServices(Entity $entity) {
		$name = $entity->getName();
		return "\tpublic function create$name(\$pk=0) {\n".
			"\t\treturn \$this->getPersistence()->create(\$pk);\n".
			"\t}\n\n".
			"\tpublic function get$name(\$pk) {\n".
			"\t\treturn \$this->getPersistence()->findByPrimaryKey(\$pk);\n".
			"\t}\n\n".
			"\tpublic function update$name($name \$object) {\n".
			"\t\treturn \$this->getPersistence()->update(\$object);\n".
			"\t}\n\n".
			"\tpublic function delete$name(\$pk) {\n".
			"\t\t\$this->getPersistence()->remove(\$pk);\n".
			"\t}\n\n".
			"\tpublic function get{$name}s(\$from=0, \$limit=9999999999) {\n".
			"\t\treturn \$this->getPersistence()->findAll(\$from, \$limit);\n".
			"\t}\n\n".
			"\tpublic function count{$name}s() {\n".
			"\t\treturn \$this->getPersistence()->count();\n".
			"\t}\n\n".
			"\tprivate function getPersistence() {\n".
			"\t\treturn Singleton::create(\"{$name}Persistence\");\n".
			"\t}\n\n";
	}
	
	private function generateFinder($signature) {
		return "\tpublic function $signature {\n\t\treturn \$this->getPersistence()->".str_replace("=-1", "", $signature).";\n\t}\n\n";
	}

}
?>
