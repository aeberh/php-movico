<?php
class TeamPersistence extends Persistence {

	const TABLE = "Team";

	public function findByPrimaryKey($teamId) {
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE teamId='$teamId'");
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
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE teamId='$teamId'");
	}

	public function update(Team $object) {
		$q = "UPDATE ".self::TABLE." SET  WHERE teamId='{$object->getTeamId()}'";
		$pk = $object->getTeamId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." () VALUES ('')";
			} else {
				$q = "INSERT INTO ".self::TABLE." () VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getTeamId())."')";
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
		return $result;
	}

}
?>