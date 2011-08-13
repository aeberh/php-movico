<?php
abstract class Persistence {

	protected $db;
	protected static $dbCache = null;

	public function __construct() {
		$this->db = Singleton::create("DatabaseManager");
		if(is_null(self::$dbCache)) {
			self::$dbCache = BeanLocator::get("DatabaseCache");
		}
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
