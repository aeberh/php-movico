<?php 
class BooleanConverter implements DatabaseFieldConverter {
	
	public function fromDBtoDOM($dbValue) {
		if($dbValue == 1) {
			return true;
		}
		return false;
	}
	
	function fromDOMtoDB($domValue) {
		if($domValue === true) {
			return 1;
		}
		return 0;
	}
	
}
?>