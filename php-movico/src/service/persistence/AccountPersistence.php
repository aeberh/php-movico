<?php
class AccountPersistence extends Persistence {

	const TABLE = "Account";

	public function findByEmailAddress($emailAddress, $from=-1, $limit=-1) {
		$limitStr = ($from == -1 && $limit == -1) ? "" : " LIMIT $from,$limit";
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE `emailAddress`='".Singleton::create("NullConverter")->fromDOMtoDB($emailAddress)."'$limitStr");
		if($result->isEmpty()) {
			throw new NoSuchAccountException();
		}
		return $this->getAsObject($result->getSingleRow());
	}

	public function findByPrimaryKey($accountId) {
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE accountId='".addslashes($accountId)."'");
		if($result->isEmpty()) {
			throw new NoSuchAccountException($accountId);
		}
		return $this->getAsObject($result->getSingleRow());
	}

	public function create($accountId) {
		$obj = new Account();
		$obj->setAccountId($accountId);
		$obj->setNew(true);
		return $obj;
	}

	public function remove($accountId) {
		$this->findByPrimaryKey($accountId);
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE accountId='".addslashes($accountId)."'");
	}

	public function update(Account $object) {
		$q = "UPDATE ".self::TABLE." SET `emailAddress`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getEmailAddress()))."', `password`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getPassword()))."' WHERE accountId='".addslashes($object->getAccountId())."'";
		$pk = $object->getAccountId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`emailAddress`, `password`) VALUES ('".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getEmailAddress()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getPassword()))."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`emailAddress`, `password`) VALUES ('".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getAccountId()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getEmailAddress()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getPassword()))."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT accountId from ".self::TABLE." ORDER BY accountId DESC limit 1")->getSingleton();
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
		$result = new Account();
		$result->setNew(false);
		$result->setAccountId(Singleton::create("NullConverter")->fromDBtoDOM($row["accountId"]));
		$result->setEmailAddress(Singleton::create("NullConverter")->fromDBtoDOM($row["emailAddress"]));
		$result->setPassword(Singleton::create("NullConverter")->fromDBtoDOM($row["password"]));
		return $result;
	}

}
?>