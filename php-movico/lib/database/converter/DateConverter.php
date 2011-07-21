<?php 
class DateConverter implements DatabaseFieldConverter {
	
	public function fromDBtoDOM($dbValue) {
		return Date::create(strtotime($dbValue));
	}
	
	function fromDOMtoDB($domValue) {
		if(empty($domValue)) {
			$domValue = Date::create(0);
		}
		return $domValue->format("%Y-%m-%d %H:%M:%S");
	}
	
}
?>