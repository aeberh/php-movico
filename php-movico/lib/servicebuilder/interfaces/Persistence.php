<?php
abstract class Persistence {

	protected $db;

	public function __construct() {
		$this->db = Singleton::create("DatabaseManager");
	}

	protected abstract function getAsObject($row);

	protected function getAsObjects($rows) {
		$result = array();
		foreach($rows as $row) {
			$result[] = $this->getAsObject($row);
		}
		return $result;
	}

}
?>
