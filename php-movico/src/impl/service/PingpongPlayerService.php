<?php
class PingpongPlayerService extends PingpongPlayerServiceBase {

	public function getActivePlayers() {
		return $this->findByActive(true);
	}
	
	public function getPlayersWithEmail() {
		$result = array();
		$players = $this->getPingpongPlayers();
		foreach($players as $player) {
			$email = $player->getEmailAddress();
			if(!empty($email)) {
				$result[$player->getPlayerId()] = $player->getFullName();
			}
		}
		return $result;
	}
	
	public function create($firstName, $lastName, $memberNo, $ranking, $recreation, $startYear, $street, $place, $emailAddress, $phone) {
		$player = $this->createPingpongPlayer();
		return $this->doUpdate($player, $firstName, $lastName, $memberNo, $ranking, true, $recreation, $startYear, $street, $place, $emailAddress, $phone);
	}
	
	public function update($playerId, $firstName, $lastName, $memberNo, $ranking, $active, $recreation, $startYear, $street, $place, $emailAddress, $phone) {
		$player = $this->getPingpongPlayer($playerId);
		return $this->doUpdate($player, $firstName, $lastName, $memberNo, $ranking, $active, $recreation, $startYear, $street, $place, $emailAddress, $phone);
	}
	
	private function doUpdate(PingpongPlayer $player, $firstName, $lastName, $memberNo, $ranking, $active, $recreation, $startYear, $street, $place, $emailAddress, $phone) {
		if(empty($firstName) || empty($lastName)) {
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
	
	/*
	public function register($emailAddress, $password, $password2) {
		if(!ctype_alnum($emailAddress) || strlen($emailAddress)<4) {
			throw new InvalidEmailAddressException();
		}
		if($this->userExists($emailAddress)) {
			throw new DuplicateEmailAddressException();
		}
		if(!ctype_alnum($emailAddress) || strlen($password)<6) {
			throw new InvalidPasswordException();
		}
		if($password !== $password2) {
			throw new PasswordsDontMatchException();
		}
		$user = $this->createAccount();
		$user->setEmailAddress($emailAddress);
		$user->setPassword($password);
		return $this->updateAccount($user);
	}
	*/
	
	public function login($emailAddress, $password) {
		$user = $this->findByEmailAddress($emailAddress);
		if(empty($emailAddress) || empty($password) || $user->getPassword() !== $password) {
			throw new LoginException();
		}
		return $user;
	}
	
	public function userExists($emailAddress) {
		try {
			$this->findByEmailAddress($emailAddress);
			return true;
		} catch(NoSuchAccountException $e) {
			return false;
		}
	}
	
	public function generateNewPassword($playerId) {
		$player = $this->getPingpongPlayer($playerId);
		$newPassword = strval($player->getMemberNo()/197);
		$player->setPassword($newPassword);
		$this->updatePingpongPlayer($player);
		//send email
	}
	
	public function getUsersSortedByFirstName() {
		$users = $this->getPingpongPlayers();
		usort($users, function($a, $b) {
			$c = strcmp($a->getFirstName(), $b->getFirstName());
			if($c == 0) {
				$c = strcmp($a->getLastName(), $b->getLastName());
			}
			return $c;
		});
		return $users;
	}
	
}
?>