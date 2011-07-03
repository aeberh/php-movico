<?php
class PingpongMatchPersistence extends Persistence {

	const TABLE = "PingpongMatch";

	public function findByPrimaryKey($matchId) {
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE matchId='".addslashes($matchId)."'");
		if($result->isEmpty()) {
			throw new NoSuchPingpongMatchException($matchId);
		}
		return $this->getAsObject($result->getSingleRow());
	}

	public function create($matchId) {
		$obj = new PingpongMatch();
		$obj->setMatchId($matchId);
		$obj->setNew(true);
		return $obj;
	}

	public function remove($matchId) {
		$this->findByPrimaryKey($matchId);
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE matchId='".addslashes($matchId)."'");
	}

	public function update(PingpongMatch $object) {
		$q = "UPDATE ".self::TABLE." SET `date`='".addslashes(Singleton::create("DateConverter")->fromDOMtoDB($object->getDate()))."', `homeTeamId`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getHomeTeamId()))."', `outTeamId`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getOutTeamId()))."', `homeTeamPoints`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getHomeTeamPoints()))."', `outTeamPoints`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getOutTeamPoints()))."', `review`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getReview()))."' WHERE matchId='".addslashes($object->getMatchId())."'";
		$pk = $object->getMatchId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`date`, `homeTeamId`, `outTeamId`, `homeTeamPoints`, `outTeamPoints`, `review`) VALUES ('".addslashes(Singleton::create("DateConverter")->fromDOMtoDB($object->getDate()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getHomeTeamId()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getOutTeamId()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getHomeTeamPoints()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getOutTeamPoints()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getReview()))."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`date`, `homeTeamId`, `outTeamId`, `homeTeamPoints`, `outTeamPoints`, `review`) VALUES ('".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getMatchId()))."', '".addslashes(Singleton::create("DateConverter")->fromDOMtoDB($object->getDate()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getHomeTeamId()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getOutTeamId()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getHomeTeamPoints()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getOutTeamPoints()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getReview()))."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT matchId from ".self::TABLE." ORDER BY matchId DESC limit 1")->getSingleton();
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
		$result = new PingpongMatch();
		$result->setNew(false);
		$result->setMatchId(Singleton::create("NullConverter")->fromDBtoDOM($row["matchId"]));
		$result->setDate(Singleton::create("DateConverter")->fromDBtoDOM($row["date"]));
		$result->setHomeTeamId(Singleton::create("NullConverter")->fromDBtoDOM($row["homeTeamId"]));
		$result->setOutTeamId(Singleton::create("NullConverter")->fromDBtoDOM($row["outTeamId"]));
		$result->setHomeTeamPoints(Singleton::create("NullConverter")->fromDBtoDOM($row["homeTeamPoints"]));
		$result->setOutTeamPoints(Singleton::create("NullConverter")->fromDBtoDOM($row["outTeamPoints"]));
		$result->setReview(Singleton::create("NullConverter")->fromDBtoDOM($row["review"]));
		return $result;
	}

}
?>