<?php
abstract class UserModel extends Model {

	private $id;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	private $firstName;

	public function getFirstName() {
		return $this->firstName;
	}

	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}

	private $lastName;

	public function getLastName() {
		return $this->lastName;
	}

	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}

	private $createDate;

	public function getCreateDate() {
		return $this->createDate;
	}

	public function setCreateDate($createDate) {
		$this->createDate = $createDate;
	}

	private $default;

	public function isDefault() {
		return $this->default;
	}

	public function setDefault($default) {
		$this->default = $default;
	}

}
?>