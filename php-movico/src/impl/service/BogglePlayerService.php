<?php
class BogglePlayerService extends BogglePlayerServiceBase {

	public function findOrCreate($playerName) {
		try {
			return BogglePlayerServiceUtil::findByName($playerName);
		} catch(NoSuchBogglePlayerException $e) {
			$player = $this->createBogglePlayer();
			$player->setName($playerName);
			return $this->updateBogglePlayer($player);
		}
	}
	
	public function getPlayerNames($gameId) {
		$result = array();
		foreach($this->findByGameId($gameId) as $player) {
			$result[] = $player->getName();
		}
		return $result;
	}
	
	public function joinGame($playerId, $gameId) {
		$player = $this->getPlayerCheckNotInGame($playerId);
		$player->setGameId($gameId);
		$this->updateBogglePlayer($player);
	}
	
	public function getPlayerCheckNotInGame($playerId) {
		$player = $this->getBogglePlayer($playerId);
		if($player->isInGame()) {
			throw new BogglePlayerIsAlreadyInGameException();
		}
		return $player;
	}
	
}
?>