<?php
class PingpongTeamPersistence extends Persistence {

	const TABLE = "PingpongTeam";

	public function findByClubAndTeam($clubId, $teamNo, $recreation, $from=-1, $limit=-1) {
		$limitStr = ($from == -1 && $limit == -1) ? "" : " LIMIT $from,$limit";
		$whereClause = "`clubId`='".Singleton::create("NullConverter")->fromDOMtoDB($clubId)."' AND `teamNo`='".Singleton::create("NullConverter")->fromDOMtoDB($teamNo)."' AND `recreation`='".Singleton::create("BooleanConverter")->fromDOMtoDB($recreation)."'".$limitStr;
		if($this->dbCache->hasFinder('PingpongTeam', $whereClause)) {
			return $this->dbCache->getFinder('PingpongTeam', $whereClause);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE $whereClause");
		if($result->isEmpty()) {
			throw new NoSuchPingpongTeamException();
		}
		$result = $this->getAsObject($result->getSingleRow());
		$this->dbCache->setFinder('PingpongTeam', $whereClause, $result);
		return $result;
	}

	public function findByClub($clubId, $from=-1, $limit=-1) {
		$limitStr = ($from == -1 && $limit == -1) ? "" : " LIMIT $from,$limit";
		$whereClause = "`clubId`='".Singleton::create("NullConverter")->fromDOMtoDB($clubId)."'".$limitStr;
		if($this->dbCache->hasFinder('PingpongTeam', $whereClause)) {
			return $this->dbCache->getFinder('PingpongTeam', $whereClause);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE $whereClause");
		$result = $this->getAsObjects($result->getResult());
		$this->dbCache->setFinder('PingpongTeam', $whereClause, $result);
		return $result;
	}

	public function findByPrimaryKey($teamId) {
		if($this->dbCache->hasSingle("PingpongTeam", $teamId)) {
			return $this->dbCache->getSingle("PingpongTeam", $teamId);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE teamId='".addslashes($teamId)."'");
		if($result->isEmpty()) {
			throw new NoSuchPingpongTeamException($teamId);
		}
		$result = $this->getAsObject($result->getSingleRow());
		$this->dbCache->setSingle("PingpongTeam", $teamId, $result);
		return $result;
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
		$this->dbCache->resetEntity('PingpongTeam');
		$this->dbCache->resetSingle("PingpongTeam", $teamId, $result);
	}

	public function update(PingpongTeam $object) {
		$q = "UPDATE ".self::TABLE." SET `clubId`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getClubId())."', `teamNo`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getTeamNo())."', `recreation`='".Singleton::create("BooleanConverter")->fromDOMtoDB($object->isRecreation())."' WHERE teamId='".addslashes($object->getTeamId())."'";
		$pk = $object->getTeamId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`clubId`, `teamNo`, `recreation`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getClubId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getTeamNo())."', '".Singleton::create("BooleanConverter")->fromDOMtoDB($object->isRecreation())."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`clubId`, `teamNo`, `recreation`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getTeamId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getClubId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getTeamNo())."', '".Singleton::create("BooleanConverter")->fromDOMtoDB($object->isRecreation())."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT teamId from ".self::TABLE." ORDER BY teamId DESC limit 1")->getSingleton();
		}
		$result = $this->findByPrimaryKey($pk);
		$this->dbCache->resetEntity("PingpongTeam");
		$this->dbCache->setSingle("PingpongTeam", $pk, $result);
		return $result;
	}

	public function findAll($from, $limit) {
		if($this->dbCache->hasAll('PingpongTeam')) {
			return $this->dbCache->getAll('PingpongTeam');
		}
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE."  LIMIT $from,$limit")->getResult();
		$objects = $this->getAsObjects($rows);
		$this->dbCache->setAll('PingpongTeam', $objects);
		return $objects;
	}

	public function count() {
		if($this->dbCache->hasAll('PingpongTeam')) {
			return count($this->dbCache->getAll('PingpongTeam'));
		}
		return $this->db->selectQuery("SELECT COUNT(*) FROM ".self::TABLE)->getSingleton();
	}

	protected function getAsObject($row) {
		$result = new PingpongTeam();
		$result->setNew(false);
		$result->setTeamId(Singleton::create("NullConverter")->fromDBtoDOM($row["teamId"]));
		$result->setClubId(Singleton::create("NullConverter")->fromDBtoDOM($row["clubId"]));
		$result->setTeamNo(Singleton::create("NullConverter")->fromDBtoDOM($row["teamNo"]));
		$result->setRecreation(Singleton::create("BooleanConverter")->fromDBtoDOM($row["recreation"]));
		return $result;
	}

}
?>