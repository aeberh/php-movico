<?php
class TeacherPersistence extends Persistence {

	const TABLE = "movico_teacher";

	public function findByPrimaryKey($teacherId) {
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE teacherId='".addslashes($teacherId)."'");
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
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE teacherId='".addslashes($teacherId)."'");
	}

	public function update(Teacher $object) {
		$q = "UPDATE ".self::TABLE." SET `name`='".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getName()))."' WHERE teacherId='".addslashes($object->getTeacherId())."'";
		$pk = $object->getTeacherId();
		if($object->isNew()) {
			if(empty($pk)) {
				$q = "INSERT INTO ".self::TABLE." (`name`) VALUES ('".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getName()))."')";
			} else {
				$q = "INSERT INTO ".self::TABLE." (`name`) VALUES ('".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getTeacherId()))."', '".addslashes(Singleton::create("NullConverter")->fromDOMtoDB($object->getName()))."')";
			}
		}
		$this->db->updateQuery($q);
		if(empty($pk)) {
			$pk = $this->db->selectQuery("SELECT teacherId from ".self::TABLE." ORDER BY teacherId DESC limit 1")->getSingleton();
		}
		return $this->findByPrimaryKey($pk);
	}

	public function findAll() {
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE." ORDER BY `name` asc")->getResult();
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

	public function findByStudentId($studentId) {
		$rows = $this->db->selectQuery("SELECT t.* FROM movico_students_teachers mapping,".self::TABLE." t WHERE mapping.studentId='$studentId' AND mapping.teacherId=t.teacherId ")->getResult();
		return $this->getAsObjects($rows);
	}

	public function setStudents($teacherId, $studentIds) {
		$this->db->updateQuery("DELETE FROM movico_students_teachers WHERE teacherId='$teacherId'");
		if(empty($studentIds)) {
			return;
		}
		$insertValues = array();
		foreach($studentIds as $studentId) {
			$insertValues[] = "('$teacherId', '$studentId')";
		}
		$this->db->updateQuery("INSERT INTO movico_students_teachers (teacherId, studentId) VALUES ".implode(", ", $insertValues));
	}

}
?>