<?php
abstract class PingpongPlayerModel extends Model {

	private $playerId;

	public function getPlayerId() {
		return $this->playerId;
	}

	public function setPlayerId($playerId) {
		$this->playerId = $playerId;
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

	private $street;

	public function getStreet() {
		return $this->street;
	}

	public function setStreet($street) {
		$this->street = $street;
	}

	private $place;

	public function getPlace() {
		return $this->place;
	}

	public function setPlace($place) {
		$this->place = $place;
	}

	private $memberNo;

	public function getMemberNo() {
		return $this->memberNo;
	}

	public function setMemberNo($memberNo) {
		$this->memberNo = $memberNo;
	}

	private $startYear;

	public function getStartYear() {
		return $this->startYear;
	}

	public function setStartYear($startYear) {
		$this->startYear = $startYear;
	}

	private $ranking;

	public function getRanking() {
		return $this->ranking;
	}

	public function setRanking($ranking) {
		$this->ranking = $ranking;
	}

	private $phone;

	public function getPhone() {
		return $this->phone;
	}

	public function setPhone($phone) {
		$this->phone = $phone;
	}

	private $emailAddress;

	public function getEmailAddress() {
		return $this->emailAddress;
	}

	public function setEmailAddress($emailAddress) {
		$this->emailAddress = $emailAddress;
	}

	private $recreation;

	public function isRecreation() {
		return $this->recreation;
	}

	public function setRecreation($recreation) {
		$this->recreation = $recreation;
	}

	private $active;

	public function isActive() {
		return $this->active;
	}

	public function setActive($active) {
		$this->active = $active;
	}

}
?>