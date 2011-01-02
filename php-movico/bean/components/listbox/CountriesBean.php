<?php
class CountriesBean extends ApplicationBean {
	
	private $countries;
	
	public function getAvailableCountries() {
		if(!isset($this->countries)) {
			$this->countries = array(
				"BE"=>"Belgium",
				"NL"=>"The Netherlands",
				"FR"=>"France"
			);
		}
		return $this->countries;
	}
	
}
?>