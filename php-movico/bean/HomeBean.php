<?php
class HomeBean extends RequestBean {
	
	public function getUpcoming() {
		return PingpongGameServiceUtil::getFirstUpcomingGames();
	}
	
}
?>