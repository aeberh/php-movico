<?php
class PingpongClubService extends PingpongClubServiceBase {

	public function create($number, $shortName, $name, $address, $distance, $phone) {
		$club = $this->createPingpongClub();
		return $this->doUpdate($club, $number, $shortName, $name, $address, $distance, $phone);
	}
	
	public function update($clubId, $number, $shortName, $name, $address, $distance, $phone) {
		$club = $this->getPingpongClub($clubId);
		return $this->doUpdate($club, $number, $shortName, $name, $address, $distance, $phone);
	}
	
	private function doUpdate(PingpongClub $club, $number, $shortName, $name, $address, $distance, $phone) {
		$club->setNumber($number);
		$club->setShortName($shortName);
		$club->setName($name);
		$club->setAddress($address);
		$club->setDistance($distance);
		$club->setPhone($phone);
		return $this->updatePingpongClub($club);
	}
	
	public function delete(PingpongClub $club) {
		if($club->isHasGames()) {
			throw new ExistingGamesForClubException();
		}
		return $this->deletePingpongClub($club->getClubId());
	}
	
}
?>