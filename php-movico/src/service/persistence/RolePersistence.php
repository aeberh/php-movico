<?php
class RolePersistence extends Persistence {

	const TABLE = "Role";

	public function findByName($name, $from=-1, $limit=-1) {
		$limitStr = ($from == -1 && $limit == -1) ? "" : " LIMIT $from,$limit";
		$whereClause = "`name`='".Singleton::create("NullConverter")->fromDOMtoDB($name)."'".$limitStr;
		if(parent::$dbCache->hasFinder('Role', $whereClause)) {
			return parent::$dbCache->getFinder('Role', $whereClause);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE $whereClause");
		if($result->isEmpty()) {
			throw new NoSuchRoleException();
		}
		$result = $this->getAsObject($result->getSingleRow());
		parent::$dbCache->setFinder('Role', $whereClause, $result);
		return $result;
	}

	public function findByPrimaryKey($roleId) {
		if(parent::$dbCache->hasSingle("Role", $roleId)) {
			return parent::$dbCache->getSingle("Role", $roleId);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE roleId='".addslashes($roleId)."'");
		if($result->isEmpty()) {
			throw new NoSuchRoleException($roleId);
		}
		$result = $this->getAsObject($result->getSingleRow());
		parent::$dbCache->setSingle("Role", $roleId, $result);
		return $result;
	}

	public function create($roleId) {
		$obj = new Role();
		$obj->setRoleId($roleId);
		$obj->setNew(true);
		return $obj;
	}

	public function remove($roleId) {
		$this->findByPrimaryKey($roleId);
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE roleId='".addslashes($roleId)."'");
		parent::$dbCache->resetEntity('Role');
		parent::$dbCache->resetSingle("Role", $roleId);
	}

	public function update(Role $object) {
		$q = "UPDATE ".self::TABLE." SET `name`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."' WHERE roleId='".addslashes($object->getRoleId())."'";
		$pk = $object->getRoleId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`name`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`name`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getRoleId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT roleId from ".self::TABLE." ORDER BY roleId DESC limit 1")->getSingleton();
		}
		$result = $this->findByPrimaryKey($pk);
		parent::$dbCache->resetEntity("Role");
		parent::$dbCache->setSingle("Role", $pk, $result);
		return $result;
	}

	public function findAll($from, $limit) {
		if(parent::$dbCache->hasAll('Role', $from, $limit)) {
			return parent::$dbCache->getAll('Role', $from, $limit);
		}
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE."  LIMIT $from,$limit")->getResult();
		$objects = $this->getAsObjects($rows);
		parent::$dbCache->setAll('Role', $objects, $from, $limit);
		return $objects;
	}

	public function count() {
		if(parent::$dbCache->hasAll('Role', -1, -1)) {
			return count(parent::$dbCache->getAll('Role', -1, -1));
		}
		return $this->db->selectQuery("SELECT COUNT(*) FROM ".self::TABLE)->getSingleton();
	}

	protected function getAsObject($row) {
		$result = new Role();
		$result->setNew(false);
		$result->setRoleId(Singleton::create("NullConverter")->fromDBtoDOM($row["roleId"]));
		$result->setName(Singleton::create("NullConverter")->fromDBtoDOM($row["name"]));
		return $result;
	}

	public function findByPlayerId($playerId, $from, $limit) {
		$rows = $this->db->selectQuery("SELECT t.* FROM Users_Roles mapping,".self::TABLE." t WHERE mapping.playerId='$playerId' AND mapping.roleId=t.roleId LIMIT $from,$limit")->getResult();
		return $this->getAsObjects($rows);
	}

	public function setUsers($roleId, $playerIds) {
		$this->db->updateQuery("DELETE FROM Users_Roles WHERE roleId='$roleId'");
		if(empty($playerIds)) {
			return;
		}
		$insertValues = array();
		foreach($playerIds as $playerId) {
			$insertValues[] = "('$roleId', '$playerId')";
		}
		$this->db->updateQuery("INSERT INTO Users_Roles (roleId, playerId) VALUES ".implode(", ", $insertValues));
	}

}
?>