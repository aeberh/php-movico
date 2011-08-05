<?php
class PingpongClubPersistence extends Persistence {

	const TABLE = "PingpongClub";

	public function findByName($name, $from=-1, $limit=-1) {
		$limitStr = ($from == -1 && $limit == -1) ? "" : " LIMIT $from,$limit";
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE `name`='".Singleton::create("NullConverter")->fromDOMtoDB($name)."'ORDER BY `shortName` asc$limitStr");
		if($result->isEmpty()) {
			throw new NoSuchPingpongClubException();
		}
		return $this->getAsObject($result->getSingleRow());
	}

	public function findByShortName($shortName, $from=-1, $limit=-1) {
		$limitStr = ($from == -1 && $limit == -1) ? "" : " LIMIT $from,$limit";
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE `shortName`='".Singleton::create("NullConverter")->fromDOMtoDB($shortName)."'ORDER BY `shortName` asc$limitStr");
		if($result->isEmpty()) {
			throw new NoSuchPingpongClubException();
		}
		return $this->getAsObject($result->getSingleRow());
	}

	public function findByPrimaryKey($clubId) {
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE clubId='".addslashes($clubId)."'");
		if($result->isEmpty()) {
			throw new NoSuchPingpongClubException($clubId);
		}
		return $this->getAsObject($result->getSingleRow());
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
	}

	public function update(PingpongClub $object) {
		$q = "UPDATE ".self::TABLE." SET `number`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getNumber()))."', `shortName`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getShortName()))."', `name`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getName()))."', `building`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getBuilding()))."', `street`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getStreet()))."', `place`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getPlace()))."', `distance`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getDistance()))."', `phone`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getPhone()))."' WHERE clubId='".addslashes($object->getClubId())."'";
		$pk = $object->getClubId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`number`, `shortName`, `name`, `building`, `street`, `place`, `distance`, `phone`) VALUES ('".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getNumber()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getShortName()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getName()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getBuilding()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getStreet()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getPlace()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getDistance()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getPhone()))."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`number`, `shortName`, `name`, `building`, `street`, `place`, `distance`, `phone`) VALUES ('".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getClubId()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getNumber()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getShortName()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getName()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getBuilding()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getStreet()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getPlace()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getDistance()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getPhone()))."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT clubId from ".self::TABLE." ORDER BY clubId DESC limit 1")->getSingleton();
		}
		return $this->findByPrimaryKey($pk);
	}

	public function findAll($from, $limit) {
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE." ORDER BY `shortName` asc LIMIT $from,$limit")->getResult();
		return $this->getAsObjects($rows);
	}

	public function count() {
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