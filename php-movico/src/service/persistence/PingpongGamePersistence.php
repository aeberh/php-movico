<?php
class PingpongGamePersistence extends Persistence {

	const TABLE = "PingpongGame";

	public function findByAfterDate($date, $from=-1, $limit=-1) {
		$limitStr = ($from == -1 && $limit == -1) ? "" : " LIMIT $from,$limit";
		$whereClause = "`date`>'".Singleton::create("DateConverter")->fromDOMtoDB($date)."'ORDER BY `date` asc".$limitStr;
		if($this->dbCache->hasFinder('PingpongGame', $whereClause)) {
			return $this->dbCache->getFinder('PingpongGame', $whereClause);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE $whereClause");
		$result = $this->getAsObjects($result->getResult());
		$this->dbCache->setFinder('PingpongGame', $whereClause, $result);
		return $result;
	}

	public function findByBeforeDate($date, $from=-1, $limit=-1) {
		$limitStr = ($from == -1 && $limit == -1) ? "" : " LIMIT $from,$limit";
		$whereClause = "`date`<'".Singleton::create("DateConverter")->fromDOMtoDB($date)."'ORDER BY `date` desc".$limitStr;
		if($this->dbCache->hasFinder('PingpongGame', $whereClause)) {
			return $this->dbCache->getFinder('PingpongGame', $whereClause);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE $whereClause");
		$result = $this->getAsObjects($result->getResult());
		$this->dbCache->setFinder('PingpongGame', $whereClause, $result);
		return $result;
	}

	public function findByHomeTeam($homeTeamId, $from=-1, $limit=-1) {
		$limitStr = ($from == -1 && $limit == -1) ? "" : " LIMIT $from,$limit";
		$whereClause = "`homeTeamId`='".Singleton::create("NullConverter")->fromDOMtoDB($homeTeamId)."'ORDER BY `date` asc".$limitStr;
		if($this->dbCache->hasFinder('PingpongGame', $whereClause)) {
			return $this->dbCache->getFinder('PingpongGame', $whereClause);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE $whereClause");
		$result = $this->getAsObjects($result->getResult());
		$this->dbCache->setFinder('PingpongGame', $whereClause, $result);
		return $result;
	}

	public function findByOutTeam($outTeamId, $from=-1, $limit=-1) {
		$limitStr = ($from == -1 && $limit == -1) ? "" : " LIMIT $from,$limit";
		$whereClause = "`outTeamId`='".Singleton::create("NullConverter")->fromDOMtoDB($outTeamId)."'ORDER BY `date` asc".$limitStr;
		if($this->dbCache->hasFinder('PingpongGame', $whereClause)) {
			return $this->dbCache->getFinder('PingpongGame', $whereClause);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE $whereClause");
		$result = $this->getAsObjects($result->getResult());
		$this->dbCache->setFinder('PingpongGame', $whereClause, $result);
		return $result;
	}

	public function findByPrimaryKey($gameId) {
		if($this->dbCache->hasSingle("PingpongGame", $gameId)) {
			return $this->dbCache->getSingle("PingpongGame", $gameId);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE gameId='".addslashes($gameId)."'");
		if($result->isEmpty()) {
			throw new NoSuchPingpongGameException($gameId);
		}
		$result = $this->getAsObject($result->getSingleRow());
		$this->dbCache->setSingle("PingpongGame", $gameId, $result);
		return $result;
	}

	public function create($gameId) {
		$obj = new PingpongGame();
		$obj->setGameId($gameId);
		$obj->setNew(true);
		return $obj;
	}

	public function remove($gameId) {
		$this->findByPrimaryKey($gameId);
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE gameId='".addslashes($gameId)."'");
		$this->dbCache->resetEntity('PingpongGame');
		$this->dbCache->resetSingle("PingpongGame", $gameId, $result);
	}

	public function update(PingpongGame $object) {
		$q = "UPDATE ".self::TABLE." SET `date`='".Singleton::create("DateConverter")->fromDOMtoDB($object->getDate())."', `homeTeamId`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getHomeTeamId())."', `outTeamId`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getOutTeamId())."', `homeTeamPts`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getHomeTeamPts())."', `outTeamPts`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getOutTeamPts())."', `review`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getReview())."' WHERE gameId='".addslashes($object->getGameId())."'";
		$pk = $object->getGameId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`date`, `homeTeamId`, `outTeamId`, `homeTeamPts`, `outTeamPts`, `review`) VALUES ('".Singleton::create("DateConverter")->fromDOMtoDB($object->getDate())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getHomeTeamId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getOutTeamId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getHomeTeamPts())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getOutTeamPts())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getReview())."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`date`, `homeTeamId`, `outTeamId`, `homeTeamPts`, `outTeamPts`, `review`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getGameId())."', '".Singleton::create("DateConverter")->fromDOMtoDB($object->getDate())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getHomeTeamId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getOutTeamId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getHomeTeamPts())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getOutTeamPts())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getReview())."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT gameId from ".self::TABLE." ORDER BY gameId DESC limit 1")->getSingleton();
		}
		$result = $this->findByPrimaryKey($pk);
		$this->dbCache->resetEntity("PingpongGame");
		$this->dbCache->setSingle("PingpongGame", $pk, $result);
		return $result;
	}

	public function findAll($from, $limit) {
		if($this->dbCache->hasAll('PingpongGame')) {
			return $this->dbCache->getAll('PingpongGame');
		}
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE." ORDER BY `date` asc LIMIT $from,$limit")->getResult();
		$objects = $this->getAsObjects($rows);
		$this->dbCache->setAll('PingpongGame', $objects);
		return $objects;
	}

	public function count() {
		if($this->dbCache->hasAll('PingpongGame')) {
			return count($this->dbCache->getAll('PingpongGame'));
		}
		return $this->db->selectQuery("SELECT COUNT(*) FROM ".self::TABLE)->getSingleton();
	}

	protected function getAsObject($row) {
		$result = new PingpongGame();
		$result->setNew(false);
		$result->setGameId(Singleton::create("NullConverter")->fromDBtoDOM($row["gameId"]));
		$result->setDate(Singleton::create("DateConverter")->fromDBtoDOM($row["date"]));
		$result->setHomeTeamId(Singleton::create("NullConverter")->fromDBtoDOM($row["homeTeamId"]));
		$result->setOutTeamId(Singleton::create("NullConverter")->fromDBtoDOM($row["outTeamId"]));
		$result->setHomeTeamPts(Singleton::create("NullConverter")->fromDBtoDOM($row["homeTeamPts"]));
		$result->setOutTeamPts(Singleton::create("NullConverter")->fromDBtoDOM($row["outTeamPts"]));
		$result->setReview(Singleton::create("NullConverter")->fromDBtoDOM($row["review"]));
		return $result;
	}

}
?>