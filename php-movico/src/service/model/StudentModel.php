<?php
abstract class StudentModel extends Model {

	private $studentId;

	public function getStudentId() {
		return $this->studentId;
	}

	public function setStudentId($studentId) {
		$this->studentId = $studentId;
	}

	private $name;

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

}
?>