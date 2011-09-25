<?php
abstract class UserModel extends Model {

	protected $id;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	protected $firstName;

	public function getFirstName() {
		return $this->firstName;
	}

	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}

	protected $lastName;

	public function getLastName() {
		return $this->lastName;
	}

	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}

	protected $createDate;

	public function getCreateDate() {
		return $this->createDate;
	}

	public function setCreateDate($createDate) {
		$this->createDate = $createDate;
	}

	protected $default;

	public function isDefault() {
		return $this->default;
	}

	public function setDefault($default) {
		$this->default = $default;
	}

}
?>