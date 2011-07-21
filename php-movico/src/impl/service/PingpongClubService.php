<?php
class PingpongClubService extends PingpongClubServiceBase {

	public function create($number, $name, $address) {
		$club = $this->createPingpongClub();
		$club->setNumber($number);
		$club->setName($name);
		$club->setAddress($address);
		return $this->updatePingpongClub($club);
	}
	
	public function update($clubId, $address) {
		$club = $this->getPingpongClub($clubId);
		$club->setAddress($address);
		return $this->updatePingpongClub($club);
	}
	
	public function delete(PingpongClub $club) {
		return $this->deletePingpongClub($club->getClubId());
	}
	
}
?>