<?php
class TeacherServiceBase {

	public function createTeacher($pk=0) {
		return $this->getPersistence()->create($pk);
	}

	public function getTeacher($pk) {
		return $this->getPersistence()->findByPrimaryKey($pk);
	}

	public function updateTeacher(Teacher $object) {
		return $this->getPersistence()->update($object);
	}

	public function deleteTeacher($pk) {
		$this->getPersistence()->remove($pk);
	}

	public function getTeachers() {
		return $this->getPersistence()->findAll();
	}

	public function countTeachers() {
		return $this->getPersistence()->count();
	}

	private function getPersistence() {
		return Singleton::create("TeacherPersistence");
	}

}
?>