<?php
class NewsItemPersistence extends Persistence {

	const TABLE = "NewsItem";

	public function findByPrimaryKey($itemId) {
		if(parent::$dbCache->hasSingle("NewsItem", $itemId)) {
			return parent::$dbCache->getSingle("NewsItem", $itemId);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE itemId='".addslashes($itemId)."'");
		if($result->isEmpty()) {
			throw new NoSuchNewsItemException($itemId);
		}
		$result = $this->getAsObject($result->getSingleRow());
		parent::$dbCache->setSingle("NewsItem", $itemId, $result);
		return $result;
	}

	public function create($itemId) {
		$obj = new NewsItem();
		$obj->setItemId($itemId);
		$obj->setNew(true);
		return $obj;
	}

	public function remove($itemId) {
		$this->findByPrimaryKey($itemId);
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE itemId='".addslashes($itemId)."'");
		parent::$dbCache->resetEntity('NewsItem');
		parent::$dbCache->resetSingle("NewsItem", $itemId);
	}

	public function update(NewsItem $object) {
		$q = "UPDATE ".self::TABLE." SET `date`='".Singleton::create("DateConverter")->fromDOMtoDB($object->getDate())."', `title`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getTitle())."', `content`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getContent())."', `creatorId`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getCreatorId())."' WHERE itemId='".addslashes($object->getItemId())."'";
		$pk = $object->getItemId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`date`, `title`, `content`, `creatorId`) VALUES ('".Singleton::create("DateConverter")->fromDOMtoDB($object->getDate())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getTitle())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getContent())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getCreatorId())."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`date`, `title`, `content`, `creatorId`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getItemId())."', '".Singleton::create("DateConverter")->fromDOMtoDB($object->getDate())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getTitle())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getContent())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getCreatorId())."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT itemId from ".self::TABLE." ORDER BY itemId DESC limit 1")->getSingleton();
		}
		$result = $this->findByPrimaryKey($pk);
		parent::$dbCache->resetEntity("NewsItem");
		parent::$dbCache->setSingle("NewsItem", $pk, $result);
		return $result;
	}

	public function findAll($from, $limit) {
		if(parent::$dbCache->hasAll('NewsItem')) {
			return parent::$dbCache->getAll('NewsItem');
		}
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE." ORDER BY `date` desc LIMIT $from,$limit")->getResult();
		$objects = $this->getAsObjects($rows);
		parent::$dbCache->setAll('NewsItem', $objects);
		return $objects;
	}

	public function count() {
		if(parent::$dbCache->hasAll('NewsItem')) {
			return count(parent::$dbCache->getAll('NewsItem'));
		}
		return $this->db->selectQuery("SELECT COUNT(*) FROM ".self::TABLE)->getSingleton();
	}

	protected function getAsObject($row) {
		$result = new NewsItem();
		$result->setNew(false);
		$result->setItemId(Singleton::create("NullConverter")->fromDBtoDOM($row["itemId"]));
		$result->setDate(Singleton::create("DateConverter")->fromDBtoDOM($row["date"]));
		$result->setTitle(Singleton::create("NullConverter")->fromDBtoDOM($row["title"]));
		$result->setContent(Singleton::create("NullConverter")->fromDBtoDOM($row["content"]));
		$result->setCreatorId(Singleton::create("NullConverter")->fromDBtoDOM($row["creatorId"]));
		return $result;
	}

}
?>