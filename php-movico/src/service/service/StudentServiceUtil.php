<?php
class StudentServiceUtil {

	public static function create($name) {
		return self::getService()->create($name);
	}

	public static function findByTeacherId($teacherId, $from, $limit) {
		return self::getService()->findByTeacherId($teacherId, $from, $limit);
	}

	public static function setTeachers($studentId, $teacherIds) {
		self::getService()->setTeachers($studentId, $teacherIds);
	}

	public static function createStudent($pk=0) {
		return self::getService()->createStudent($pk);
	}

	public static function getStudent($pk) {
		return self::getService()->getStudent($pk);
	}

	public static function updateStudent(Student $object) {
		return self::getService()->updateStudent($object);
	}

	public static function deleteStudent($pk) {
		self::getService()->deleteStudent($pk);
	}

	public static function getStudents($from=0, $limit=9999999999) {
		return self::getService()->getStudents($from, $limit);
	}

	public static function countStudents() {
		return self::getService()->countStudents();
	}

	private static function getService() {
		return Singleton::create("StudentService");
	}

}
?>