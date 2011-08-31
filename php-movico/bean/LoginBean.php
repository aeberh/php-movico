<?php
class LoginBean extends SessionBean {
	
	private $emailAddress;
	private $password;
	//private $password2;
	
	private $player = null;

	public function login() {
		try {
			$this->player = PingpongPlayerServiceUtil::login($this->emailAddress, $this->password);
		} catch(LoginException $e) {
			MessageUtil::error("Logingegevens zijn onjuist!");
		} catch(NoSuchPingpongPlayerException $e) {
			MessageUtil::error("Logingegevens zijn onjuist!");
		}
		return null;
	}
	
	/*
	public function register() {
		try {
			PingpongPlayerServiceUtil::register($this->emailAddress, $this->password, $this->password2);
			return $this->login();
			MessageUtil::info("Gebruiker geregistreerd!");
		} catch(PasswordsDontMatchException $e) {
			MessageUtil::error("Wachtwoord en herhaling wachtwoord zijn verschillend");
		} catch(InvalidEmailAddressException $e) {
			MessageUtil::error("Het emailadres mag enkel alfanumerieke tekens bevatten en moet minstens 4 karakters lang zijn");
		} catch(DuplicateEmailAddressException $e) {
			MessageUtil::error("Dit emailadres is reeds in gebruik. Log in met de juiste gegevens of kies een ander emailadres");
		} catch(InvalidPasswordException $e) {
			MessageUtil::error("Het wachtwoord mag enkel alfanumerieke tekens bevatten en moet minstens 6 karakters lang zijn");
		}
		return null;
	}
	*/
	
	public function logout() {
		$this->player = null;
	}
	
	public function isLoggedIn() {
		return !is_null($this->player);
	}
	
	public function isAdmin() {
		if(!$this->isLoggedIn()) {
			return false;
		}
		return $this->player->getEmailAddress() === "limburgie@gmail.com";
	}
	
	public function getPlayer() {
		return $this->player;
	}
	
	public function getPlayerId() {
		return $this->player->getPlayerId();
	}
		
	public function getEmailAddress() {
		return $this->emailAddress;
	}
	
	public function setEmailAddress($emailAddress) {
		$this->emailAddress = $emailAddress;
	}
	
	public function getPassword() {
		return $this->password;
	}
	
	public function setPassword($password) {
		$this->password = $password;
	}
	
	public function getPassword2() {
		return $this->password2;
	}
	
	public function setPassword2($password2) {
		$this->password2 = $password2;
	}
	
}
?>