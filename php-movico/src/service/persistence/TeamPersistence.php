<?php
class TeamPersistence extends Persistence {

	const TABLE = "movico_team";

	public function findByPrimaryKey($teamId) {
		if(parent::$dbCache->hasSingle("Team", $teamId)) {
			return parent::$dbCache->getSingle("Team", $teamId);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE teamId='".addslashes($teamId)."'");
		if($result->isEmpty()) {
			throw new NoSuchTeamException($teamId);
		}
		$result = $this->getAsObject($result->getSingleRow());
		parent::$dbCache->setSingle("Team", $teamId, $result);
		return $result;
	}

	public function create($teamId) {
		$obj = new Team();
		$obj->setTeamId($teamId);
		$obj->setNew(true);
		return $obj;
	}

	public function remove($teamId) {
		$this->findByPrimaryKey($teamId);
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE teamId='".addslashes($teamId)."'");
		parent::$dbCache->resetEntity('Team');
		parent::$dbCache->resetSingle("Team", $teamId);
	}

	public function update(Team $object) {
		$q = "UPDATE ".self::TABLE." SET `name`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."' WHERE teamId='".addslashes($object->getTeamId())."'";
		$pk = $object->getTeamId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`name`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`name`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getTeamId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT teamId from ".self::TABLE." ORDER BY teamId DESC limit 1")->getSingleton();
		}
		$result = $this->findByPrimaryKey($pk);
		parent::$dbCache->resetEntity("Team");
		parent::$dbCache->setSingle("Team", $pk, $result);
		return $result;
	}

	public function findAll($from, $limit) {
		if(parent::$dbCache->hasAll('Team', $from, $limit)) {
			return parent::$dbCache->getAll('Team', $from, $limit);
		}
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE."  LIMIT $from,$limit")->getResult();
		$objects = $this->getAsObjects($rows);
		parent::$dbCache->setAll('Team', $objects, $from, $limit);
		return $objects;
	}

	public function count() {
		if(parent::$dbCache->hasAll('Team', -1, -1)) {
			return count(parent::$dbCache->getAll('Team', -1, -1));
		}
		return $this->db->selectQuery("SELECT COUNT(*) FROM ".self::TABLE)->getSingleton();
	}

	protected function getAsObject($row) {
		$result = new Team();
		$result->setNew(false);
		$result->setTeamId(Singleton::create("NullConverter")->fromDBtoDOM($row["teamId"]));
		$result->setName(Singleton::create("NullConverter")->fromDBtoDOM($row["name"]));
		return $result;
	}

}
?>