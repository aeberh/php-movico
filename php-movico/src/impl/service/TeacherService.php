<?php
class TeacherService extends TeacherServiceBase {

	public function create($name) {
		$teacher = $this->createTeacher();
		$teacher->setName($name);
		return $this->updateTeacher($teacher);
	}
	
}
?>