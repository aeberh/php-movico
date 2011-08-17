<?php
class NewsPersistence extends Persistence {

	const TABLE = "News";

	public function findByPrimaryKey($newsId) {
		if(parent::$dbCache->hasSingle("News", $newsId)) {
			return parent::$dbCache->getSingle("News", $newsId);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE newsId='".addslashes($newsId)."'");
		if($result->isEmpty()) {
			throw new NoSuchNewsException($newsId);
		}
		$result = $this->getAsObject($result->getSingleRow());
		parent::$dbCache->setSingle("News", $newsId, $result);
		return $result;
	}

	public function create($newsId) {
		$obj = new News();
		$obj->setNewsId($newsId);
		$obj->setNew(true);
		return $obj;
	}

	public function remove($newsId) {
		$this->findByPrimaryKey($newsId);
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE newsId='".addslashes($newsId)."'");
		parent::$dbCache->resetEntity('News');
		parent::$dbCache->resetSingle("News", $newsId);
	}

	public function update(News $object) {
		$q = "UPDATE ".self::TABLE." SET `date`='".Singleton::create("DateConverter")->fromDOMtoDB($object->getDate())."', `title`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getTitle())."', `content`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getContent())."', `creatorId`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getCreatorId())."' WHERE newsId='".addslashes($object->getNewsId())."'";
		$pk = $object->getNewsId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`date`, `title`, `content`, `creatorId`) VALUES ('".Singleton::create("DateConverter")->fromDOMtoDB($object->getDate())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getTitle())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getContent())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getCreatorId())."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`date`, `title`, `content`, `creatorId`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getNewsId())."', '".Singleton::create("DateConverter")->fromDOMtoDB($object->getDate())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getTitle())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getContent())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getCreatorId())."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT newsId from ".self::TABLE." ORDER BY newsId DESC limit 1")->getSingleton();
		}
		$result = $this->findByPrimaryKey($pk);
		parent::$dbCache->resetEntity("News");
		parent::$dbCache->setSingle("News", $pk, $result);
		return $result;
	}

	public function findAll($from, $limit) {
		if(parent::$dbCache->hasAll('News')) {
			return parent::$dbCache->getAll('News');
		}
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE."  LIMIT $from,$limit")->getResult();
		$objects = $this->getAsObjects($rows);
		parent::$dbCache->setAll('News', $objects);
		return $objects;
	}

	public function count() {
		if(parent::$dbCache->hasAll('News')) {
			return count(parent::$dbCache->getAll('News'));
		}
		return $this->db->selectQuery("SELECT COUNT(*) FROM ".self::TABLE)->getSingleton();
	}

	protected function getAsObject($row) {
		$result = new News();
		$result->setNew(false);
		$result->setNewsId(Singleton::create("NullConverter")->fromDBtoDOM($row["newsId"]));
		$result->setDate(Singleton::create("DateConverter")->fromDBtoDOM($row["date"]));
		$result->setTitle(Singleton::create("NullConverter")->fromDBtoDOM($row["title"]));
		$result->setContent(Singleton::create("NullConverter")->fromDBtoDOM($row["content"]));
		$result->setCreatorId(Singleton::create("NullConverter")->fromDBtoDOM($row["creatorId"]));
		return $result;
	}

}
?>