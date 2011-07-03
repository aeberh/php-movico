<?php
class AccountService extends AccountServiceBase {

	public function register($emailAddress, $password, $password2) {
		if(!ctype_alnum($emailAddress) || strlen($emailAddress)<4) {
			throw new InvalidEmailAddressException();
		}
		if($this->userExists($emailAddress)) {
			throw new DuplicateEmailAddressException();
		}
		if(!ctype_alnum($emailAddress) || strlen($password)<6) {
			throw new InvalidPasswordException();
		}
		if($password !== $password2) {
			throw new PasswordsDontMatchException();
		}
		$user = $this->createAccount();
		$user->setEmailAddress($emailAddress);
		$user->setPassword($password);
		return $this->updateAccount($user);
	}
	
	public function login($emailAddress, $password) {
		$user = $this->findByEmailAddress($emailAddress);
		if($user->getPassword() !== $password) {
			throw new LoginException();
		}
		return $user;
	}
	
	public function userExists($emailAddress) {
		try {
			$this->findByEmailAddress($emailAddress);
			return true;
		} catch(NoSuchAccountException $e) {
			return false;
		}
	}
	
}
?>