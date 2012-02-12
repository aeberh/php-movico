<?php
class StudentBean extends RequestBean {
	
	private $name;
	private $teacherIds;
	
	private $teachersVisible;
	private $studentId;
	
	public function create() {
		StudentServiceUtil::create($this->name);
		return null;
	}
	
	public function showTeachers($studentId) {
		$this->studentId = $studentId;
		$selected = StudentServiceUtil::getStudent($studentId);
		$this->teacherIds = ArrayUtil::toIndexedArray($selected->getTeachers(), "teacherId");
		$this->teachersVisible = true;
		return null;
	}
	
	public function updateTeachers() {
		StudentServiceUtil::setTeachers($this->studentId, $this->teacherIds);
		$this->teachersVisible = true;
		return null;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function getTeacherIds() {
		return $this->teacherIds;
	}
	
	public function setTeacherIds($teacherIds) {
		$this->teacherIds = $teacherIds;
	}
	
	public function getStudents() {
		return StudentServiceUtil::getStudents();
	}
	
	public function getTeachersVisible() {
		return $this->teachersVisible;
	}
	
	public function getStudentId() {
		return $this->studentId;
	}
	
	public function setStudentId($studentId) {
		$this->studentId = $studentId;
	}
	
	public function getAllStudents() {
		return ArrayUtil::toIndexedArray($this->getStudents(), "studentId", "name");
	}
	
}
?>