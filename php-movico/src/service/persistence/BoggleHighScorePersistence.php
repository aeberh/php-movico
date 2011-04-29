<?php
class BoggleHighScorePersistence extends Persistence {

	const TABLE = "movico_boggle_hscore";

	public function findByPrimaryKey($hscoreId) {
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE hscoreId='".addslashes($hscoreId)."'");
		if($result->isEmpty()) {
			throw new NoSuchBoggleHighScoreException($hscoreId);
		}
		return $this->getAsObject($result->getSingleRow());
	}

	public function create($hscoreId) {
		$obj = new BoggleHighScore();
		$obj->setHscoreId($hscoreId);
		$obj->setNew(true);
		return $obj;
	}

	public function remove($hscoreId) {
		$this->findByPrimaryKey($hscoreId);
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE hscoreId='".addslashes($hscoreId)."'");
	}

	public function update(BoggleHighScore $object) {
		$q = "UPDATE ".self::TABLE." SET `name`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getName()))."', `points`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getPoints()))."', `playDate`='".addslashes(Singleton::create("DateConverter")->fromDOMtoDB($object->getPlayDate()))."' WHERE hscoreId='".addslashes($object->getHscoreId())."'";
		$pk = $object->getHscoreId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`name`, `points`, `playDate`) VALUES ('".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getName()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getPoints()))."', '".addslashes(Singleton::create("DateConverter")->fromDOMtoDB($object->getPlayDate()))."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`name`, `points`, `playDate`) VALUES ('".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getHscoreId()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getName()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getPoints()))."', '".addslashes(Singleton::create("DateConverter")->fromDOMtoDB($object->getPlayDate()))."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT hscoreId from ".self::TABLE." ORDER BY hscoreId DESC limit 1")->getSingleton();
		}
		return $this->findByPrimaryKey($pk);
	}

	public function findAll($from, $limit) {
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE." ORDER BY `points` desc LIMIT $from,$limit")->getResult();
		return $this->getAsObjects($rows);
	}

	public function count() {
		return $this->db->selectQuery("SELECT COUNT(*) FROM ".self::TABLE)->getSingleton();
	}

	protected function getAsObject($row) {
		$result = new BoggleHighScore();
		$result->setNew(false);
		$result->setHscoreId(Singleton::create("NullConverter")->fromDBtoDOM($row["hscoreId"]));
		$result->setName(Singleton::create("NullConverter")->fromDBtoDOM($row["name"]));
		$result->setPoints(Singleton::create("NullConverter")->fromDBtoDOM($row["points"]));
		$result->setPlayDate(Singleton::create("DateConverter")->fromDBtoDOM($row["playDate"]));
		return $result;
	}

}
?>