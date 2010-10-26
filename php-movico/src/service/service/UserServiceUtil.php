<?php
class UserServiceUtil {

	public static function create($firstName, $lastName) {
		return self::getService()->create($firstName, $lastName);
	}

	public static function update($id, $firstName, $lastName) {
		return self::getService()->update($id, $firstName, $lastName);
	}

	public static function doUpdate($user, $firstName, $lastName) {
		return self::getService()->doUpdate($user, $firstName, $lastName);
	}

	public static function validate($firstName, $lastName) {
		return self::getService()->validate($firstName, $lastName);
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