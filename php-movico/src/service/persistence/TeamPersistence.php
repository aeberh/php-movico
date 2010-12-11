<?php
class TeamPersistence extends Persistence {

	const TABLE = "movico_team";

	public function findByPrimaryKey($teamId) {
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE teamId='".addslashes($teamId)."'");
		if($result->isEmpty()) {
			throw new NoSuchTeamException($teamId);
		}
		return $this->getAsObject($result->getSingleRow());
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
	}

	public function update(Team $object) {
		$q = "UPDATE ".self::TABLE." SET `name`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getName()))."' WHERE teamId='".addslashes($object->getTeamId())."'";
		$pk = $object->getTeamId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`name`) VALUES ('".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getName()))."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`name`) VALUES ('".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getTeamId()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getName()))."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT teamId from ".self::TABLE." ORDER BY teamId DESC limit 1")->getSingleton();
		}
		return $this->findByPrimaryKey($pk);
	}

	public function findAll() {
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE." ")->getResult();
		return $this->getAsObjects($rows);
	}

	public function count() {
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