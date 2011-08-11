<?php
class PlayerOverviewBean extends RequestBean {
	
	public function getPlayers() {
		return PingpongPlayerServiceUtil::getActivePlayers();
	}
	
}
?>