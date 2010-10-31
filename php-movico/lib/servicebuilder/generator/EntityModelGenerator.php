<?php
class EntityModelGenerator {

	public function generate(Entity $entity) {
		$className = "{$entity->getName()}Model";
		$content = "<?php\nabstract class $className extends Model {\n\n";
		$content .= $this->gettersAndSetters($entity);
		$content .= $this->getOneToManyGetters($entity);
		$content .= "}\n?>";
		// Write file to class
		$destination = "src/service/model/{$className}.php";
		FileUtil::storeFileContents($destination, $content);
	}
	
	private function gettersAndSetters(Entity $entity) {
		$result = "";
		foreach($entity->getAllProperties() as $property) {
			$name = $property->getName();
			$result .= "\tprivate \${$name};\n\n".
				"\tpublic function ".$property->getGetter()." {\n\t\treturn \$this->{$name};\n\t}\n\n".
				"\tpublic function set".ucfirst($name)."(\${$name}) {\n\t\t\$this->{$name} = \${$name};\n\t}\n\n";
		}
		return $result;
	}
	
	private function getOneToManyGetters(Entity $entity) {
		$result = "";
		foreach($entity->getOneToManyProperties() as $property) {
			$mappedEntity = $property->getEntityName();
			$mappingKey = $property->getMappingKey();
			$functionName = "get".ucfirst($property->getName());
			$result .= "\tpublic function $functionName() {\n".
				"\t\treturn {$mappedEntity}ServiceUtil::$functionName(\$this->{$mappingKey});\n\t}\n\n";
		}
		return $result;
	}

}
?>
