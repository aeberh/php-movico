<?php
class UserServiceUtil {

	public static function create($firstName, $lastName, $default) {
		return self::getService()->create($firstName, $lastName, $default);
	}

	public static function update($id, $firstName, $lastName, $default) {
		return self::getService()->update($id, $firstName, $lastName, $default);
	}

	public static function createUser($pk=0) {
		return self::getService()->createUser($pk);
	}

	public static function getUser($pk) {
		return self::getService()->getUser($pk);
	}

	public static function updateUser(User $object) {
		return self::getService()->updateUser($object);
	}

	public static function deleteUser($pk) {
		self::getService()->deleteUser($pk);
	}

	public static function getUsers() {
		return self::getService()->getUsers();
	}

	public static function countUsers() {
		return self::getService()->countUsers();
	}

	private static function getService() {
		return Singleton::create("UserService");
	}

}
?>