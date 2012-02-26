<?php
class EntityModelGenerator {

	public function generate(Entity $entity) {
		$className = "{$entity->getName()}Model";
		$content = "<?php\nabstract class $className extends Model {\n\n";
		$content .= $this->gettersAndSetters($entity);
		$content .= $this->getOneToManyGetters($entity);
		$content .= $this->getOneToManyMappedGettersSetters($entity);
		$content .= $this->getManyToManyGetters($entity);
		$content .= "}\n?>";
		// Write file to class
		$destination = "src/service/model/{$className}.php";
		FileUtil::storeFileContents($destination, $content);
	}
	
	private function gettersAndSetters(Entity $entity) {
		$result = "";
		foreach($entity->getAllProperties() as $property) {
			$name = $property->getName();
			$result .= "\tprotected \${$name};\n\n".
				"\tpublic function ".$property->getGetter()." {\n\t\treturn \$this->{$name};\n\t}\n\n".
				"\tpublic function set".ucfirst($name)."(\${$name}) {\n\t\t\$this->{$name} = \${$name};\n\t}\n\n";
		}
		return $result;
	}
	
	private function getManyToManyGetters(Entity $entity) {
		$result = "";
		foreach($entity->getManyToManyProperties() as $property) {
			$mappedEntity = $property->getEntityName();
			$functionName = $property->getFinderSignature(true);
			$result .= "\tpublic function get".ucfirst($property->getName())."(\$from=0, \$limit=9999999999) {\n".
				"\t\treturn {$mappedEntity}ServiceUtil::$functionName;\n\t}\n\n";
		}
		return $result;
	}
	
	private function getOneToManyGetters(Entity $entity) {
		$result = "";
		foreach($entity->getOneToManyProperties() as $property) {
			$mappedEntity = $property->getEntityName();
			$functionName = $property->getFinderSignature(true);
			$result .= "\tpublic function get".ucfirst($property->getName())."(\$from=0, \$limit=9999999999) {\n".
				"\t\treturn {$mappedEntity}ServiceUtil::$functionName;\n\t}\n\n";
		}
		return $result;
	}
	
	private function getOneToOneGetters(Entity $entity) {
		$result = "";
		foreach($entity->getOneToOneProperties() as $property) {
			$name = $property->getName();
			$mappedEntity = $property->getEntityName();
			$functionName = $property->getFinderSignature(true);
			$result .= "\tpublic function get".ucfirst($name)."() {\n".
				"\t\treturn {$mappedEntity}ServiceUtil::get{$mappedEntity}(\$this->$name);\n\t}\n\n";
		}
		return $result;
	}
	
	private function getOneToManyMappedGettersSetters(Entity $entity) {
		$result = "";
		foreach(Singleton::create("ServiceBuilder")->getOneToManyMappedProperties($entity) as $property) {
			$entityName = $property->getEntity()->getName();
			$name = $property->getMappingKey();
			$result .= "\tprivate \${$name};\n\n".
				"\tpublic function get".ucfirst($name)."() {\n\t\treturn \$this->{$name};\n\t}\n\n".
				"\tpublic function get".$entityName."() {\n\t\treturn ${entityName}ServiceUtil::get${entityName}(\$this->${name});\n\t}\n\n".
				"\tpublic function set".ucfirst($name)."(\${$name}) {\n\t\t\$this->{$name} = \${$name};\n\t}\n\n";
		}
		return $result;
	}

}
?>
