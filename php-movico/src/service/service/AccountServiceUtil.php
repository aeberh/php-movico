<?php
class AccountServiceUtil {

	public static function register($emailAddress, $password, $password2) {
		return self::getService()->register($emailAddress, $password, $password2);
	}

	public static function login($emailAddress, $password) {
		return self::getService()->login($emailAddress, $password);
	}

	public static function userExists($emailAddress) {
		return self::getService()->userExists($emailAddress);
	}

	public static function findByEmailAddress($emailAddress, $from=-1, $limit=-1) {
		return self::getService()->findByEmailAddress($emailAddress, $from, $limit);
	}

	public static function createAccount($pk=0) {
		return self::getService()->createAccount($pk);
	}

	public static function getAccount($pk) {
		return self::getService()->getAccount($pk);
	}

	public static function updateAccount(Account $object) {
		return self::getService()->updateAccount($object);
	}

	public static function deleteAccount($pk) {
		self::getService()->deleteAccount($pk);
	}

	public static function getAccounts($from=0, $limit=9999999999) {
		return self::getService()->getAccounts($from, $limit);
	}

	public static function countAccounts() {
		return self::getService()->countAccounts();
	}

	private static function getService() {
		return Singleton::create("AccountService");
	}

}
?>