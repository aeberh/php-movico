<?php
class StudentService extends StudentServiceBase {

	public function create($name) {
		$student = $this->createStudent();
		$student->setName($name);
		return $this->updateStudent($student);
	}
	
}
?>