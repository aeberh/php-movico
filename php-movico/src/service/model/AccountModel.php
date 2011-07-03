<?php
abstract class AccountModel extends Model {

	private $accountId;

	public function getAccountId() {
		return $this->accountId;
	}

	public function setAccountId($accountId) {
		$this->accountId = $accountId;
	}

	private $emailAddress;

	public function getEmailAddress() {
		return $this->emailAddress;
	}

	public function setEmailAddress($emailAddress) {
		$this->emailAddress = $emailAddress;
	}

	private $password;

	public function getPassword() {
		return $this->password;
	}

	public function setPassword($password) {
		$this->password = $password;
	}

}
?>