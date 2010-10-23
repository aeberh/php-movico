<?php
class ResultSet {

	private $results = array();

	public function __construct($results) {
		$this->results = $results;
	}

	public function getResult() {
		return $this->results;
	}

	public function getCount() {
		return count($this->results);
	}

	public function getSingleton() {
		return current($this->results[0]);
	}

	public function getSingleCol() {
		$return = array();
		foreach($this->results as $result) {
			$return[] = current($result);
		}
		return $return;
	}

	public function getSingleRow() {
		return current($this->results);
	}

	public function isEmpty() {
		return empty($this->results);
	}

}
?>