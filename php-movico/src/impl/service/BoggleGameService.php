<?php
class BoggleGameService extends BoggleGameServiceBase {

	public function getUnstartedGames() {
		$this->deleteIdleGames();
		return $this->findByStarted(0);
	}

	public function createGame($playerId) {
		$player = BogglePlayerServiceUtil::getPlayerCheckNotInGame($playerId);
		$game = $this->updateBoggleGame($this->createBoggleGame());
		$player->setGameId($game->getGameId());
		BogglePlayerServiceUtil::updateBogglePlayer($player);
		return $game;
	}
	
	private function deleteIdleGames() {
		$games = $this->getBoggleGames();
		foreach($games as $game) {
			if($game->isIdle()) {
				$this->deleteBoggleGame($game->getGameId());
			}
		}
	}
	
}
?>