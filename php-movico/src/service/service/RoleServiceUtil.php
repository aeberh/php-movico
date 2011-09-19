<?php
class RoleServiceUtil {

	public static function createAll($roleNames) {
		return self::getService()->createAll($roleNames);
	}

	public static function addMember($roleId, $playerId) {
		return self::getService()->addMember($roleId, $playerId);
	}

	public static function deleteMember($roleId, $playerId) {
		return self::getService()->deleteMember($roleId, $playerId);
	}

	public static function findByName($name, $from=-1, $limit=-1) {
		return self::getService()->findByName($name, $from, $limit);
	}

	public static function findByPlayerId($playerId, $from, $limit) {
		return self::getService()->findByPlayerId($playerId, $from, $limit);
	}

	public static function setUsers($roleId, $playerIds) {
		self::getService()->setUsers($roleId, $playerIds);
	}

	public static function createRole($pk=0) {
		return self::getService()->createRole($pk);
	}

	public static function getRole($pk) {
		return self::getService()->getRole($pk);
	}

	public static function updateRole(Role $object) {
		return self::getService()->updateRole($object);
	}

	public static function deleteRole($pk) {
		self::getService()->deleteRole($pk);
	}

	public static function getRoles($from=0, $limit=9999999999) {
		return self::getService()->getRoles($from, $limit);
	}

	public static function countRoles() {
		return self::getService()->countRoles();
	}

	private static function getService() {
		return Singleton::create("RoleService");
	}

}
?>