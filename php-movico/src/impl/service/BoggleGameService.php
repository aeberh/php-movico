<?php
class BoggleGameService extends BoggleGameServiceBase {

	public function getUnstartedGames() {
		return $this->findByStarted(0);
	}
	
	public function create($playerName) {
		$player = BogglePlayerServiceUtil::findOrCreate($playerName);
		if($player->isInGame()) {
			throw new PlayerIsAlreadyInGameException();
		}
		$game = $this->updateBoggleGame($this->createBoggleGame());
		$player->setGameId($game->getGameId());
		BogglePlayerServiceUtil::updatePlayer($player);
		return $game;
	}
	
}
?>