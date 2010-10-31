<?php
class PlayerPersistence extends Persistence {

	const TABLE = "Player";

	public function findByPrimaryKey($playerId) {
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE playerId='$playerId'");
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
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE playerId='$playerId'");
	}

	public function update(Player $object) {
		$q = "UPDATE ".self::TABLE." SET  WHERE playerId='{$object->getPlayerId()}'";
		$pk = $object->getPlayerId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." () VALUES ('')";
			} else {
				$q = "INSERT INTO ".self::TABLE." () VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getPlayerId())."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT playerId from ".self::TABLE." ORDER BY playerId DESC limit 1")->getSingleton();
		}
		return $this->findByPrimaryKey($pk);
	}

	public function findAll() {
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE." ")->getResult();
		return $this->getAsObjects($rows);
	}

	public function count() {
		return $this->db->selectQuery("SELECT COUNT(*) FROM ".self::TABLE)->getSingleton();
	}

	protected function getAsObject($row) {
		$result = new Player();
		$result->setNew(false);
		$result->setPlayerId(Singleton::create("NullConverter")->fromDBtoDOM($row["playerId"]));
		return $result;
	}

}
?>