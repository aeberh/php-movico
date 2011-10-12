<?php
class GameParticipancePersistence extends Persistence {

	const TABLE = "GameParticipance";

	public function findByGameAndTeam($gameId, $teamId, $from=-1, $limit=-1) {
		$limitStr = ($from == -1 && $limit == -1) ? "" : " LIMIT $from,$limit";
		$whereClause = "`gameId`='".Singleton::create("NullConverter")->fromDOMtoDB($gameId)."' AND `teamId`='".Singleton::create("NullConverter")->fromDOMtoDB($teamId)."'".$limitStr;
		if(parent::$dbCache->hasFinder('GameParticipance', $whereClause)) {
			return parent::$dbCache->getFinder('GameParticipance', $whereClause);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE $whereClause");
		$result = $this->getAsObjects($result->getResult());
		parent::$dbCache->setFinder('GameParticipance', $whereClause, $result);
		return $result;
	}

	public function deleteByGameAndTeam($gameId, $teamId) {
		$whereClause = "`gameId`='".Singleton::create("NullConverter")->fromDOMtoDB($gameId)."' AND `teamId`='".Singleton::create("NullConverter")->fromDOMtoDB($teamId)."'";
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE $whereClause");
		parent::$dbCache->resetEntity("GameParticipance");
	}

	public function findByPrimaryKey($partId) {
		if(parent::$dbCache->hasSingle("GameParticipance", $partId)) {
			return parent::$dbCache->getSingle("GameParticipance", $partId);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE partId='".addslashes($partId)."'");
		if($result->isEmpty()) {
			throw new NoSuchGameParticipanceException($partId);
		}
		$result = $this->getAsObject($result->getSingleRow());
		parent::$dbCache->setSingle("GameParticipance", $partId, $result);
		return $result;
	}

	public function create($partId) {
		$obj = new GameParticipance();
		$obj->setPartId($partId);
		$obj->setNew(true);
		return $obj;
	}

	public function remove($partId) {
		$this->findByPrimaryKey($partId);
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE partId='".addslashes($partId)."'");
		parent::$dbCache->resetEntity('GameParticipance');
		parent::$dbCache->resetSingle("GameParticipance", $partId);
	}

	public function update(GameParticipance $object) {
		$q = "UPDATE ".self::TABLE." SET `gameId`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getGameId())."', `teamId`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getTeamId())."', `playerId`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getPlayerId())."' WHERE partId='".addslashes($object->getPartId())."'";
		$pk = $object->getPartId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`gameId`, `teamId`, `playerId`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getGameId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getTeamId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getPlayerId())."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`gameId`, `teamId`, `playerId`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getPartId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getGameId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getTeamId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getPlayerId())."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT partId from ".self::TABLE." ORDER BY partId DESC limit 1")->getSingleton();
		}
		$result = $this->findByPrimaryKey($pk);
		parent::$dbCache->resetEntity("GameParticipance");
		parent::$dbCache->setSingle("GameParticipance", $pk, $result);
		return $result;
	}

	public function findAll($from, $limit) {
		if(parent::$dbCache->hasAll('GameParticipance', $from, $limit)) {
			return parent::$dbCache->getAll('GameParticipance', $from, $limit);
		}
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE."  LIMIT $from,$limit")->getResult();
		$objects = $this->getAsObjects($rows);
		parent::$dbCache->setAll('GameParticipance', $objects, $from, $limit);
		return $objects;
	}

	public function count() {
		if(parent::$dbCache->hasAll('GameParticipance', -1, -1)) {
			return count(parent::$dbCache->getAll('GameParticipance', -1, -1));
		}
		return $this->db->selectQuery("SELECT COUNT(*) FROM ".self::TABLE)->getSingleton();
	}

	protected function getAsObject($row) {
		$result = new GameParticipance();
		$result->setNew(false);
		$result->setPartId(Singleton::create("NullConverter")->fromDBtoDOM($row["partId"]));
		$result->setGameId(Singleton::create("NullConverter")->fromDBtoDOM($row["gameId"]));
		$result->setTeamId(Singleton::create("NullConverter")->fromDBtoDOM($row["teamId"]));
		$result->setPlayerId(Singleton::create("NullConverter")->fromDBtoDOM($row["playerId"]));
		return $result;
	}

}
?>