<?php
class EntityServiceUtilGenerator {

	public function generate(Entity $entity) {
		$className = "{$entity->getName()}ServiceUtil";
		$content = "<?php\nclass $className {\n\n";
		$content .= $this->generateCustomServices($entity);
		foreach($entity->getFinders() as $finder) {
			$content .= $this->generateFinder($finder->getMethodSignature());
		}
		foreach(Singleton::create("ServiceBuilder")->getOneToManyMappedProperties($entity) as $property) {
			$content .= $this->generateFinder($property->getFinderSignature());
		}
		foreach(Singleton::create("ServiceBuilder")->getManyToManyMappedProperties($entity) as $property) {
			$content .= $this->generateFinder($property->getFinderSignature());
		}
		foreach($entity->getManyToManyProperties() as $property) {
			$content .= $this->generateManyToManySetter($property);
		}
		$content .= $this->generateBaseServices($entity);
		$content .= "}\n?>";
		// Write file to class
		$destination = "src/service/service/$className.php";
		FileUtil::storeFileContents($destination, $content);
	}
	
	private function generateManyToManySetter(ManyToManyProperty $property) {
		$containerProp = $property->getEntity()->getPrimaryKey()->getName();
		$containedProp = Singleton::create("ServiceBuilder")->getEntity($property->getEntityName())->getPrimaryKey()->getName();
		$signature = "set".ucfirst($property->getName())."(\$$containerProp, \${$containedProp}s)";
		return "\tpublic static function $signature {\n\t\tself::getService()->$signature;\n\t}\n\n";
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
	
	private function generateFinder($signature) {
		return "\tpublic static function $signature {\n".
			"\t\treturn self::getService()->$signature;\n".
			"\t}\n\n";
	}

}
?>
