<?php
class PingpongClubService extends PingpongClubServiceBase {

	public function create($number, $name, $location) {
		$club = $this->createPingpongClub();
		$club->setNumber($number);
		$club->setName($name);
		$club->setLocation($location);
		return $this->updatePingpongClub($club);
	}
	
	public function update($clubId, $location) {
		$club = $this->getPingpongClub($clubId);
		$club->setLocation($location);
		return $this->updatePingpongClub($club);
	}
	
	public function delete(PingpongClub $club) {
		return $this->deletePingpongClub($club->getClubId());
	}
	
}
?>