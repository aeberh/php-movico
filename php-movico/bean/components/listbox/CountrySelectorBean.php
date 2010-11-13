<?
class CountrySelectorBean extends RequestBean {
	
	private $message;
	private $countries = array();
	
	public function getAvailableCountries() {
		return array(
			"BE"=>"Belgium",
			"NL"=>"The Netherlands",
			"FR"=>"France"
		);
	}
	
	public function setSelectedCountries($countries) {
		$this->countries = $countries;
	}
	
	public function getMessage() {
		return $this->message;
	}

	public function getSelectedCountries() {
		return $this->countries;
	}
	
	public function save() {
		$this->message = implode(",", $this->countries)." selected.";
	}
	
}
?>