<?php
class ManageGamesBean extends RequestBean {
	
	private $date;
	private $time;
	private $homeClubId;
	private $homeTeamNo;
	private $outClubId;
	private $outTeamNo;
	private $homeTeamPts;
	private $outTeamPts;
	private $review;
	
	private $selected;
	
	// Constructor
	
	public function __construct() {
		$this->selected = new PingpongGame();
	}
	
	// Action methods
	
	public function create() {
		$date = Date::fromString($this->date." ".$this->time, "%d/%m/%Y %H.%M");
		PingpongGameServiceUtil::create($date, $this->homeClubId, $this->homeTeamNo, $this->outClubId, $this->outTeamNo);
		return "admin/games/overview";
	}
	
	public function delete() {
		PingpongGameServiceUtil::delete($this->getSelectedGame());
		MessageUtil::info("Wedstrijd werd succesvol verwijderd!");
		return "admin/games/overview";
	}
	
	public function edit() {
		$this->selected = $this->getSelectedGame();
		return "admin/games/edit";
	}
	
	public function save() {
		PingpongGameServiceUtil::update($this->selected->getGameId(), $this->selected->getHomeTeamPts(), $this->selected->getOutTeamPts(), $this->selected->getReview());
		MessageUtil::info("Wedstrijd werd succesvol aangepast!");
		return "admin/games/overview";
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
	
	public function getSelected() {
		return $this->selected;
	}
	
	// Helpers
	
	private function getSelectedGame() {
		$games = $this->getGames();
		return $games[$this->getSelectedRowIndex()];
	}
	
	// Field getters and setters
	
	public function getDate() {
		return $this->date;
	}
	
	public function setDate($date) {
		$this->date = $date;
	}
	
	public function getTime() {
		return $this->time;
	}
	
	public function setTime($time) {
		$this->time = $time;
	}
	
	public function getHomeClubId() {
		return $this->homeClubId;
	}
	
	public function setHomeClubId($homeClubId) {
		$this->homeClubId = $homeClubId;
	}
	
	public function getHomeTeamNo() {
		return $this->homeTeamNo;
	}
	
	public function setHomeTeamNo($homeTeamNo) {
		$this->homeTeamNo = $homeTeamNo;
	}
	
	public function getOutClubId() {
		return $this->outClubId;
	}
	
	public function setOutClubId($outClubId) {
		$this->outClubId = $outClubId;
	}
	
	public function getOutTeamNo() {
		return $this->outTeamNo;
	}
	
	public function setOutTeamNo($outTeamNo) {
		$this->outTeamNo = $outTeamNo;
	}
	
	public function getHomeTeamPts() {
		return $this->homeTeamPts;
	}
	
	public function setHomeTeamPts() {
		$this->homeTeamPts = $homeTeamPts;
	}
	
	public function getOutTeamPts() {
		return $this->outTeamPts;
	}
	
	public function setOutTeamPts($outTeamPts) {
		$this->outTeamPts = $outTeamPts;
	}
	
	public function getReview() {
		return $this->review;
	}
	
	public function setReview($review) {
		$this->review = $review;
	}
	
}
?>