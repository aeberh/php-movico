<?php
class PingpongPlayer extends PingpongPlayerModel {

	public function getFullName() {
		return $this->getFirstName()." ".$this->getLastName();
	}
	
	public function getAddress() {
		return $this->getStreet().", ".$this->getPlace();
	}
	
}
?>