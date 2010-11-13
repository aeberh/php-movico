<?php
class TeacherPersistence extends Persistence {

	const TABLE = "movico_teacher";

	public function findByPrimaryKey($teacherId) {
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE teacherId='$teacherId'");
		if($result->isEmpty()) {
			throw new NoSuchTeacherException($teacherId);
		}
		return $this->getAsObject($result->getSingleRow());
	}

	public function create($teacherId) {
		$obj = new Teacher();
		$obj->setTeacherId($teacherId);
		$obj->setNew(true);
		return $obj;
	}

	public function remove($teacherId) {
		$this->findByPrimaryKey($teacherId);
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE teacherId='$teacherId'");
	}

	public function update(Teacher $object) {
		$q = "UPDATE ".self::TABLE." SET `name`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."' WHERE teacherId='{$object->getTeacherId()}'";
		$pk = $object->getTeacherId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`name`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`name`) VALUES ('".Singleton::create("NullConverter")->fromDOMtoDB($object->getTeacherId())."', '".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT teacherId from ".self::TABLE." ORDER BY teacherId DESC limit 1")->getSingleton();
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
		$result = new Teacher();
		$result->setNew(false);
		$result->setTeacherId(Singleton::create("NullConverter")->fromDBtoDOM($row["teacherId"]));
		$result->setName(Singleton::create("NullConverter")->fromDBtoDOM($row["name"]));
		return $result;
	}

}
?>