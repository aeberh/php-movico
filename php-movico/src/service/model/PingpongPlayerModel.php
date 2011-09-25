<?php
abstract class PingpongPlayerModel extends Model {

	protected $playerId;

	public function getPlayerId() {
		return $this->playerId;
	}

	public function setPlayerId($playerId) {
		$this->playerId = $playerId;
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

	protected $street;

	public function getStreet() {
		return $this->street;
	}

	public function setStreet($street) {
		$this->street = $street;
	}

	protected $place;

	public function getPlace() {
		return $this->place;
	}

	public function setPlace($place) {
		$this->place = $place;
	}

	protected $memberNo;

	public function getMemberNo() {
		return $this->memberNo;
	}

	public function setMemberNo($memberNo) {
		$this->memberNo = $memberNo;
	}

	protected $ranking;

	public function getRanking() {
		return $this->ranking;
	}

	public function setRanking($ranking) {
		$this->ranking = $ranking;
	}

	protected $phone;

	public function getPhone() {
		return $this->phone;
	}

	public function setPhone($phone) {
		$this->phone = $phone;
	}

	protected $mobile;

	public function getMobile() {
		return $this->mobile;
	}

	public function setMobile($mobile) {
		$this->mobile = $mobile;
	}

	protected $emailAddress;

	public function getEmailAddress() {
		return $this->emailAddress;
	}

	public function setEmailAddress($emailAddress) {
		$this->emailAddress = $emailAddress;
	}

	protected $password;

	public function getPassword() {
		return $this->password;
	}

	public function setPassword($password) {
		$this->password = $password;
	}

	protected $recreation;

	public function isRecreation() {
		return $this->recreation;
	}

	public function setRecreation($recreation) {
		$this->recreation = $recreation;
	}

	protected $active;

	public function isActive() {
		return $this->active;
	}

	public function setActive($active) {
		$this->active = $active;
	}

	public function getRoles($from=0, $limit=9999999999) {
		return RoleServiceUtil::findByPlayerId($this->playerId, $from, $limit);
	}

}
?>