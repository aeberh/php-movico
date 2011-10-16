<?php
class PingpongPlayerPersistence extends Persistence {

	const TABLE = "PingpongPlayer";

	public function findByEmailAddress($emailAddress, $from=-1, $limit=-1) {
		$limitStr = ($from == -1 && $limit == -1) ? "" : " LIMIT $from,$limit";
		$whereClause = "`emailAddress`='".Singleton::create("NullConverter")->fromDOMtoDB($emailAddress)."'ORDER BY `ranking` asc, `lastName` asc, `firstName` asc".$limitStr;
		if(parent::$dbCache->hasFinder('PingpongPlayer', $whereClause)) {
			return parent::$dbCache->getFinder('PingpongPlayer', $whereClause);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE $whereClause");
		if($result->isEmpty()) {
			throw new NoSuchPingpongPlayerException();
		}
		$result = $this->getAsObject($result->getSingleRow());
		parent::$dbCache->setFinder('PingpongPlayer', $whereClause, $result);
		return $result;
	}

	public function deleteByEmailAddress($emailAddress) {
		$whereClause = "`emailAddress`='".Singleton::create("NullConverter")->fromDOMtoDB($emailAddress)."'";
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE $whereClause");
		parent::$dbCache->resetEntity("PingpongPlayer");
	}

	public function findByActive($active, $from=-1, $limit=-1) {
		$limitStr = ($from == -1 && $limit == -1) ? "" : " LIMIT $from,$limit";
		$whereClause = "`active`='".Singleton::create("BooleanConverter")->fromDOMtoDB($active)."'ORDER BY `ranking` asc, `lastName` asc, `firstName` asc".$limitStr;
		if(parent::$dbCache->hasFinder('PingpongPlayer', $whereClause)) {
			return parent::$dbCache->getFinder('PingpongPlayer', $whereClause);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE $whereClause");
		$result = $this->getAsObjects($result->getResult());
		parent::$dbCache->setFinder('PingpongPlayer', $whereClause, $result);
		return $result;
	}

	public function deleteByActive($active) {
		$whereClause = "`active`='".Singleton::create("BooleanConverter")->fromDOMtoDB($active)."'";
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE $whereClause");
		parent::$dbCache->resetEntity("PingpongPlayer");
	}

	public function findByLatest($active, $from=-1, $limit=-1) {
		$limitStr = ($from == -1 && $limit == -1) ? "" : " LIMIT $from,$limit";
		$whereClause = "`active`='".Singleton::create("BooleanConverter")->fromDOMtoDB($active)."'ORDER BY `memberNo` desc".$limitStr;
		if(parent::$dbCache->hasFinder('PingpongPlayer', $whereClause)) {
			return parent::$dbCache->getFinder('PingpongPlayer', $whereClause);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE $whereClause");
		$result = $this->getAsObjects($result->getResult());
		parent::$dbCache->setFinder('PingpongPlayer', $whereClause, $result);
		return $result;
	}

	public function deleteByLatest($active) {
		$whereClause = "`active`='".Singleton::create("BooleanConverter")->fromDOMtoDB($active)."'";
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE $whereClause");
		parent::$dbCache->resetEntity("PingpongPlayer");
	}

	public function findByPrimaryKey($playerId) {
		if(parent::$dbCache->hasSingle("PingpongPlayer", $playerId)) {
			return parent::$dbCache->getSingle("PingpongPlayer", $playerId);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE playerId='".addslashes($playerId)."'");
		if($result->isEmpty()) {
			throw new NoSuchPingpongPlayerException($playerId);
		}
		$result = $this->getAsObject($result->getSingleRow());
		parent::$dbCache->setSingle("PingpongPlayer", $playerId, $result);
		return $result;
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
		parent::$dbCache->resetEntity('PingpongPlayer');
		parent::$dbCache->resetSingle("PingpongPlayer", $playerId);
	}

	public function update(PingpongPlayer $object) {
		$q = "UPDATE ".self::TABLE." SET `firstName`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getFirstName())."', `lastName`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getLastName())."', `street`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getStreet())."', `place`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getPlace())."', `memberNo`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getMemberNo())."', `ranking`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getRanking())."', `phone`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getPhone())."', `mobile`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getMobile())."', `emailAddress`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getEmailAddress())."', `password`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getPassword())."', `recreation`='".Singleton::create("BooleanConverter")->fromDOMtoDB($object->isRecreation())."', `active`='".Singleton::create("BooleanConverter")->fromDOMtoDB($object->isActive())."' WHERE playerId='".addslashes($object->getPlayerId())."'";
		$pk = $object->getPlayerId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`firstName`, `lastName`, `street`, `place`, `memberNo`, `ranking`, `phone`, `mobile`, `emailAddress`, `password`, `recreation`, `active`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getFirstName())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getLastName())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getStreet())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getPlace())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getMemberNo())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getRanking())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getPhone())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getMobile())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getEmailAddress())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getPassword())."', '".Singleton::create("BooleanConverter")->fromDOMtoDB($object->isRecreation())."', '".Singleton::create("BooleanConverter")->fromDOMtoDB($object->isActive())."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`firstName`, `lastName`, `street`, `place`, `memberNo`, `ranking`, `phone`, `mobile`, `emailAddress`, `password`, `recreation`, `active`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getPlayerId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getFirstName())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getLastName())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getStreet())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getPlace())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getMemberNo())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getRanking())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getPhone())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getMobile())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getEmailAddress())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getPassword())."', '".Singleton::create("BooleanConverter")->fromDOMtoDB($object->isRecreation())."', '".Singleton::create("BooleanConverter")->fromDOMtoDB($object->isActive())."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT playerId from ".self::TABLE." ORDER BY playerId DESC limit 1")->getSingleton();
		}
		$result = $this->findByPrimaryKey($pk);
		parent::$dbCache->resetEntity("PingpongPlayer");
		parent::$dbCache->setSingle("PingpongPlayer", $pk, $result);
		return $result;
	}

	public function findAll($from, $limit) {
		if(parent::$dbCache->hasAll('PingpongPlayer', $from, $limit)) {
			return parent::$dbCache->getAll('PingpongPlayer', $from, $limit);
		}
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE." ORDER BY `ranking` asc, `lastName` asc, `firstName` asc LIMIT $from,$limit")->getResult();
		$objects = $this->getAsObjects($rows);
		parent::$dbCache->setAll('PingpongPlayer', $objects, $from, $limit);
		return $objects;
	}

	public function count() {
		if(parent::$dbCache->hasAll('PingpongPlayer', -1, -1)) {
			return count(parent::$dbCache->getAll('PingpongPlayer', -1, -1));
		}
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
		$result->setRanking(Singleton::create("NullConverter")->fromDBtoDOM($row["ranking"]));
		$result->setPhone(Singleton::create("NullConverter")->fromDBtoDOM($row["phone"]));
		$result->setMobile(Singleton::create("NullConverter")->fromDBtoDOM($row["mobile"]));
		$result->setEmailAddress(Singleton::create("NullConverter")->fromDBtoDOM($row["emailAddress"]));
		$result->setPassword(Singleton::create("NullConverter")->fromDBtoDOM($row["password"]));
		$result->setRecreation(Singleton::create("BooleanConverter")->fromDBtoDOM($row["recreation"]));
		$result->setActive(Singleton::create("BooleanConverter")->fromDBtoDOM($row["active"]));
		return $result;
	}

	public function findByRoleId($roleId, $from, $limit) {
		$rows = $this->db->selectQuery("SELECT t.* FROM Users_Roles mapping,".self::TABLE." t WHERE mapping.roleId='$roleId' AND mapping.playerId=t.playerId LIMIT $from,$limit")->getResult();
		return $this->getAsObjects($rows);
	}

	public function setRoles($playerId, $roleIds) {
		$this->db->updateQuery("DELETE FROM Users_Roles WHERE playerId='$playerId'");
		if(empty($roleIds)) {
			return;
		}
		$insertValues = array();
		foreach($roleIds as $roleId) {
			$insertValues[] = "('$playerId', '$roleId')";
		}
		$this->db->updateQuery("INSERT INTO Users_Roles (playerId, roleId) VALUES ".implode(", ", $insertValues));
	}

}
?>