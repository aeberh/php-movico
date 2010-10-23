<?php 
class NullConverter implements DatabaseFieldConverter {
	
	public function fromDBtoDOM($dbValue) {
		return $dbValue;
	}
	
	function fromDOMtoDB($domValue) {
		return $domValue;
	}
	
}
?>