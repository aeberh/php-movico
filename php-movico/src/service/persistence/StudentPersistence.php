<?php
class StudentPersistence extends Persistence {

	const TABLE = "movico_student";

	public function findByPrimaryKey($studentId) {
		if(parent::$dbCache->hasSingle("Student", $studentId)) {
			return parent::$dbCache->getSingle("Student", $studentId);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE studentId='".addslashes($studentId)."'");
		if($result->isEmpty()) {
			throw new NoSuchStudentException($studentId);
		}
		$result = $this->getAsObject($result->getSingleRow());
		parent::$dbCache->setSingle("Student", $studentId, $result);
		return $result;
	}

	public function create($studentId) {
		$obj = new Student();
		$obj->setStudentId($studentId);
		$obj->setNew(true);
		return $obj;
	}

	public function remove($studentId) {
		$this->findByPrimaryKey($studentId);
		$this->db->updateQuery("DELETE FROM ".self::TABLE." WHERE studentId='".addslashes($studentId)."'");
		parent::$dbCache->resetEntity('Student');
		parent::$dbCache->resetSingle("Student", $studentId);
	}

	public function update(Student $object) {
		$q = "UPDATE ".self::TABLE." SET `name`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."' WHERE studentId='".addslashes($object->getStudentId())."'";
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
		$result = $this->findByPrimaryKey($pk);
		parent::$dbCache->resetEntity("Student");
		parent::$dbCache->setSingle("Student", $pk, $result);
		return $result;
	}

	public function findAll($from, $limit) {
		if(parent::$dbCache->hasAll('Student')) {
			return parent::$dbCache->getAll('Student');
		}
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE."  LIMIT $from,$limit")->getResult();
		$objects = $this->getAsObjects($rows);
		parent::$dbCache->setAll('Student', $objects);
		return $objects;
	}

	public function count() {
		if(parent::$dbCache->hasAll('Student')) {
			return count(parent::$dbCache->getAll('Student'));
		}
		return $this->db->selectQuery("SELECT COUNT(*) FROM ".self::TABLE)->getSingleton();
	}

	protected function getAsObject($row) {
		$result = new Student();
		$result->setNew(false);
		$result->setStudentId(Singleton::create("NullConverter")->fromDBtoDOM($row["studentId"]));
		$result->setName(Singleton::create("NullConverter")->fromDBtoDOM($row["name"]));
		return $result;
	}

	public function findByTeacherId($teacherId, $from, $limit) {
		$rows = $this->db->selectQuery("SELECT t.* FROM movico_students_teachers mapping,".self::TABLE." t WHERE mapping.teacherId='$teacherId' AND mapping.studentId=t.studentId ORDER BY `name` asc LIMIT $from,$limit")->getResult();
		return $this->getAsObjects($rows);
	}

	public function setTeachers($studentId, $teacherIds) {
		$this->db->updateQuery("DELETE FROM movico_students_teachers WHERE studentId='$studentId'");
		if(empty($teacherIds)) {
			return;
		}
		$insertValues = array();
		foreach($teacherIds as $teacherId) {
			$insertValues[] = "('$studentId', '$teacherId')";
		}
		$this->db->updateQuery("INSERT INTO movico_students_teachers (studentId, teacherId) VALUES ".implode(", ", $insertValues));
	}

}
?>