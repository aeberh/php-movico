<?php
class BoggleGame extends BoggleGameModel {

	public function getName() {
		return "#".$this->getGameId();
	}
	
	public function getPlayersStr() {
		return implode(", ", BogglePlayerServiceUtil::getPlayerNames($this->getGameId()));
	}
	
	public function isIdle() {
		$players = BogglePlayerServiceUtil::findByGameId($this->getGameId());
		return empty($players);
	}
	
}
?>