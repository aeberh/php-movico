<?php 
class NullConverter implements DatabaseFieldConverter {
	
	public function fromDBtoDOM($dbValue) {
		return stripslashes($dbValue);
	}
	
	function fromDOMtoDB($domValue) {
		return addslashes($domValue);
	}
	
}
?>