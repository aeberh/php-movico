<?php
class WishListPersistence extends Persistence {

	const TABLE = "wishlist";

	public function findByName($name, $from=-1, $limit=-1) {
		$limitStr = ($from == -1 && $limit == -1) ? "" : " LIMIT $from,$limit";
		$whereClause = "`name`='".Singleton::create("NullConverter")->fromDOMtoDB($name)."'".$limitStr;
		if(parent::$dbCache->hasFinder('WishList', $whereClause)) {
			return parent::$dbCache->getFinder('WishList', $whereClause);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE $whereClause");
		if($result->isEmpty()) {
			throw new NoSuchWishListException();
		}
		$result = $this->getAsObject($result->getSingleRow());
		parent::$dbCache->setFinder('WishList', $whereClause, $result);
		return $result;
	}

	public function deleteByName($name) {
		$whereClause = "`name`='".Singleton::create("NullConverter")->fromDOMtoDB($name)."'";
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE $whereClause");
		parent::$dbCache->resetEntity("WishList");
	}

	public function findByPrimaryKey($id) {
		if(parent::$dbCache->hasSingle("WishList", $id)) {
			return parent::$dbCache->getSingle("WishList", $id);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE id='".addslashes($id)."'");
		if($result->isEmpty()) {
			throw new NoSuchWishListException($id);
		}
		$result = $this->getAsObject($result->getSingleRow());
		parent::$dbCache->setSingle("WishList", $id, $result);
		return $result;
	}

	public function create($id) {
		$obj = new WishList();
		$obj->setId($id);
		$obj->setNew(true);
		return $obj;
	}

	public function remove($id) {
		$this->findByPrimaryKey($id);
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE id='".addslashes($id)."'");
		parent::$dbCache->resetEntity('WishList');
		parent::$dbCache->resetSingle("WishList", $id);
	}

	public function update(WishList $object) {
		$q = "UPDATE ".self::TABLE." SET `name`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."', `list`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getList())."', `updateDate`='".Singleton::create("DateConverter")->fromDOMtoDB($object->getUpdateDate())."' WHERE id='".addslashes($object->getId())."'";
		$pk = $object->getId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`name`, `list`, `updateDate`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getList())."', '".Singleton::create("DateConverter")->fromDOMtoDB($object->getUpdateDate())."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`name`, `list`, `updateDate`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getList())."', '".Singleton::create("DateConverter")->fromDOMtoDB($object->getUpdateDate())."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT id from ".self::TABLE." ORDER BY id DESC limit 1")->getSingleton();
		}
		$result = $this->findByPrimaryKey($pk);
		parent::$dbCache->resetEntity("WishList");
		parent::$dbCache->setSingle("WishList", $pk, $result);
		return $result;
	}

	public function findAll($from, $limit) {
		if(parent::$dbCache->hasAll('WishList', $from, $limit)) {
			return parent::$dbCache->getAll('WishList', $from, $limit);
		}
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE."  LIMIT $from,$limit")->getResult();
		$objects = $this->getAsObjects($rows);
		parent::$dbCache->setAll('WishList', $objects, $from, $limit);
		return $objects;
	}

	public function count() {
		if(parent::$dbCache->hasAll('WishList', -1, -1)) {
			return count(parent::$dbCache->getAll('WishList', -1, -1));
		}
		return $this->db->selectQuery("SELECT COUNT(*) FROM ".self::TABLE)->getSingleton();
	}

	protected function getAsObject($row) {
		$result = new WishList();
		$result->setNew(false);
		$result->setId(Singleton::create("NullConverter")->fromDBtoDOM($row["id"]));
		$result->setName(Singleton::create("NullConverter")->fromDBtoDOM($row["name"]));
		$result->setList(Singleton::create("NullConverter")->fromDBtoDOM($row["list"]));
		$result->setUpdateDate(Singleton::create("DateConverter")->fromDBtoDOM($row["updateDate"]));
		return $result;
	}

}
?>