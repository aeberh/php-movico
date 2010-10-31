<?
class OneToManyProperty extends Property {
	
	private $entityName;
	private $mappingKey;
	
	public function __construct($name, $entityName, $mappingKey) {
		$this->name = $name;
		$this->entityName = $entityName;
		$this->mappingKey = $mappingKey;
	}
	
	public function getEntityName() {
		return $this->entityName;
	}
	
	public function getMappingKey() {
		return $this->mappingKey;
	}
	
}
?>