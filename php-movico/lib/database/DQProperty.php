<?php
class DQProperty extends DQCriterion {

	private $name;
	private $sql;

	public function __construct($name) {
		$this->name = $name;
	}

	public function eq($param) {
		$this->createSql("=", $param);
	}

	public function neq($param) {
		$this->createSql("<>", $param);
	}

	public function gt($param) {
		$this->createSql(">", $param);
	}

	public function ge($param) {
		$this->createSql(">=", $param);
	}

	public function lt($param) {
		$this->createSql("<", $param);
	}

	public function le($param) {
		$this->createSql("<=", $param);
	}

	public function like($param) {
		$this->createSql(" like ", $param);
	}

	private function createSql($operator, $param) {
		$this->sql = $this->name.$operator."'".$param."'";
	}

}
?>
