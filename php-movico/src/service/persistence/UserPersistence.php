<?php
class UserPersistence extends Persistence {

	const TABLE = "movico_user";

	public function findByPrimaryKey($id) {
		if(parent::$dbCache->hasSingle("User", $id)) {
			return parent::$dbCache->getSingle("User", $id);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE id='".addslashes($id)."'");
		if($result->isEmpty()) {
			throw new NoSuchUserException($id);
		}
		$result = $this->getAsObject($result->getSingleRow());
		parent::$dbCache->setSingle("User", $id, $result);
		return $result;
	}

	public function create($id) {
		$obj = new User();
		$obj->setId($id);
		$obj->setNew(true);
		return $obj;
	}

	public function remove($id) {
		$this->findByPrimaryKey($id);
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE id='".addslashes($id)."'");
		parent::$dbCache->resetEntity('User');
		parent::$dbCache->resetSingle("User", $id);
	}

	public function update(User $object) {
		$q = "UPDATE ".self::TABLE." SET `firstName`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getFirstName())."', `lastName`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getLastName())."', `createDate`='".Singleton::create("DateConverter")->fromDOMtoDB($object->getCreateDate())."', `default`='".Singleton::create("BooleanConverter")->fromDOMtoDB($object->isDefault())."' WHERE id='".addslashes($object->getId())."'";
		$pk = $object->getId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`firstName`, `lastName`, `createDate`, `default`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getFirstName())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getLastName())."', '".Singleton::create("DateConverter")->fromDOMtoDB($object->getCreateDate())."', '".Singleton::create("BooleanConverter")->fromDOMtoDB($object->isDefault())."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`firstName`, `lastName`, `createDate`, `default`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getFirstName())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getLastName())."', '".Singleton::create("DateConverter")->fromDOMtoDB($object->getCreateDate())."', '".Singleton::create("BooleanConverter")->fromDOMtoDB($object->isDefault())."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT id from ".self::TABLE." ORDER BY id DESC limit 1")->getSingleton();
		}
		$result = $this->findByPrimaryKey($pk);
		parent::$dbCache->resetEntity("User");
		parent::$dbCache->setSingle("User", $pk, $result);
		return $result;
	}

	public function findAll($from, $limit) {
		if(parent::$dbCache->hasAll('User', $from, $limit)) {
			return parent::$dbCache->getAll('User', $from, $limit);
		}
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE."  LIMIT $from,$limit")->getResult();
		$objects = $this->getAsObjects($rows);
		parent::$dbCache->setAll('User', $objects, $from, $limit);
		return $objects;
	}

	public function count() {
		if(parent::$dbCache->hasAll('User', -1, -1)) {
			return count(parent::$dbCache->getAll('User', -1, -1));
		}
		return $this->db->selectQuery("SELECT COUNT(*) FROM ".self::TABLE)->getSingleton();
	}

	protected function getAsObject($row) {
		$result = new User();
		$result->setNew(false);
		$result->setId(Singleton::create("NullConverter")->fromDBtoDOM($row["id"]));
		$result->setFirstName(Singleton::create("NullConverter")->fromDBtoDOM($row["firstName"]));
		$result->setLastName(Singleton::create("NullConverter")->fromDBtoDOM($row["lastName"]));
		$result->setCreateDate(Singleton::create("DateConverter")->fromDBtoDOM($row["createDate"]));
		$result->setDefault(Singleton::create("BooleanConverter")->fromDBtoDOM($row["default"]));
		return $result;
	}

}
?>