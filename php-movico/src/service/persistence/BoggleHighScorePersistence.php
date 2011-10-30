<?php
class BoggleHighScorePersistence extends Persistence {

	const TABLE = "movico_boggle_hscore";

	public function findByLang($lang, $from=-1, $limit=-1) {
		$limitStr = ($from == -1 && $limit == -1) ? "" : " LIMIT $from,$limit";
		$whereClause = "`lang`='".Singleton::create("NullConverter")->fromDOMtoDB($lang)."'ORDER BY `points` desc".$limitStr;
		if(parent::$dbCache->hasFinder('BoggleHighScore', $whereClause)) {
			return parent::$dbCache->getFinder('BoggleHighScore', $whereClause);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE $whereClause");
		$result = $this->getAsObjects($result->getResult());
		parent::$dbCache->setFinder('BoggleHighScore', $whereClause, $result);
		return $result;
	}

	public function deleteByLang($lang) {
		$whereClause = "`lang`='".Singleton::create("NullConverter")->fromDOMtoDB($lang)."'";
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE $whereClause");
		parent::$dbCache->resetEntity("BoggleHighScore");
	}

	public function findByPrimaryKey($hscoreId) {
		if(parent::$dbCache->hasSingle("BoggleHighScore", $hscoreId)) {
			return parent::$dbCache->getSingle("BoggleHighScore", $hscoreId);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE hscoreId='".addslashes($hscoreId)."'");
		if($result->isEmpty()) {
			throw new NoSuchBoggleHighScoreException($hscoreId);
		}
		$result = $this->getAsObject($result->getSingleRow());
		parent::$dbCache->setSingle("BoggleHighScore", $hscoreId, $result);
		return $result;
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
		parent::$dbCache->resetEntity('BoggleHighScore');
		parent::$dbCache->resetSingle("BoggleHighScore", $hscoreId);
	}

	public function update(BoggleHighScore $object) {
		$q = "UPDATE ".self::TABLE." SET `name`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."', `lang`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getLang())."', `grid`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getGrid())."', `points`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getPoints())."', `playDate`='".Singleton::create("DateConverter")->fromDOMtoDB($object->getPlayDate())."' WHERE hscoreId='".addslashes($object->getHscoreId())."'";
		$pk = $object->getHscoreId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`name`, `lang`, `grid`, `points`, `playDate`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getLang())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getGrid())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getPoints())."', '".Singleton::create("DateConverter")->fromDOMtoDB($object->getPlayDate())."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`name`, `lang`, `grid`, `points`, `playDate`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getHscoreId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getLang())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getGrid())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getPoints())."', '".Singleton::create("DateConverter")->fromDOMtoDB($object->getPlayDate())."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT hscoreId from ".self::TABLE." ORDER BY hscoreId DESC limit 1")->getSingleton();
		}
		$result = $this->findByPrimaryKey($pk);
		parent::$dbCache->resetEntity("BoggleHighScore");
		parent::$dbCache->setSingle("BoggleHighScore", $pk, $result);
		return $result;
	}

	public function findAll($from, $limit) {
		if(parent::$dbCache->hasAll('BoggleHighScore', $from, $limit)) {
			return parent::$dbCache->getAll('BoggleHighScore', $from, $limit);
		}
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE." ORDER BY `points` desc LIMIT $from,$limit")->getResult();
		$objects = $this->getAsObjects($rows);
		parent::$dbCache->setAll('BoggleHighScore', $objects, $from, $limit);
		return $objects;
	}

	public function count() {
		if(parent::$dbCache->hasAll('BoggleHighScore', -1, -1)) {
			return count(parent::$dbCache->getAll('BoggleHighScore', -1, -1));
		}
		return $this->db->selectQuery("SELECT COUNT(*) FROM ".self::TABLE)->getSingleton();
	}

	protected function getAsObject($row) {
		$result = new BoggleHighScore();
		$result->setNew(false);
		$result->setHscoreId(Singleton::create("NullConverter")->fromDBtoDOM($row["hscoreId"]));
		$result->setName(Singleton::create("NullConverter")->fromDBtoDOM($row["name"]));
		$result->setLang(Singleton::create("NullConverter")->fromDBtoDOM($row["lang"]));
		$result->setGrid(Singleton::create("NullConverter")->fromDBtoDOM($row["grid"]));
		$result->setPoints(Singleton::create("NullConverter")->fromDBtoDOM($row["points"]));
		$result->setPlayDate(Singleton::create("DateConverter")->fromDBtoDOM($row["playDate"]));
		return $result;
	}

}
?>