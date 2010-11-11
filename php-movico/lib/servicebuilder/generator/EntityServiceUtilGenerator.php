<?php
class EntityServiceUtilGenerator {

	public function generate(Entity $entity) {
		$className = "{$entity->getName()}ServiceUtil";
		$content = "<?php\nclass $className {\n\n";
		$content .= $this->generateCustomServices($entity);
		foreach($entity->getFinders() as $finder) {
			$content .= $this->generateFinder($finder);
		}
		foreach(Singleton::create("ServiceBuilder")->getOneToManyMappedProperties($entity) as $property) {
			$content .= $this->generateOneToManyService($property);
		}
		$content .= $this->generateBaseServices($entity);
		$content .= "}\n?>";
		// Write file to class
		$destination = "src/service/service/$className.php";
		FileUtil::storeFileContents($destination, $content);
	}
	
	private function generateOneToManyService(OneToManyProperty $property) {
		return "\tpublic static function {$property->getFinderSignature()} {\n".
			"\t\treturn self::getService()->{$property->getFinderSignature()};\n".
			"\t}\n\n";
	}

	private function generateBaseServices(Entity $entity) {
		$name = $entity->getName();
		return "\tpublic static function create$name(\$pk=0) {\n".
			"\t\treturn self::getService()->create$name(\$pk);\n".
			"\t}\n\n".
			"\tpublic static function get$name(\$pk) {\n".
			"\t\treturn self::getService()->get$name(\$pk);\n".
			"\t}\n\n".
			"\tpublic static function update$name($name \$object) {\n".
			"\t\treturn self::getService()->update$name(\$object);\n".
			"\t}\n\n".
			"\tpublic static function delete$name(\$pk) {\n".
			"\t\tself::getService()->delete$name(\$pk);\n".
			"\t}\n\n".
			"\tpublic static function get{$name}s() {\n".
			"\t\treturn self::getService()->get{$name}s();\n".
			"\t}\n\n".
			"\tpublic static function count{$name}s() {\n".
			"\t\treturn self::getService()->count{$name}s();\n".
			"\t}\n\n".
			"\tprivate static function getService() {\n".
			"\t\treturn Singleton::create(\"{$name}Service\");\n".
			"\t}\n\n";
	}
	
	private function generateCustomServices(Entity $entity) {
		$result = "";
		$methods = ReflectionUtil::getSubclassMethods($entity->getName()."Service");
		foreach($methods as $method) {
			if(!$method->isPublic()) {
				continue;
			}
			$name = $method->name;
			$paramNames = array();
			foreach($method->getParameters() as $param) {
				$paramNames[] = "\$".$param->name;
			}
			$skeleton = $name."(".implode(", ", $paramNames).")";
			$result .= "\tpublic static function $skeleton {\n".
				"\t\treturn self::getService()->$skeleton;\n".
				"\t}\n\n";
		}
		return $result;
	}
	
	private function generateFinder(Finder $finder) {
		return "\tpublic static function {$finder->getMethodSignature()} {\n".
			"\t\treturn self::getService()->{$finder->getMethodSignature()};\n".
			"\t}\n\n";
	}

}
?>
