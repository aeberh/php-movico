<?php
class RoleService extends RoleServiceBase {

	public function createAll($roleNames) {
		foreach($roleNames as $roleName) {
			try {
				$this->findByName($roleName);
			} catch(NoSuchRoleException $e) {
				$this->create($roleName);
			}
		}
	}
	
	private function create($name) {
		$role = $this->createRole();
		$role->setName($name);
		return $this->updateRole($role);
	}
	
	public function addMember($roleId, $playerId) {
		$role = $this->getRole($roleId);
		$users = $role->getUsers();
		$users[] = PingpongPlayerServiceUtil::getPingpongPlayer($playerId);
		$playerIds = ArrayUtil::toIndexedArray($users, "playerId");
		$this->setUsers($role->getRoleId(), $playerIds);
	}
	
	public function deleteMember($roleId, $playerId) {
		$role = $this->getRole($roleId);
		$users = $role->getUsers();
		$playerIds = array();
		foreach($users as $user) {
			if($user->getPlayerId() != $playerId) {
				$playerIds[] = $user->getPlayerId();
			}
		}
		$this->setUsers($role->getRoleId(), $playerIds);
	}
	
}
?>