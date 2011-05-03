<?php
class BoggleGamePersistence extends Persistence {

	const TABLE = "boggle_game";

	public function findByStarted($started, $from=-1, $limit=-1) {
		$limitStr = ($from == -1 && $limit == -1) ? "" : " LIMIT $from,$limit";
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE `started`='$started'$limitStr");
		return $this->getAsObjects($result->getResult());
	}

	public function findByPrimaryKey($gameId) {
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE gameId='".addslashes($gameId)."'");
		if($result->isEmpty()) {
			throw new NoSuchBoggleGameException($gameId);
		}
		return $this->getAsObject($result->getSingleRow());
	}

	public function create($gameId) {
		$obj = new BoggleGame();
		$obj->setGameId($gameId);
		$obj->setNew(true);
		return $obj;
	}

	public function remove($gameId) {
		$this->findByPrimaryKey($gameId);
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE gameId='".addslashes($gameId)."'");
	}

	public function update(BoggleGame $object) {
		$q = "UPDATE ".self::TABLE." SET `started`='".addslashes(Singleton::create("BooleanConverter")->fromDOMtoDB($object->isStarted()))."' WHERE gameId='".addslashes($object->getGameId())."'";
		$pk = $object->getGameId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`started`) VALUES ('".addslashes(Singleton::create("BooleanConverter")->fromDOMtoDB($object->isStarted()))."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`started`) VALUES ('".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getGameId()))."', '".addslashes(Singleton::create("BooleanConverter")->fromDOMtoDB($object->isStarted()))."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT gameId from ".self::TABLE." ORDER BY gameId DESC limit 1")->getSingleton();
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
		$result = new BoggleGame();
		$result->setNew(false);
		$result->setGameId(Singleton::create("NullConverter")->fromDBtoDOM($row["gameId"]));
		$result->setStarted(Singleton::create("BooleanConverter")->fromDBtoDOM($row["started"]));
		return $result;
	}

}
?>