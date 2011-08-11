<?php
class ClubDetailsBean extends RequestBean {
	
	private $club;
	
	public function __construct() {
		$clubId = Params::get(0);
		$this->club = PingpongClubServiceUtil::getPingpongClub($clubId);
	}
	
	public function getClub() {
		return $this->club;
	}
	
}
?>