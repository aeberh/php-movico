<?php
class OrderColumn {

	private $name;
	private $orderBy;

	private static $orderBys = array("asc", "desc");

	public function __construct($name, $orderBy) {
		$this->name = $name;
		$this->orderBy = $orderBy;
		$this->validate();
	}

	public function getName() {
		return $this->name;
	}

	public function getOrderBy() {
		return $this->orderBy;
	}
	
	public function getClause() {
		return "`{$this->name}` {$this->orderBy}";
	}
	
	private function validate() {
		if(!in_array($this->orderBy, self::$orderBys)) {
			throw new ServiceBuilderException("Order-by should be 'asc' or 'desc'");
		}
	}

}
?>
