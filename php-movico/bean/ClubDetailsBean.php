<?php
class ClubDetailsBean extends RequestBean {
	
	private $club;
	
	public function showDetails($clubId) {
		$this->club = PingpongClubServiceUtil::getPingpongClub($clubId);
		return "club_details";
	}
	
	public function getClub() {
		return $this->club;
	}
	
}
?>