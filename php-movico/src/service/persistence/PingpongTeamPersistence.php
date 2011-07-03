<?php
class PingpongTeamPersistence extends Persistence {

	const TABLE = "PingpongTeam";

	public function findByPrimaryKey($teamId) {
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE teamId='".addslashes($teamId)."'");
		if($result->isEmpty()) {
			throw new NoSuchPingpongTeamException($teamId);
		}
		return $this->getAsObject($result->getSingleRow());
	}

	public function create($teamId) {
		$obj = new PingpongTeam();
		$obj->setTeamId($teamId);
		$obj->setNew(true);
		return $obj;
	}

	public function remove($teamId) {
		$this->findByPrimaryKey($teamId);
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE teamId='".addslashes($teamId)."'");
	}

	public function update(PingpongTeam $object) {
		$q = "UPDATE ".self::TABLE." SET `team`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getTeam()))."', `recreation`='".addslashes(Singleton::create("BooleanConverter")->fromDOMtoDB($object->isRecreation()))."' WHERE teamId='".addslashes($object->getTeamId())."'";
		$pk = $object->getTeamId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`team`, `recreation`) VALUES ('".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getTeam()))."', '".addslashes(Singleton::create("BooleanConverter")->fromDOMtoDB($object->isRecreation()))."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`team`, `recreation`) VALUES ('".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getTeamId()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getTeam()))."', '".addslashes(Singleton::create("BooleanConverter")->fromDOMtoDB($object->isRecreation()))."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT teamId from ".self::TABLE." ORDER BY teamId DESC limit 1")->getSingleton();
		}
		return $this->findByPrimaryKey($pk);
	}

	public function findAll($from, $limit) {
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE."  LIMIT $from,$limit")->getResult();
		return $this->getAsObjects($rows);
	}

	public function count() {
		return $this->db->selectQuery("SELECT COUNT(*) FROM ".self::TABLE)->getSingleton();
	}

	protected function getAsObject($row) {
		$result = new PingpongTeam();
		$result->setNew(false);
		$result->setTeamId(Singleton::create("NullConverter")->fromDBtoDOM($row["teamId"]));
		$result->setTeam(Singleton::create("NullConverter")->fromDBtoDOM($row["team"]));
		$result->setRecreation(Singleton::create("BooleanConverter")->fromDBtoDOM($row["recreation"]));
		return $result;
	}

}
?>