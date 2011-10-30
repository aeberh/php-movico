<?php
class AddressServiceUtil {

	public static function createAddress($pk=0) {
		return self::getService()->createAddress($pk);
	}

	public static function getAddress($pk) {
		return self::getService()->getAddress($pk);
	}

	public static function updateAddress(Address $object) {
		return self::getService()->updateAddress($object);
	}

	public static function deleteAddress($pk) {
		self::getService()->deleteAddress($pk);
	}

	public static function getAddresss($from=0, $limit=9999999999) {
		return self::getService()->getAddresss($from, $limit);
	}

	public static function countAddresss() {
		return self::getService()->countAddresss();
	}

	private static function getService() {
		return Singleton::create("AddressService");
	}

}
?>