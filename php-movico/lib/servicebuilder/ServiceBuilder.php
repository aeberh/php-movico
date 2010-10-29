<?php
class ServiceBuilder {

	private $entities;

	public function __construct() {
		PrintUtil::log("Importing entities... ");
		$this->importEntities();
		PrintUtil::logln("Entities imported.");
	}
	
	public function buildServices() {
		Singleton::create("SqlGenerator")->generate($this->entities);
		foreach ($this->entities as $entity) {
			Singleton::create("EntityGenerator")->generate($entity);
			Singleton::create("EntityModelGenerator")->generate($entity);
			Singleton::create("EntityServiceGenerator")->generate($entity);
			Singleton::create("EntityServiceBaseGenerator")->generate($entity);
			Singleton::create("EntityServiceUtilGenerator")->generate($entity);
			Singleton::create("EntityPersistenceGenerator")->generate($entity);
			Singleton::create("ExceptionGenerator")->generate($entity);
		}
	}

	private function importEntities() {
		$dom = new DOMDocument();
		$dom->load("config/service.xml");
		$sbEl = $dom->getElementsByTagName("service-builder")->item(0);
		$entityEls = $sbEl->getElementsByTagName("entity");

		$this->entities = array();
		foreach($entityEls as $entityEl) {
			$name = $entityEl->getAttribute("name");
			$table = $entityEl->getAttribute("table");
			$entity = new Entity($name, $table);

			// Insert properties
			foreach($entityEl->getElementsByTagName("column") as $property) {
				$propertyName = $property->getAttribute("name");
				$type = $property->getAttribute("type");
				$size = $property->getAttribute("size");
				$primary = $property->getAttribute("primary")=="true";
				$autoIncrement = $property->getAttribute("auto-increment")=="true";
				$entity->addProperty(new Property($propertyName, $type, $size), $primary, $autoIncrement);
			}

			// Insert finders
			foreach($entityEl->getElementsByTagName("finder") as $finderEl) {
				$finderName = $finderEl->getAttribute("name");
				$returnType = $finderEl->getAttribute("unique");
				$unique = $returnType == "true";
				$finder = new Finder($finderName, $unique);
				foreach($finderEl->getElementsByTagName("finder-column") as $fcEl) {
					$name = $fcEl->getAttribute("name");
					$comparator = $fcEl->getAttribute("comparator");
					if(empty($comparator)) {
						$comparator = "=";
					}
					$finder->addFinderColumn(new FinderColumn($name, $comparator));
				}
				$entity->addFinder($finder);
			}

			// Insert order
			$orderEls = $entityEl->getElementsByTagName("order");
			if($orderEls->length > 1) {
				throw new ServiceBuilderException("Multiple order elements defined for entity {$entity->getName()}");
			}
			if($orderEls->length == 1) {
				$orderEl = $orderEls->item(0);
				foreach($orderEl->getElementsByTagName("order-column") as $ocEl) {
					$ocName = $ocEl->getAttribute("name");
					$ocOrderBy = $ocEl->getAttribute("order-by");
					$entity->addOrderCol(new OrderColumn($ocName, $ocOrderBy));
				}
			}
			
			$entity->validate();
			
			// Add entity
			$this->entities[$entity->getName()] = $entity;
		}
	}

}
?>
