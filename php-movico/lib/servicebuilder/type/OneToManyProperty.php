<?
class OneToManyProperty extends Property {
	
	private $entityName;
	
	public function __construct($name, $entityName) {
		$this->name = $name;
		$this->entityName = $entityName;
	}
	
	public function getEntityName() {
		return $this->entityName;
	}
	
	public function getMappingKey() {
		return $this->getMappedProperty()->getName();
	}
	
	public function getMappedProperty() {
		return $this->getEntity()->getPrimaryKey();
	}
	
	public function getFinderSignature($tthis=false, $values=true) {
		$v = $values ? "=-1" : "";
		$thisOrNot = $tthis ? "this->" : "";
		return "findBy".ucfirst($this->getMappingKey())."(\$$thisOrNot{$this->getMappingKey()}, \$from$v, \$limit$v)";
	}
	
}
?>