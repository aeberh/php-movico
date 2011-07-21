<?php
class HomeBean extends RequestBean {
	
	public function getUpcoming() {
		return PingpongGameServiceUtil::getFirstUpcomingGames();
	}
	
	public function getPast() {
		return PingpongGameServiceUtil::getRecentlyPlayedGames();
	}
	
}
?>