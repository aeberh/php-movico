<?php
class TeacherServiceUtil {

	public static function create($name) {
		return self::getService()->create($name);
	}

	public static function findByStudentId($studentId, $from, $limit) {
		return self::getService()->findByStudentId($studentId, $from, $limit);
	}

	public static function setStudents($teacherId, $studentIds) {
		self::getService()->setStudents($teacherId, $studentIds);
	}

	public static function createTeacher($pk=0) {
		return self::getService()->createTeacher($pk);
	}

	public static function getTeacher($pk) {
		return self::getService()->getTeacher($pk);
	}

	public static function updateTeacher(Teacher $object) {
		return self::getService()->updateTeacher($object);
	}

	public static function deleteTeacher($pk) {
		self::getService()->deleteTeacher($pk);
	}

	public static function getTeachers($from=0, $limit=9999999999) {
		return self::getService()->getTeachers($from, $limit);
	}

	public static function countTeachers() {
		return self::getService()->countTeachers();
	}

	private static function getService() {
		return Singleton::create("TeacherService");
	}

}
?>