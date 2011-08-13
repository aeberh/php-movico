<?php
class PingpongClubPersistence extends Persistence {

	const TABLE = "PingpongClub";

	public function findByName($name, $from=-1, $limit=-1) {
		$limitStr = ($from == -1 && $limit == -1) ? "" : " LIMIT $from,$limit";
		$whereClause = "`name`='".Singleton::create("NullConverter")->fromDOMtoDB($name)."'ORDER BY `shortName` asc".$limitStr;
		if(parent::$dbCache->hasFinder('PingpongClub', $whereClause)) {
			return parent::$dbCache->getFinder('PingpongClub', $whereClause);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE $whereClause");
		if($result->isEmpty()) {
			throw new NoSuchPingpongClubException();
		}
		$result = $this->getAsObject($result->getSingleRow());
		parent::$dbCache->setFinder('PingpongClub', $whereClause, $result);
		return $result;
	}

	public function findByShortName($shortName, $from=-1, $limit=-1) {
		$limitStr = ($from == -1 && $limit == -1) ? "" : " LIMIT $from,$limit";
		$whereClause = "`shortName`='".Singleton::create("NullConverter")->fromDOMtoDB($shortName)."'ORDER BY `shortName` asc".$limitStr;
		if(parent::$dbCache->hasFinder('PingpongClub', $whereClause)) {
			return parent::$dbCache->getFinder('PingpongClub', $whereClause);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE $whereClause");
		if($result->isEmpty()) {
			throw new NoSuchPingpongClubException();
		}
		$result = $this->getAsObject($result->getSingleRow());
		parent::$dbCache->setFinder('PingpongClub', $whereClause, $result);
		return $result;
	}

	public function findByPrimaryKey($clubId) {
		if(parent::$dbCache->hasSingle("PingpongClub", $clubId)) {
			return parent::$dbCache->getSingle("PingpongClub", $clubId);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE clubId='".addslashes($clubId)."'");
		if($result->isEmpty()) {
			throw new NoSuchPingpongClubException($clubId);
		}
		$result = $this->getAsObject($result->getSingleRow());
		parent::$dbCache->setSingle("PingpongClub", $clubId, $result);
		return $result;
	}

	public function create($clubId) {
		$obj = new PingpongClub();
		$obj->setClubId($clubId);
		$obj->setNew(true);
		return $obj;
	}

	public function remove($clubId) {
		$this->findByPrimaryKey($clubId);
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE clubId='".addslashes($clubId)."'");
		parent::$dbCache->resetEntity('PingpongClub');
		parent::$dbCache->resetSingle("PingpongClub", $clubId);
	}

	public function update(PingpongClub $object) {
		$q = "UPDATE ".self::TABLE." SET `number`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getNumber())."', `shortName`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getShortName())."', `name`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."', `building`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getBuilding())."', `street`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getStreet())."', `place`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getPlace())."', `distance`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getDistance())."', `phone`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getPhone())."' WHERE clubId='".addslashes($object->getClubId())."'";
		$pk = $object->getClubId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`number`, `shortName`, `name`, `building`, `street`, `place`, `distance`, `phone`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getNumber())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getShortName())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getBuilding())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getStreet())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getPlace())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getDistance())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getPhone())."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`number`, `shortName`, `name`, `building`, `street`, `place`, `distance`, `phone`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getClubId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getNumber())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getShortName())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getBuilding())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getStreet())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getPlace())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getDistance())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getPhone())."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT clubId from ".self::TABLE." ORDER BY clubId DESC limit 1")->getSingleton();
		}
		$result = $this->findByPrimaryKey($pk);
		parent::$dbCache->resetEntity("PingpongClub");
		parent::$dbCache->setSingle("PingpongClub", $pk, $result);
		return $result;
	}

	public function findAll($from, $limit) {
		if(parent::$dbCache->hasAll('PingpongClub')) {
			return parent::$dbCache->getAll('PingpongClub');
		}
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE." ORDER BY `shortName` asc LIMIT $from,$limit")->getResult();
		$objects = $this->getAsObjects($rows);
		parent::$dbCache->setAll('PingpongClub', $objects);
		return $objects;
	}

	public function count() {
		if(parent::$dbCache->hasAll('PingpongClub')) {
			return count(parent::$dbCache->getAll('PingpongClub'));
		}
		return $this->db->selectQuery("SELECT COUNT(*) FROM ".self::TABLE)->getSingleton();
	}

	protected function getAsObject($row) {
		$result = new PingpongClub();
		$result->setNew(false);
		$result->setClubId(Singleton::create("NullConverter")->fromDBtoDOM($row["clubId"]));
		$result->setNumber(Singleton::create("NullConverter")->fromDBtoDOM($row["number"]));
		$result->setShortName(Singleton::create("NullConverter")->fromDBtoDOM($row["shortName"]));
		$result->setName(Singleton::create("NullConverter")->fromDBtoDOM($row["name"]));
		$result->setBuilding(Singleton::create("NullConverter")->fromDBtoDOM($row["building"]));
		$result->setStreet(Singleton::create("NullConverter")->fromDBtoDOM($row["street"]));
		$result->setPlace(Singleton::create("NullConverter")->fromDBtoDOM($row["place"]));
		$result->setDistance(Singleton::create("NullConverter")->fromDBtoDOM($row["distance"]));
		$result->setPhone(Singleton::create("NullConverter")->fromDBtoDOM($row["phone"]));
		return $result;
	}

}
?>