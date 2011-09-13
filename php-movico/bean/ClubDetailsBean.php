<?php
class ClubDetailsBean extends RequestBean {
	
	private $club = null;
	
	public function __construct() {
		$clubId = Context::getParam(0);
		$this->club = PingpongClubServiceUtil::getPingpongClub($clubId);
	}
	
	public function getClub() {
		return $this->club;
	}
	
}
?>