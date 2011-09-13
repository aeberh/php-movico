<?php
class PingpongTeamPersistence extends Persistence {

	const TABLE = "PingpongTeam";

	public function findByClubAndTeam($clubId, $teamNo, $recreation, $from=-1, $limit=-1) {
		$limitStr = ($from == -1 && $limit == -1) ? "" : " LIMIT $from,$limit";
		$whereClause = "`clubId`='".Singleton::create("NullConverter")->fromDOMtoDB($clubId)."' AND `teamNo`='".Singleton::create("NullConverter")->fromDOMtoDB($teamNo)."' AND `recreation`='".Singleton::create("BooleanConverter")->fromDOMtoDB($recreation)."'".$limitStr;
		if(parent::$dbCache->hasFinder('PingpongTeam', $whereClause)) {
			return parent::$dbCache->getFinder('PingpongTeam', $whereClause);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE $whereClause");
		if($result->isEmpty()) {
			throw new NoSuchPingpongTeamException();
		}
		$result = $this->getAsObject($result->getSingleRow());
		parent::$dbCache->setFinder('PingpongTeam', $whereClause, $result);
		return $result;
	}

	public function findByClub($clubId, $from=-1, $limit=-1) {
		$limitStr = ($from == -1 && $limit == -1) ? "" : " LIMIT $from,$limit";
		$whereClause = "`clubId`='".Singleton::create("NullConverter")->fromDOMtoDB($clubId)."'".$limitStr;
		if(parent::$dbCache->hasFinder('PingpongTeam', $whereClause)) {
			return parent::$dbCache->getFinder('PingpongTeam', $whereClause);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE $whereClause");
		$result = $this->getAsObjects($result->getResult());
		parent::$dbCache->setFinder('PingpongTeam', $whereClause, $result);
		return $result;
	}

	public function findByPrimaryKey($teamId) {
		if(parent::$dbCache->hasSingle("PingpongTeam", $teamId)) {
			return parent::$dbCache->getSingle("PingpongTeam", $teamId);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE teamId='".addslashes($teamId)."'");
		if($result->isEmpty()) {
			throw new NoSuchPingpongTeamException($teamId);
		}
		$result = $this->getAsObject($result->getSingleRow());
		parent::$dbCache->setSingle("PingpongTeam", $teamId, $result);
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
		parent::$dbCache->resetEntity('PingpongTeam');
		parent::$dbCache->resetSingle("PingpongTeam", $teamId);
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
		parent::$dbCache->resetEntity("PingpongTeam");
		parent::$dbCache->setSingle("PingpongTeam", $pk, $result);
		return $result;
	}

	public function findAll($from, $limit) {
		if(parent::$dbCache->hasAll('PingpongTeam', $from, $limit)) {
			return parent::$dbCache->getAll('PingpongTeam', $from, $limit);
		}
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE."  LIMIT $from,$limit")->getResult();
		$objects = $this->getAsObjects($rows);
		parent::$dbCache->setAll('PingpongTeam', $objects, $from, $limit);
		return $objects;
	}

	public function count() {
		if(parent::$dbCache->hasAll('PingpongTeam', -1, -1)) {
			return count(parent::$dbCache->getAll('PingpongTeam', -1, -1));
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