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
	
	public function getOneToManyMappedProperties(Entity $forEntity) {
		$result = array();
		foreach($this->entities as $entity) {
			foreach($entity->getOneToManyProperties() as $property) {
				if($property->getEntityName() == $forEntity->getName()) {
					$result[] = $property;
				}
			}
		}
		return $result;
	}
	
	public function getManyToManyMappedProperties(Entity $forEntity) {
		$result = array();
		foreach($this->entities as $entity) {
			foreach($entity->getManyToManyProperties() as $property) {
				if($property->getEntityName() == $forEntity->getName()) {
					$result[] = $property;
				}
			}
		}
		return $result;
	}
	
	public function getManyToManyMappingTables() {
		$result = array();
		foreach($this->entities as $entity) {
			$manyToManyProps = $entity->getManyToManyProperties();
			foreach($manyToManyProps as $prop) {
				if(!isset($result[$prop->getMappingTable()])) {
					$result[$prop->getMappingTable()] = array();
				}
				$result[$prop->getMappingTable()][] = $prop;
			}
		}
		foreach($result as $table=>$props) {
			if(count($props) != 2) {
				throw new ServiceBuilderException("Mapping table '$table' should have 2 properties, now has ".count($props));
			}
		}
		return $result;
	}
	
	public function getEntity($entityName) {
		return $this->entities[$entityName];
	}

	private function importEntities() {
		$file = XmlDocument::fromFile("config/service.xml");
		$root = $file->getRootElement();
		$entityEls = $root->getChildren("entity");
		
		$this->entities = array();
		foreach($entityEls as $entityEl) {
			$name = $entityEl->getAttribute("name");
			$table = $entityEl->getAttribute("table");
			$entity = new Entity($name, $table);

			// Insert properties
			foreach($entityEl->getChildren("column") as $property) {
				$propertyName = $property->getAttribute("name");
				$type = $property->getAttribute("type");
				$size = $property->getAttribute("size");
				$entityName = $property->getAttribute("entity");
				$mappingTable = $property->getAttribute("mapping-table");
				$primary = $property->getAttribute("primary")=="true";
				$autoIncrement = $property->getAttribute("auto-increment")=="true";
				if($primary) {
					$entity->addPKProperty(new PrimaryKeyProperty($propertyName, $type, $size, $autoIncrement));
				} elseif($type == "Collection" && !$mappingTable) {
					$entity->addOneManyProperty(new OneToManyProperty($propertyName, $entityName));
				} elseif($mappingTable) {
					$entity->addManyToManyProperty(new ManyToManyProperty($propertyName, $entityName, $mappingTable));
				} else {
					$entity->addProperty(new Property($propertyName, $type, $size));
				}
			}

			// Insert finders
			foreach($entityEl->getChildren("finder") as $finderEl) {
				$finderName = $finderEl->getAttribute("name");
				$returnType = $finderEl->getAttribute("unique");
				$unique = $returnType == "true";
				$finder = new Finder($entity, $finderName, $unique);
				foreach($finderEl->getChildren("finder-column") as $fcEl) {
					$name = $fcEl->getAttribute("name");
					$comparator = $fcEl->getAttribute("comparator");
					if(empty($comparator)) {
						$comparator = "=";
					}
					$finder->addFinderColumn(new FinderColumn($name, $comparator));
				}
				$orderEls = $finderEl->getChildren("order");
				if($orderEls->size() > 1) {
					throw new ServiceBuilderException("Multiple order elements defined for finder $finderName");
				}
				if($orderEls->size() == 1) {
					$orderEl = $orderEls->getFirst();
					foreach($orderEl->getChildren("order-column") as $ocEl) {
						$ocName = $ocEl->getAttribute("name");
						$ocOrderBy = $ocEl->getAttribute("order-by");
						$finder->addOrderCol(new OrderColumn($ocName, $ocOrderBy));
					}
				}
				$entity->addFinder($finder);
			}

			// Insert order
			$orderEls = $entityEl->getChildren("order");
			if($orderEls->size() > 1) {
				throw new ServiceBuilderException("Multiple order elements defined for entity {$entity->getName()}");
			}
			if($orderEls->size() == 1) {
				$orderEl = $orderEls->get(0);
				foreach($orderEl->getChildren("order-column") as $ocEl) {
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
