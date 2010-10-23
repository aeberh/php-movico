<?php 
class DateConverter implements DatabaseFieldConverter {
	
	public function fromDBtoDOM($dbValue) {
		return Date::create(strtotime($dbValue));
	}
	
	function fromDOMtoDB($domValue) {
		return $domValue->format("Y-m-d H:i:s");
	}
	
}
?>