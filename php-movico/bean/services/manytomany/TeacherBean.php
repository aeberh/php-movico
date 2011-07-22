<?
class TeacherBean extends RequestBean {
	
	private $name;
	private $studentIds;
	
	private $studentsVisible;
	private $teacherId;
	
	public function create() {
		TeacherServiceUtil::create($this->name);
		return null;
	}
	
	public function showStudents($teacherId) {
		$this->teacherId = $teacherId;
		$selected = TeacherServiceUtil::getTeacher($teacherId);
		$this->studentIds = ArrayUtil::toIndexedArray($selected->getStudents(), "studentId");
		$this->studentsVisible = true;
		return null;
	}
	
	public function updateStudents() {
		TeacherServiceUtil::setStudents($this->teacherId, $this->studentIds);
		$this->studentsVisible = true;
		return null;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function getStudentIds() {
		return $this->studentIds;
	}
	
	public function setStudentIds($studentIds) {
		$this->studentIds = $studentIds;
	}
	
	public function getTeachers() {
		return TeacherServiceUtil::getTeachers();
	}
	
	public function getStudentsVisible() {
		return $this->studentsVisible;
	}
	
	public function getTeacherId() {
		return $this->teacherId;
	}
	
	public function setTeacherId($teacherId) {
		$this->teacherId = $teacherId;
	}
	
	public function getAllTeachers() {
		return ArrayUtil::toIndexedArray($this->getTeachers(), "teacherId", "name");
	}
	
}
?>