<?php
abstract class TeacherModel extends Model {

	protected $teacherId;

	public function getTeacherId() {
		return $this->teacherId;
	}

	public function setTeacherId($teacherId) {
		$this->teacherId = $teacherId;
	}

	protected $name;

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getStudents($from=0, $limit=9999999999) {
		return StudentServiceUtil::findByTeacherId($this->teacherId, $from, $limit);
	}

}
?>