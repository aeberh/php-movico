<?php
class PlayerPersistence extends Persistence {

	const TABLE = "movico_player";

	public function findByPrimaryKey($playerId) {
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE playerId='".addslashes($playerId)."'");
		if($result->isEmpty()) {
			throw new NoSuchPlayerException($playerId);
		}
		return $this->getAsObject($result->getSingleRow());
	}

	public function create($playerId) {
		$obj = new Player();
		$obj->setPlayerId($playerId);
		$obj->setNew(true);
		return $obj;
	}

	public function remove($playerId) {
		$this->findByPrimaryKey($playerId);
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE playerId='".addslashes($playerId)."'");
	}

	public function update(Player $object) {
		$q = "UPDATE ".self::TABLE." SET `name`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getName()))."', `teamId`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getTeamId()))."' WHERE playerId='".addslashes($object->getPlayerId())."'";
		$pk = $object->getPlayerId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`name`, `teamId`) VALUES ('".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getName()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getTeamId()))."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`name`, `teamId`) VALUES ('".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getPlayerId()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getName()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getTeamId()))."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT playerId from ".self::TABLE." ORDER BY playerId DESC limit 1")->getSingleton();
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
		$result = new Player();
		$result->setNew(false);
		$result->setPlayerId(Singleton::create("NullConverter")->fromDBtoDOM($row["playerId"]));
		$result->setName(Singleton::create("NullConverter")->fromDBtoDOM($row["name"]));
		$result->setTeamId(Singleton::create("NullConverter")->fromDBtoDOM($row["teamId"]));
		return $result;
	}

	public function findByTeamId($teamId, $from=-1, $limit=-1) {
		$limitStr = ($from == -1 && $limit == -1) ? "" : " LIMIT $from,$limit";
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE teamId='$teamId' $limitStr")->getResult();
		return $this->getAsObjects($rows);
	}

}
?>