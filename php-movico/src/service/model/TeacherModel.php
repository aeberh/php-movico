<?php
abstract class TeacherModel extends Model {

	private $teacherId;

	public function getTeacherId() {
		return $this->teacherId;
	}

	public function setTeacherId($teacherId) {
		$this->teacherId = $teacherId;
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