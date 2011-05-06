<?
class BoggleRoomBean extends SessionBean {
	
	public function joinGame() {
		$games = $this->getGames();
		$game = $games[$this->getSelectedRowIndex()];
		try {
			BogglePlayerServiceUtil::joinGame($this->getPlayerId(), $game->getGameId());
			$this->setGameId($game->getGameId());
			return "games/boggle/room";
		} catch(BogglePlayerIsAlreadyInGameException $e) {
			MessageUtil::error("You cannot be in 2 games at the same time!");
			return null;
		}
	}
	
	public function getGames() {
		return BoggleGameServiceUtil::getUnstartedGames();
	}
	
	public function createGame() {
		try {
			$game = BoggleGameServiceUtil::createGame($this->getPlayerId());
			$this->setGameId($game->getGameId());
			return "games/boggle/room";
		} catch(BogglePlayerIsAlreadyInGameException $e) {
			MessageUtil::error("You cannot be in 2 games at the same time!");
			return null;
		}
	}
	
	public function startMultiPlayer() {
		return "games/boggle/rooms";
	}
	
	public function startSinglePlayer() {
		$this->setGameId(0);
		return "games/boggle/boggle";
	}
	
	private function getBoggleBean() {
		return BeanLocator::get("BoggleBean");
	}
	
	private function getPlayerId() {
		return $this->getBoggleBean()->getPlayerId();
	}
	
	private function setGameId($gameId) {
		$this->getBoggleBean()->setGameId($gameId);
	}
	
}
?>