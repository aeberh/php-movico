<?php
abstract class RoleModel extends Model {

	private $roleId;

	public function getRoleId() {
		return $this->roleId;
	}

	public function setRoleId($roleId) {
		$this->roleId = $roleId;
	}

	private $name;

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getUsers($from=0, $limit=9999999999) {
		return PingpongPlayerServiceUtil::findByRoleId($this->roleId, $from, $limit);
	}

}
?>