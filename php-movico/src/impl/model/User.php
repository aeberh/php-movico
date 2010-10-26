<?php
class User extends UserModel {

	public function getFullName() {
		return $this->getFirstName()." ".$this->getLastName();
	}
	
}
?>