<?php
class ManageGamesBean extends RequestBean {
	
	private $date;
	private $jevotaTeamNo;
	private $oppClub;
	private $oppTeamNo;
	private $home;
	
	// Action methods
	
	public function create() {
		$realDate = Date::fromString($this->date, "dd/MM/yy");
	}
	
	// Bean getters
	
	public function getGames() {
		return PingpongGameServiceUtil::getPingpongGames();
	}
	
	public function getTeamNos() {
		return array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", 
			"REC A", "REC B", "REC C", "REC D", "REC E", "REC F",
			"REC G", "REC H", "REC I", "REC J");
	}
	
	public function getClubs() {
		$clubs = PingpongClubServiceUtil::getPingpongClubs();
		return ArrayUtil::toIndexedArray($clubs, "clubId", "name");
	}
	
	// Getters and setters
	
	public function getDate() {
		return $this->date;
	}
	
	public function setDate($date) {
		$this->date = $date;
	}
	
	public function getJevotaTeamNo() {
		return $this->jevotaTeamNo;
	}
	
	public function setJevotaTeamNo($jevotaTeamNo) {
		$this->jevotaTeamNo = $jevotaTeamNo;
	}
	
	public function getOppClub() {
		return $this->oppClub;
	}
	
	public function setOppClub($oppClub) {
		$this->oppClub = $oppClub;
	}
	
	public function getOppTeamNo() {
		return $this->oppTeamNo;
	}
	
	public function setOppTeamNo($oppTeamNo) {
		$this->oppTeamNo = $oppTeamNo;
	}
	
	public function isHome() {
		return $this->home;
	}
	
	public function setHome($home) {
		$this->home = $home;
	}
	
}
?>