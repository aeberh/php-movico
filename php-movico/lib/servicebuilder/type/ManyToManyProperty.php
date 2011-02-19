<?
class ManyToManyProperty extends Property {
	
	private $entityName;
	private $mappingTable;
	
	public function __construct($name, $entityName, $mappingTable) {
		$this->name = $name;
		$this->entityName = $entityName;
		$this->mappingTable = $mappingTable;
	}
	
	public function getMappingTable() {
		return $this->mappingTable;
	}
	
	public function getEntityName() {
		return $this->entityName;
	}
	
	public function getMappingKey() {
		return $this->getEntity()->getPrimaryKey()->getName();
	}
	
	public function getFinderSignature($tthis=false) {
		$thisOrNot = $tthis ? "this->" : "";
		return "findBy".ucfirst($this->getMappingKey())."(\$$thisOrNot{$this->getMappingKey()}, \$from, \$limit)";
	}
	
}
?>