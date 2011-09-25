<?php
abstract class PingpongClubModel extends Model {

	protected $clubId;

	public function getClubId() {
		return $this->clubId;
	}

	public function setClubId($clubId) {
		$this->clubId = $clubId;
	}

	protected $number;

	public function getNumber() {
		return $this->number;
	}

	public function setNumber($number) {
		$this->number = $number;
	}

	protected $shortName;

	public function getShortName() {
		return $this->shortName;
	}

	public function setShortName($shortName) {
		$this->shortName = $shortName;
	}

	protected $name;

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	protected $building;

	public function getBuilding() {
		return $this->building;
	}

	public function setBuilding($building) {
		$this->building = $building;
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

	protected $distance;

	public function getDistance() {
		return $this->distance;
	}

	public function setDistance($distance) {
		$this->distance = $distance;
	}

	protected $phone;

	public function getPhone() {
		return $this->phone;
	}

	public function setPhone($phone) {
		$this->phone = $phone;
	}

}
?>