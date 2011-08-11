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
		PingpongGameServiceUtil::create($this->selected->getDate(), $this->homeClubId, $this->homeTeamNo, $this->outClubId, $this->outTeamNo);
		return "admin/games/overview";
	}
	
	public function delete($gameId) {
		PingpongGameServiceUtil::delete(PingpongGameServiceUtil::getPingpongGame($gameId));
		MessageUtil::info("Wedstrijd werd succesvol verwijderd!");
		return "admin/games/overview";
	}
	
	public function edit($gameId) {
		$this->selected = PingpongGameServiceUtil::getPingpongGame($gameId);
		$this->homeClubId = $this->selected->getHomeTeam()->getClubId();
		$this->homeTeamNo = $this->selected->getHomeTeam()->getTeamNo();
		$this->outClubId = $this->selected->getOutTeam()->getClubId();
		$this->outTeamNo = $this->selected->getOutTeam()->getTeamNo();
		return "admin/games/edit";
	}
	
	public function save() {
		PingpongGameServiceUtil::update($this->selected->getGameId(), $this->selected->getDate(), $this->homeClubId, $this->homeTeamNo, $this->outClubId, $this->outTeamNo,
			$this->selected->getHomeTeamPts(), $this->selected->getOutTeamPts(), $this->selected->getReview());
		MessageUtil::info("Wedstrijd werd succesvol aangepast!");
		return "admin/games/overview";
	}
	
	// Bean getters
	
	public function getGames() {
		return PingpongGameServiceUtil::getPingpongGames();
	}
	
	public function getClubs() {
		$clubs = PingpongClubServiceUtil::getPingpongClubs();
		return ArrayUtil::toIndexedArray($clubs, "clubId", "name");
	}
	
	public function getSelected() {
		return $this->selected;
	}
	
	// Field getters and setters
	
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
	
}
?>