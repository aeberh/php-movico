<?php
class PlayerPersistence extends Persistence {

	const TABLE = "movico_player";

	public function findByPrimaryKey($playerId) {
		if(parent::$dbCache->hasSingle("Player", $playerId)) {
			return parent::$dbCache->getSingle("Player", $playerId);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE playerId='".addslashes($playerId)."'");
		if($result->isEmpty()) {
			throw new NoSuchPlayerException($playerId);
		}
		$result = $this->getAsObject($result->getSingleRow());
		parent::$dbCache->setSingle("Player", $playerId, $result);
		return $result;
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
		parent::$dbCache->resetEntity('Player');
		parent::$dbCache->resetSingle("Player", $playerId);
	}

	public function update(Player $object) {
		$q = "UPDATE ".self::TABLE." SET `name`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."', `teamId`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getTeamId())."' WHERE playerId='".addslashes($object->getPlayerId())."'";
		$pk = $object->getPlayerId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`name`, `teamId`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getTeamId())."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`name`, `teamId`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getPlayerId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getTeamId())."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT playerId from ".self::TABLE." ORDER BY playerId DESC limit 1")->getSingleton();
		}
		$result = $this->findByPrimaryKey($pk);
		parent::$dbCache->resetEntity("Player");
		parent::$dbCache->setSingle("Player", $pk, $result);
		return $result;
	}

	public function findAll($from, $limit) {
		if(parent::$dbCache->hasAll('Player')) {
			return parent::$dbCache->getAll('Player');
		}
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE."  LIMIT $from,$limit")->getResult();
		$objects = $this->getAsObjects($rows);
		parent::$dbCache->setAll('Player', $objects);
		return $objects;
	}

	public function count() {
		if(parent::$dbCache->hasAll('Player')) {
			return count(parent::$dbCache->getAll('Player'));
		}
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