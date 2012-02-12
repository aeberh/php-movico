<?php
class PaginationBean extends RequestBean {
	
	private $countries;
	
	public function __construct() {
		$this->countries = array("Belgium", "The Netherlands", "Germany", "France", "England");
	}
	
	public function getCountries() {
		return $this->countries;
	}
	
}
?>