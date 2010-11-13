<?php
class StudentServiceUtil {

	public static function create($name) {
		return self::getService()->create($name);
	}

	public static function findByTeacherId($teacherId) {
		return self::getService()->findByTeacherId($teacherId);
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

	public static function getStudents() {
		return self::getService()->getStudents();
	}

	public static function countStudents() {
		return self::getService()->countStudents();
	}

	private static function getService() {
		return Singleton::create("StudentService");
	}

}
?>