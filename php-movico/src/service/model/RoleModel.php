<?php
abstract class RoleModel extends Model {

	protected $roleId;

	public function getRoleId() {
		return $this->roleId;
	}

	public function setRoleId($roleId) {
		$this->roleId = $roleId;
	}

	protected $name;

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