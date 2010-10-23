<?php
class UserPersistence extends Persistence {

	const TABLE = "User";

	public function findByPrimaryKey($id) {
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE id='$id'");
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
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE id='$id'");
	}

	public function update(User $object) {
		$q = "UPDATE ".self::TABLE." SET `firstName`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getFirstName())."', `lastName`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getLastName())."' WHERE id='{$object->getId()}'";
		$pk = $object->getId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`firstName`, `lastName`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getFirstName())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getLastName())."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`firstName`, `lastName`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getFirstName())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getLastName())."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT id from ".self::TABLE." ORDER BY id DESC limit 1")->getSingleton();
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
		$result = new User();
		$result->setNew(false);
		$result->setId(Singleton::create("NullConverter")->fromDBtoDOM($row["id"]));
		$result->setFirstName(Singleton::create("NullConverter")->fromDBtoDOM($row["firstName"]));
		$result->setLastName(Singleton::create("NullConverter")->fromDBtoDOM($row["lastName"]));
		return $result;
	}

}
?>