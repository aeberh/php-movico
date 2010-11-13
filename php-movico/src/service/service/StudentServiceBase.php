<?php
class StudentServiceBase {

	public function createStudent($pk=0) {
		return $this->getPersistence()->create($pk);
	}

	public function getStudent($pk) {
		return $this->getPersistence()->findByPrimaryKey($pk);
	}

	public function updateStudent(Student $object) {
		return $this->getPersistence()->update($object);
	}

	public function deleteStudent($pk) {
		$this->getPersistence()->remove($pk);
	}

	public function getStudents() {
		return $this->getPersistence()->findAll();
	}

	public function countStudents() {
		return $this->getPersistence()->count();
	}

	private function getPersistence() {
		return Singleton::create("StudentPersistence");
	}

	public function findByTeacherId($teacherId) {
		return $this->getPersistence()->findByTeacherId($teacherId);
	}

	public function setTeachers($studentId, $teacherIds) {
		$this->getPersistence()->setTeachers($studentId, $teacherIds);
	}

}
?>