<?php
class UserPersistence extends Persistence {

	const TABLE = "movico_user";

	public function findByPrimaryKey($id) {
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE id='".addslashes($id)."'");
		if($result->isEmpty()) {
			throw new NoSuchUserException($id);
		}
		return $this->getAsObject($result->getSingleRow());
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
	}

	public function update(User $object) {
		$q = "UPDATE ".self::TABLE." SET `firstName`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getFirstName()))."', `lastName`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getLastName()))."', `createDate`='".addslashes(Singleton::create("DateConverter")->fromDOMtoDB($object->getCreateDate()))."', `default`='".addslashes(Singleton::create("BooleanConverter")->fromDOMtoDB($object->isDefault()))."' WHERE id='".addslashes($object->getId())."'";
		$pk = $object->getId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`firstName`, `lastName`, `createDate`, `default`) VALUES ('".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getFirstName()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getLastName()))."', '".addslashes(Singleton::create("DateConverter")->fromDOMtoDB($object->getCreateDate()))."', '".addslashes(Singleton::create("BooleanConverter")->fromDOMtoDB($object->isDefault()))."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`firstName`, `lastName`, `createDate`, `default`) VALUES ('".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getId()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getFirstName()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getLastName()))."', '".addslashes(Singleton::create("DateConverter")->fromDOMtoDB($object->getCreateDate()))."', '".addslashes(Singleton::create("BooleanConverter")->fromDOMtoDB($object->isDefault()))."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT id from ".self::TABLE." ORDER BY id DESC limit 1")->getSingleton();
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