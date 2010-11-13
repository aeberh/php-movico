<?php
class StudentPersistence extends Persistence {

	const TABLE = "movico_student";

	public function findByPrimaryKey($studentId) {
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE studentId='$studentId'");
		if($result->isEmpty()) {
			throw new NoSuchStudentException($studentId);
		}
		return $this->getAsObject($result->getSingleRow());
	}

	public function create($studentId) {
		$obj = new Student();
		$obj->setStudentId($studentId);
		$obj->setNew(true);
		return $obj;
	}

	public function remove($studentId) {
		$this->findByPrimaryKey($studentId);
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE studentId='$studentId'");
	}

	public function update(Student $object) {
		$q = "UPDATE ".self::TABLE." SET `name`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."' WHERE studentId='{$object->getStudentId()}'";
		$pk = $object->getStudentId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`name`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`name`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getStudentId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT studentId from ".self::TABLE." ORDER BY studentId DESC limit 1")->getSingleton();
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
		$result = new Student();
		$result->setNew(false);
		$result->setStudentId(Singleton::create("NullConverter")->fromDBtoDOM($row["studentId"]));
		$result->setName(Singleton::create("NullConverter")->fromDBtoDOM($row["name"]));
		return $result;
	}

}
?>