<?php
class PingpongPlayerPersistence extends Persistence {

	const TABLE = "PingpongPlayer";

	public function findByPrimaryKey($playerId) {
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE playerId='".addslashes($playerId)."'");
		if($result->isEmpty()) {
			throw new NoSuchPingpongPlayerException($playerId);
		}
		return $this->getAsObject($result->getSingleRow());
	}

	public function create($playerId) {
		$obj = new PingpongPlayer();
		$obj->setPlayerId($playerId);
		$obj->setNew(true);
		return $obj;
	}

	public function remove($playerId) {
		$this->findByPrimaryKey($playerId);
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE playerId='".addslashes($playerId)."'");
	}

	public function update(PingpongPlayer $object) {
		$q = "UPDATE ".self::TABLE." SET `firstName`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getFirstName()))."', `lastName`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getLastName()))."', `street`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getStreet()))."', `place`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getPlace()))."', `memberNo`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getMemberNo()))."', `startYear`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getStartYear()))."', `ranking`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getRanking()))."', `phone`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getPhone()))."', `emailAddress`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getEmailAddress()))."', `recreation`='".addslashes(Singleton::create("BooleanConverter")->fromDOMtoDB($object->isRecreation()))."', `active`='".addslashes(Singleton::create("BooleanConverter")->fromDOMtoDB($object->isActive()))."' WHERE playerId='".addslashes($object->getPlayerId())."'";
		$pk = $object->getPlayerId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`firstName`, `lastName`, `street`, `place`, `memberNo`, `startYear`, `ranking`, `phone`, `emailAddress`, `recreation`, `active`) VALUES ('".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getFirstName()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getLastName()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getStreet()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getPlace()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getMemberNo()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getStartYear()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getRanking()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getPhone()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getEmailAddress()))."', '".addslashes(Singleton::create("BooleanConverter")->fromDOMtoDB($object->isRecreation()))."', '".addslashes(Singleton::create("BooleanConverter")->fromDOMtoDB($object->isActive()))."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`firstName`, `lastName`, `street`, `place`, `memberNo`, `startYear`, `ranking`, `phone`, `emailAddress`, `recreation`, `active`) VALUES ('".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getPlayerId()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getFirstName()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getLastName()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getStreet()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getPlace()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getMemberNo()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getStartYear()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getRanking()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getPhone()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getEmailAddress()))."', '".addslashes(Singleton::create("BooleanConverter")->fromDOMtoDB($object->isRecreation()))."', '".addslashes(Singleton::create("BooleanConverter")->fromDOMtoDB($object->isActive()))."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT playerId from ".self::TABLE." ORDER BY playerId DESC limit 1")->getSingleton();
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
		$result = new PingpongPlayer();
		$result->setNew(false);
		$result->setPlayerId(Singleton::create("NullConverter")->fromDBtoDOM($row["playerId"]));
		$result->setFirstName(Singleton::create("NullConverter")->fromDBtoDOM($row["firstName"]));
		$result->setLastName(Singleton::create("NullConverter")->fromDBtoDOM($row["lastName"]));
		$result->setStreet(Singleton::create("NullConverter")->fromDBtoDOM($row["street"]));
		$result->setPlace(Singleton::create("NullConverter")->fromDBtoDOM($row["place"]));
		$result->setMemberNo(Singleton::create("NullConverter")->fromDBtoDOM($row["memberNo"]));
		$result->setStartYear(Singleton::create("NullConverter")->fromDBtoDOM($row["startYear"]));
		$result->setRanking(Singleton::create("NullConverter")->fromDBtoDOM($row["ranking"]));
		$result->setPhone(Singleton::create("NullConverter")->fromDBtoDOM($row["phone"]));
		$result->setEmailAddress(Singleton::create("NullConverter")->fromDBtoDOM($row["emailAddress"]));
		$result->setRecreation(Singleton::create("BooleanConverter")->fromDBtoDOM($row["recreation"]));
		$result->setActive(Singleton::create("BooleanConverter")->fromDBtoDOM($row["active"]));
		return $result;
	}

}
?>