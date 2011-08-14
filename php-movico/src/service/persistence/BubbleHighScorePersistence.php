<?php
class BubbleHighScorePersistence extends Persistence {

	const TABLE = "movico_bubble_hscore";

	public function findByPrimaryKey($hscoreId) {
		if(parent::$dbCache->hasSingle("BubbleHighScore", $hscoreId)) {
			return parent::$dbCache->getSingle("BubbleHighScore", $hscoreId);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE hscoreId='".addslashes($hscoreId)."'");
		if($result->isEmpty()) {
			throw new NoSuchBubbleHighScoreException($hscoreId);
		}
		$result = $this->getAsObject($result->getSingleRow());
		parent::$dbCache->setSingle("BubbleHighScore", $hscoreId, $result);
		return $result;
	}

	public function create($hscoreId) {
		$obj = new BubbleHighScore();
		$obj->setHscoreId($hscoreId);
		$obj->setNew(true);
		return $obj;
	}

	public function remove($hscoreId) {
		$this->findByPrimaryKey($hscoreId);
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE hscoreId='".addslashes($hscoreId)."'");
		parent::$dbCache->resetEntity('BubbleHighScore');
		parent::$dbCache->resetSingle("BubbleHighScore", $hscoreId);
	}

	public function update(BubbleHighScore $object) {
		$q = "UPDATE ".self::TABLE." SET `name`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."', `playDate`='".Singleton::create("DateConverter")->fromDOMtoDB($object->getPlayDate())."', `seconds`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getSeconds())."' WHERE hscoreId='".addslashes($object->getHscoreId())."'";
		$pk = $object->getHscoreId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`name`, `playDate`, `seconds`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."', '".Singleton::create("DateConverter")->fromDOMtoDB($object->getPlayDate())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getSeconds())."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`name`, `playDate`, `seconds`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getHscoreId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."', '".Singleton::create("DateConverter")->fromDOMtoDB($object->getPlayDate())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getSeconds())."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT hscoreId from ".self::TABLE." ORDER BY hscoreId DESC limit 1")->getSingleton();
		}
		$result = $this->findByPrimaryKey($pk);
		parent::$dbCache->resetEntity("BubbleHighScore");
		parent::$dbCache->setSingle("BubbleHighScore", $pk, $result);
		return $result;
	}

	public function findAll($from, $limit) {
		if(parent::$dbCache->hasAll('BubbleHighScore')) {
			return parent::$dbCache->getAll('BubbleHighScore');
		}
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE." ORDER BY `seconds` asc LIMIT $from,$limit")->getResult();
		$objects = $this->getAsObjects($rows);
		parent::$dbCache->setAll('BubbleHighScore', $objects);
		return $objects;
	}

	public function count() {
		if(parent::$dbCache->hasAll('BubbleHighScore')) {
			return count(parent::$dbCache->getAll('BubbleHighScore'));
		}
		return $this->db->selectQuery("SELECT COUNT(*) FROM ".self::TABLE)->getSingleton();
	}

	protected function getAsObject($row) {
		$result = new BubbleHighScore();
		$result->setNew(false);
		$result->setHscoreId(Singleton::create("NullConverter")->fromDBtoDOM($row["hscoreId"]));
		$result->setName(Singleton::create("NullConverter")->fromDBtoDOM($row["name"]));
		$result->setPlayDate(Singleton::create("DateConverter")->fromDBtoDOM($row["playDate"]));
		$result->setSeconds(Singleton::create("NullConverter")->fromDBtoDOM($row["seconds"]));
		return $result;
	}

}
?>