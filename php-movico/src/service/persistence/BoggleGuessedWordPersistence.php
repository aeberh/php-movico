<?php
class BoggleGuessedWordPersistence extends Persistence {

	const TABLE = "boggle_guessed_word";

	public function findByPrimaryKey($wordId) {
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE wordId='".addslashes($wordId)."'");
		if($result->isEmpty()) {
			throw new NoSuchBoggleGuessedWordException($wordId);
		}
		return $this->getAsObject($result->getSingleRow());
	}

	public function create($wordId) {
		$obj = new BoggleGuessedWord();
		$obj->setWordId($wordId);
		$obj->setNew(true);
		return $obj;
	}

	public function remove($wordId) {
		$this->findByPrimaryKey($wordId);
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE wordId='".addslashes($wordId)."'");
	}

	public function update(BoggleGuessedWord $object) {
		$q = "UPDATE ".self::TABLE." SET `word`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getWord()))."', `gameId`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getGameId()))."', `playerId`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getPlayerId()))."' WHERE wordId='".addslashes($object->getWordId())."'";
		$pk = $object->getWordId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`word`, `gameId`, `playerId`) VALUES ('".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getWord()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getGameId()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getPlayerId()))."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`word`, `gameId`, `playerId`) VALUES ('".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getWordId()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getWord()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getGameId()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getPlayerId()))."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT wordId from ".self::TABLE." ORDER BY wordId DESC limit 1")->getSingleton();
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
		$result = new BoggleGuessedWord();
		$result->setNew(false);
		$result->setWordId(Singleton::create("NullConverter")->fromDBtoDOM($row["wordId"]));
		$result->setWord(Singleton::create("NullConverter")->fromDBtoDOM($row["word"]));
		$result->setGameId(Singleton::create("NullConverter")->fromDBtoDOM($row["gameId"]));
		$result->setPlayerId(Singleton::create("NullConverter")->fromDBtoDOM($row["playerId"]));
		return $result;
	}

}
?>