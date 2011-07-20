<?php
class PingpongGamePersistence extends Persistence {

	const TABLE = "PingpongGame";

	public function findByAfterDate($date, $from=-1, $limit=-1) {
		$limitStr = ($from == -1 && $limit == -1) ? "" : " LIMIT $from,$limit";
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE `date`>'".Singleton::create("DateConverter")->fromDOMtoDB($date)."'ORDER BY `date` asc$limitStr");
		return $this->getAsObjects($result->getResult());
	}

	public function findByBeforeDate($date, $from=-1, $limit=-1) {
		$limitStr = ($from == -1 && $limit == -1) ? "" : " LIMIT $from,$limit";
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE `date`$lt;'".Singleton::create("DateConverter")->fromDOMtoDB($date)."'ORDER BY `date` asc$limitStr");
		return $this->getAsObjects($result->getResult());
	}

	public function findByPrimaryKey($gameId) {
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE gameId='".addslashes($gameId)."'");
		if($result->isEmpty()) {
			throw new NoSuchPingpongGameException($gameId);
		}
		return $this->getAsObject($result->getSingleRow());
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
	}

	public function update(PingpongGame $object) {
		$q = "UPDATE ".self::TABLE." SET `date`='".addslashes(Singleton::create("DateConverter")->fromDOMtoDB($object->getDate()))."', `homeTeamId`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getHomeTeamId()))."', `outTeamId`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getOutTeamId()))."', `homeTeamPts`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getHomeTeamPts()))."', `outTeamPts`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getOutTeamPts()))."', `review`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getReview()))."' WHERE gameId='".addslashes($object->getGameId())."'";
		$pk = $object->getGameId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`date`, `homeTeamId`, `outTeamId`, `homeTeamPts`, `outTeamPts`, `review`) VALUES ('".addslashes(Singleton::create("DateConverter")->fromDOMtoDB($object->getDate()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getHomeTeamId()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getOutTeamId()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getHomeTeamPts()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getOutTeamPts()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getReview()))."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`date`, `homeTeamId`, `outTeamId`, `homeTeamPts`, `outTeamPts`, `review`) VALUES ('".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getGameId()))."', '".addslashes(Singleton::create("DateConverter")->fromDOMtoDB($object->getDate()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getHomeTeamId()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getOutTeamId()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getHomeTeamPts()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getOutTeamPts()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getReview()))."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT gameId from ".self::TABLE." ORDER BY gameId DESC limit 1")->getSingleton();
		}
		return $this->findByPrimaryKey($pk);
	}

	public function findAll($from, $limit) {
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE." ORDER BY `date` asc LIMIT $from,$limit")->getResult();
		return $this->getAsObjects($rows);
	}

	public function count() {
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