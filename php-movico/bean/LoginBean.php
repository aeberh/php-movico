<?php
class LoginBean extends SessionBean {
	
	private $emailAddress;
	private $password;
	private $password2;
	
	private $account = null;

	public function login() {
		try {
			$this->account = AccountServiceUtil::login($this->emailAddress, $this->password);
		} catch(LoginException $e) {
			MessageUtil::error("EmailAddress and password don't match!");
		} catch(NoSuchAccountException $e) {
			MessageUtil::error("EmailAddress and password don't match!");
		}
		return null;
	}
	
	public function register() {
		try {
			AccountServiceUtil::register($this->emailAddress, $this->password, $this->password2);
			return $this->login();
			MessageUtil::info("Account created!");
		} catch(PasswordsDontMatchException $e) {
			MessageUtil::error("Passwords don't match!");
		} catch(InvalidEmailAddressException $e) {
			MessageUtil::error("EmailAddress can only contain alphanumeric characters and must be at least 4 characters long");
		} catch(DuplicateEmailAddressException $e) {
			MessageUtil::error("That emailAddress is already taken. Please choose another one or login with the right password.");
		} catch(InvalidPasswordException $e) {
			MessageUtil::error("Password can only contain alphanumeric characters and must be at least 6 characters long");
		}
		return null;
	}
	
	public function logout() {
		$this->account = null;
	}
	
	public function isLoggedIn() {
		return !is_null($this->account);
	}
	
	public function isAdmin() {
		return $this->emailAddress === "admin@jevota.be";
	}
	
	public function getAccount() {
		return $this->account;
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