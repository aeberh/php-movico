<?php
class Entity {

	private $name;
	private $table;
	private $properties;
	private $primaryKey;
	private $finders;
	private $orderCols;
	private $oneToManyProperties;

	public function __construct($name, $table=null) {
		$this->name = $name;
		$this->table = empty($table) ? $name : $table;
		$this->properties = array();
		$this->finders = array();
		$this->orderCols = array();
		$this->oneToManyProperties = array();
	}
	
	public function addProperty(Property $property) {
		$property->setEntity($this);
		$this->properties[$property->getName()] = $property;
	}
	
	public function addPKProperty(PrimaryKeyProperty $property) {
		if(!empty($this->primaryKey)) {
			throw new ServiceBuilderException("Only one primary key allowed");
		}
		if(!empty($this->properties[$property->getName()])) {
			throw new ServiceBuilderException("Duplicate property name '{$property->getName()}' for entity '$this->name'");
		}
		$property->setEntity($this);
		$this->primaryKey = $property;
	}
	
	public function addOneManyProperty(OneToManyProperty $property) {
		$property->setEntity($this);
		$this->oneToManyProperties[] = $property;
	}

	public function addFinder(Finder $finder) {
		if(!empty($this->finders[$finder->getName()])) {
			throw new ServiceBuilderException("Duplicate finder name '{$finder->getName()}' for entity '$this->name'");
		}
		foreach($finder->getColumns() as $finderColumn) {
			if(empty($this->properties[$finderColumn->getName()])) {
				throw new ServiceBuilderException("Finder column '{$finderColumn->getName()}' is not a property for entity '$this->name'");
			}
		}
		$this->finders[$finder->getName()] = $finder;
	}

	public function addOrderCol(OrderColumn $orderColumn) {
		if(empty($this->properties[$orderColumn->getName()])) {
			throw new ServiceBuilderException("Order column '{$orderColumn->getName()}' is not a property for entity '$this->name'");
		}
		if(!empty($this->orderCols[$orderColumn->getName()])) {
			throw new ServiceBuilderException("Duplicate order column '{$orderColumn->getName()}' for entity '$this->name'");
		}
		$this->orderCols[$orderColumn->getName()] = $orderColumn;
	}

	public function getName() {
		return $this->name;
	}

	public function getTable() {
		return $this->table;
	}
	
	public function getFinders() {
		return $this->finders;
	}

	public function getProperties() {
		return $this->properties;
	}
	
	public function getOneToManyProperties() {
		return $this->oneToManyProperties;
	}
	
	public function getOrderByClause() {
		if(empty($this->orderCols)) {
			return "";
		}
		$orderTerms = array();
		foreach($this->orderCols as $order) {
			$orderTerms[] = $order->getClause();
		}
		return "ORDER BY ".implode(", ", $orderTerms);
	}
	
	public function getAllProperties() {
		return array_merge(array($this->primaryKey->getName() => $this->primaryKey), $this->properties);
	}
	
	public function getProperty($propName) {
		$props = $this->getAllProperties();
		return $props[$propName];
	}
	
	public function getPropertyNames($pkIncluded) {
		$properties = $pkIncluded ? $this->getAllProperties() : $this->getProperties();
		$result = array();
		foreach ($this->getProperties() as $property) {
			$result[] = "`".$property->getName()."`";
		}
		foreach(Singleton::create("ServiceBuilder")->getOneToManyMappedProperties($this) as $property) {
			$result[] = "`".$property->getMappingKey()."`";
		}
		return $result;
	}
	
	public function getPropertyGetters($objName, $pkIncluded) {
		$properties = $pkIncluded ? $this->getAllProperties() : $this->getProperties();
		$result = array();
		foreach ($properties as $property) {
			$result[] = $this->getGetter($objName, $property);
		}
		foreach(Singleton::create("ServiceBuilder")->getOneToManyMappedProperties($this) as $property) {
			$result[] = $this->getGetter($objName, $property->getMappedProperty());
		}
		return $result;
	}
	
	public function getPropertyUpdatePairs($objName) {
		$result = array();
		foreach ($this->getProperties() as $property) {
			$result[] = "`{$property->getName()}`='{$this->getGetter($objName, $property)}'";
		}
		$sb = Singleton::create("ServiceBuilder");
		foreach($sb->getOneToManyMappedProperties($this) as $property) {
			$propName = $property->getMappingKey();
			$mappedProperty = $property->getMappedProperty();
			$result[] = "`{$propName}`='{$this->getGetter($objName, $mappedProperty)}'";
		}
		return $result;
	}
	
	private function getGetter($objName, Property $property) {
		return "\".Singleton::create(\"".$property->getConverter()."\")->fromDOMtoDB(\${$objName}->{$property->getGetter()}).\"";
	}

	public function getPrimaryKey() {
		return $this->primaryKey;
	}

	public function validate() {
		if(empty($this->primaryKey)) {
			throw new ServiceBuilderException("Validation error: No primary key defined for entity '$this->name'");
		}
	}

	public function isAutoIncrement() {
		return $this->autoIncrement;
	}

}
?>
