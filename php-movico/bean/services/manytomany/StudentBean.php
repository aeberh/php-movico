<?
class StudentBean extends RequestBean {
	
	private $name;
	
	public function create() {
		StudentServiceUtil::create($this->name);
		return null;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function getStudents() {
		return StudentServiceUtil::getStudents();
	}
	
	public function getAllStudents() {
		return ArrayUtil::toIndexedArray($this->getStudents(), "studentId", "name");
	}
	
}
?>