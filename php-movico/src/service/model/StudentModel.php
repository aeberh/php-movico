<?php
abstract class StudentModel extends Model {

	protected $studentId;

	public function getStudentId() {
		return $this->studentId;
	}

	public function setStudentId($studentId) {
		$this->studentId = $studentId;
	}

	protected $name;

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getTeachers($from=0, $limit=9999999999) {
		return TeacherServiceUtil::findByStudentId($this->studentId, $from, $limit);
	}

}
?>