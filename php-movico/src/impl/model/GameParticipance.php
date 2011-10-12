<?php
class GameParticipance extends GameParticipanceModel {

	public function getPlayer() {
		return PingpongPlayerServiceUtil::getPingpongPlayer($this->playerId);
	}
	
}
?>