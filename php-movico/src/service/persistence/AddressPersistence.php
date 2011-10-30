<?php
class AddressPersistence extends Persistence {

	const TABLE = "movico_address";

	public function findByPrimaryKey($addressId) {
		if(parent::$dbCache->hasSingle("Address", $addressId)) {
			return parent::$dbCache->getSingle("Address", $addressId);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE addressId='".addslashes($addressId)."'");
		if($result->isEmpty()) {
			throw new NoSuchAddressException($addressId);
		}
		$result = $this->getAsObject($result->getSingleRow());
		parent::$dbCache->setSingle("Address", $addressId, $result);
		return $result;
	}

	public function create($addressId) {
		$obj = new Address();
		$obj->setAddressId($addressId);
		$obj->setNew(true);
		return $obj;
	}

	public function remove($addressId) {
		$this->findByPrimaryKey($addressId);
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE addressId='".addslashes($addressId)."'");
		parent::$dbCache->resetEntity('Address');
		parent::$dbCache->resetSingle("Address", $addressId);
	}

	public function update(Address $object) {
		$q = "UPDATE ".self::TABLE." SET `street`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getStreet())."', `location`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getLocation())."' WHERE addressId='".addslashes($object->getAddressId())."'";
		$pk = $object->getAddressId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`street`, `location`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getStreet())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getLocation())."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`street`, `location`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getAddressId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getStreet())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getLocation())."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT addressId from ".self::TABLE." ORDER BY addressId DESC limit 1")->getSingleton();
		}
		$result = $this->findByPrimaryKey($pk);
		parent::$dbCache->resetEntity("Address");
		parent::$dbCache->setSingle("Address", $pk, $result);
		return $result;
	}

	public function findAll($from, $limit) {
		if(parent::$dbCache->hasAll('Address', $from, $limit)) {
			return parent::$dbCache->getAll('Address', $from, $limit);
		}
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE."  LIMIT $from,$limit")->getResult();
		$objects = $this->getAsObjects($rows);
		parent::$dbCache->setAll('Address', $objects, $from, $limit);
		return $objects;
	}

	public function count() {
		if(parent::$dbCache->hasAll('Address', -1, -1)) {
			return count(parent::$dbCache->getAll('Address', -1, -1));
		}
		return $this->db->selectQuery("SELECT COUNT(*) FROM ".self::TABLE)->getSingleton();
	}

	protected function getAsObject($row) {
		$result = new Address();
		$result->setNew(false);
		$result->setAddressId(Singleton::create("NullConverter")->fromDBtoDOM($row["addressId"]));
		$result->setStreet(Singleton::create("NullConverter")->fromDBtoDOM($row["street"]));
		$result->setLocation(Singleton::create("NullConverter")->fromDBtoDOM($row["location"]));
		return $result;
	}

}
?>