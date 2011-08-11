<?php
class PingpongPlayerService extends PingpongPlayerServiceBase {

	public function getActivePlayers() {
		return $this->findByActive(true);
	}
	
	public function create($firstName, $lastName, $memberNo, $ranking, $active, $recreation, $startYear, $street, $place, $emailAddress, $phone) {
		$player = $this->createPingpongPlayer();
		return $this->doUpdate($player, $firstName, $lastName, $memberNo, $ranking, $active, $recreation, $startYear, $street, $place, $emailAddress, $phone);
	}
	
	public function update($playerId, $firstName, $lastName, $memberNo, $ranking, $active, $recreation, $startYear, $street, $place, $emailAddress, $phone) {
		$player = $this->getPingpongPlayer($playerId);
		return $this->doUpdate($player, $firstName, $lastName, $memberNo, $ranking, $active, $recreation, $startYear, $street, $place, $emailAddress, $phone);
	}
	
	private function doUpdate(PingpongPlayer $player, $firstName, $lastName, $memberNo, $ranking, $active, $recreation, $startYear, $street, $place, $emailAddress, $phone) {
		if(empty($firstName) || empty($lastName) || empty($memberNo)) {
			throw new RequiredInformationException();
		}
		$player->setFirstName($firstName);
		$player->setLastName($lastName);
		$player->setMemberNo($memberNo);
		$player->setRanking($ranking);
		$player->setActive($active);
		$player->setRecreation($recreation);
		$player->setStartYear($startYear);
		$player->setStreet($street);
		$player->setPlace($place);
		$player->setEmailAddress($emailAddress);
		$player->setPhone($phone);
		return $this->updatePingpongPlayer($player);
	}
	
}
?>