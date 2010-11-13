<?
class TeacherBean extends RequestBean {
	
	private $name;
	private $students;
	
	private $studentsVisible;
	
	public function create() {
		TeacherServiceUtil::create($this->name);
		return null;
	}
	
	public function showStudents() {
		$this->students = $this->getSelectedTeacher()->getStudents();
		$this->studentsVisible = true;
		return null;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function getStudents() {
		return ArrayUtil::toIndexedArray($this->students, "studentId", "name");
	}
	
	public function getTeachers() {
		return TeacherServiceUtil::getTeachers();
	}
	
	public function getStudentsVisible() {
		return $this->studentsVisible;
	}
	
	public function getSelectedTeacher() {
		$teachers = $this->getTeachers();
		return $teachers[$this->getSelectedRowIndex()];
	}
	
}
?>