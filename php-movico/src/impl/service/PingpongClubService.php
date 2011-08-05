<?php
class PingpongClubService extends PingpongClubServiceBase {

	public function create($number, $shortName, $name, $building, $street, $place, $distance, $phone) {
		$club = $this->createPingpongClub();
		return $this->doUpdate($club, $number, $shortName, $name, $building, $street, $place, $distance, $phone);
	}
	
	public function update($clubId, $number, $shortName, $name, $building, $street, $place, $distance, $phone) {
		$club = $this->getPingpongClub($clubId);
		return $this->doUpdate($club, $number, $shortName, $name, $building, $street, $place, $distance, $phone);
	}
	
	private function doUpdate(PingpongClub $club, $number, $shortName, $name, $building, $street, $place, $distance, $phone) {
		if(empty($number) || empty($shortName) || empty($name)) {
			throw new RequiredInformationException();
		}
		$club->setNumber($number);
		$club->setShortName($shortName);
		$club->setName($name);
		$club->setBuilding($building);
		$club->setStreet($street);
		$club->setPlace($place);
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