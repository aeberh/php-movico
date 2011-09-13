<?php
class ClubDetailsBean extends RequestBean {
	
	private $club = null;
	
	public function __construct() {
		if(Context::hasParam(0)) {
			$clubId = Context::getParam(0);
			$this->club = PingpongClubServiceUtil::getPingpongClub($clubId);
		}
	}
	
	public function getClub() {
		return $this->club;
	}
	
	public function getJevotaClubId() {
		return PingpongClubServiceUtil::getJevota()->getClubId();
	}
	
}
?>