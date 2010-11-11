<?php
class EntityServiceBaseGenerator {

	public function generate(Entity $entity) {
		$className = "{$entity->getName()}ServiceBase";
		$content = "<?php\nclass $className {\n\n";
		foreach($entity->getFinders() as $finder) {
			$content .= $this->generateFinder($finder);
		}
		$content .= $this->generateBaseServices($entity);
		foreach(Singleton::create("ServiceBuilder")->getOneToManyMappedProperties($entity) as $property) {
			$content .= $this->generateOneToManyService($property);
		}
		$content .= "}\n?>";
		// Write file to class
		$destination = "src/service/service/$className.php";
		FileUtil::storeFileContents($destination, $content);
	}
	
	private function generateOneToManyService(OneToManyProperty $property) {
		$columnName = $property->getMappingKey();
		return "\tpublic function {$property->getFinderSignature()} {\n".
			"\t\treturn \$this->getPersistence()->{$property->getFinderSignature()};\n\t}\n\n";
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
			"\tpublic function get{$name}s() {\n".
			"\t\treturn \$this->getPersistence()->findAll();\n".
			"\t}\n\n".
			"\tpublic function count{$name}s() {\n".
			"\t\treturn \$this->getPersistence()->count();\n".
			"\t}\n\n".
			"\tprivate function getPersistence() {\n".
			"\t\treturn Singleton::create(\"{$name}Persistence\");\n".
			"\t}\n\n";
	}
	
	private function generateFinder(Finder $finder) {
		return "\tpublic function {$finder->getMethodSignature()} {\n".
			"\t\treturn \$this->getPersistence()->{$finder->getMethodSignature()};\n".
			"\t}\n\n";
	}

}
?>
