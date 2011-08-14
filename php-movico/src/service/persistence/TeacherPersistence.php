<?php
class TeacherPersistence extends Persistence {

	const TABLE = "movico_teacher";

	public function findByPrimaryKey($teacherId) {
		if(parent::$dbCache->hasSingle("Teacher", $teacherId)) {
			return parent::$dbCache->getSingle("Teacher", $teacherId);
		}
		$result = $this->db->selectQuery("SELECT * FROM ".self::TABLE." WHERE teacherId='".addslashes($teacherId)."'");
		if($result->isEmpty()) {
			throw new NoSuchTeacherException($teacherId);
		}
		$result = $this->getAsObject($result->getSingleRow());
		parent::$dbCache->setSingle("Teacher", $teacherId, $result);
		return $result;
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
		parent::$dbCache->resetEntity('Teacher');
		parent::$dbCache->resetSingle("Teacher", $teacherId);
	}

	public function update(Teacher $object) {
		$q = "UPDATE ".self::TABLE." SET `name`='".Singleton::create("NullConverter")->fromDOMtoDB($object->getName())."' WHERE teacherId='".addslashes($object->getTeacherId())."'";
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
		$result = $this->findByPrimaryKey($pk);
		parent::$dbCache->resetEntity("Teacher");
		parent::$dbCache->setSingle("Teacher", $pk, $result);
		return $result;
	}

	public function findAll($from, $limit) {
		if(parent::$dbCache->hasAll('Teacher')) {
			return parent::$dbCache->getAll('Teacher');
		}
		$rows = $this->db->selectQuery("SELECT * FROM ".self::TABLE." ORDER BY `name` asc LIMIT $from,$limit")->getResult();
		$objects = $this->getAsObjects($rows);
		parent::$dbCache->setAll('Teacher', $objects);
		return $objects;
	}

	public function count() {
		if(parent::$dbCache->hasAll('Teacher')) {
			return count(parent::$dbCache->getAll('Teacher'));
		}
		return $this->db->selectQuery("SELECT COUNT(*) FROM ".self::TABLE)->getSingleton();
	}

	protected function getAsObject($row) {
		$result = new Teacher();
		$result->setNew(false);
		$result->setTeacherId(Singleton::create("NullConverter")->fromDBtoDOM($row["teacherId"]));
		$result->setName(Singleton::create("NullConverter")->fromDBtoDOM($row["name"]));
		return $result;
	}

	public function findByStudentId($studentId, $from, $limit) {
		$rows = $this->db->selectQuery("SELECT t.* FROM movico_students_teachers mapping,".self::TABLE." t WHERE mapping.studentId='$studentId' AND mapping.teacherId=t.teacherId  LIMIT $from,$limit")->getResult();
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