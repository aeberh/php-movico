<?php
class LoginBean extends SessionBean {
	
	private $username;
	private $password;
	private $loggedIn = false;
	
	public function login() {
		if($this->username == $this->password) {
			$this->loggedIn = true;
		}
		return null;
	}
	
	public function logout() {
		$this->loggedIn = false;
		$this->username = "";
		$this->password = "";
		return null;
	}
	
	public function isLoggedIn() {
		return $this->loggedIn;
	}
	
	public function setUsername($username) {
		$this->username = $username;
	}
	
	public function getUsername() {
		return $this->username;
	}
	
	public function setPassword($password) {
		$this->password = $password;
	}
	
	public function getPassword() {
		return $this->password;
	}
	
}
?>