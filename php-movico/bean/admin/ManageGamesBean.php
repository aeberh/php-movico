<?php
class ManageGamesBean extends RequestBean {
	
	private $homeClubId;
	private $homeTeamNo;
	private $outClubId;
	private $outTeamNo;
	
	private $selected;
	
	private $redirectUrl;
	
	const GAMES_PER_PAGE = 20;
	
	// Constructor
	
	public function __construct() {
		if(Context::hasParam(0)) {
			$this->selected = PingpongGameServiceUtil::getPingpongGame(Context::getParam(0));
			$this->homeClubId = $this->selected->getHomeTeam()->getClubId();
			$this->homeTeamNo = $this->selected->getHomeTeam()->getFullTeamNo();
			$this->outClubId = $this->selected->getOutTeam()->getClubId();
			$this->outTeamNo = $this->selected->getOutTeam()->getFullTeamNo();
		} else {
			$this->selected = new PingpongGame();
		}
		if(Context::hasParam(1)) {
			$this->redirectUrl = str_replace("_", "/", Context::getParam(1));
		}
	}
	
	// Action methods
	
	public function create() {
		PingpongGameServiceUtil::create($this->selected->getDate(), $this->homeClubId, $this->homeTeamNo, $this->outClubId, $this->outTeamNo);
		return "admin/games/overview";
	}
	
	public function delete($gameId) {
		PingpongGameServiceUtil::delete(PingpongGameServiceUtil::getPingpongGame($gameId));
		MessageUtil::success("Wedstrijd werd succesvol verwijderd!");
		return "admin/games/overview";
	}
	
	public function save() {
		PingpongGameServiceUtil::update($this->selected->getGameId(), $this->selected->getDate(), $this->homeClubId, $this->homeTeamNo, $this->outClubId, $this->outTeamNo,
			$this->selected->getHomeTeamPts(), $this->selected->getOutTeamPts(), $this->selected->getReview());
		MessageUtil::success("Wedstrijd werd succesvol aangepast!");
		return empty($this->redirectUrl) ? "admin/games/overview" : $this->redirectUrl;
	}
	
	// Bean getters
	
	public function getGames() {
		return PingpongGameServiceUtil::getPingpongGames($this->getFrom(), self::GAMES_PER_PAGE);
	}
	
	private function getFrom() {
		return Context::hasParam(0) ? Context::getParam(0) : 0;
	}
	
	public function isHasPrevFrom() {
		return $this->getPrevFrom() >= 0;
	}
	
	public function isHasNextFrom() {
		return $this->getNextFrom() < PingpongGameServiceUtil::countPingpongGames();
	}
	
	public function getNextFrom() {
		return $this->getFrom() + self::GAMES_PER_PAGE;
	}
	
	public function getPrevFrom() {
		return $this->getFrom() - self::GAMES_PER_PAGE;
	}
	
	public function getClubs() {
		$clubs = PingpongClubServiceUtil::getPingpongClubs();
		return ArrayUtil::toIndexedArray($clubs, "clubId", "shortName");
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
	
	public function getRedirectUrl() {
		return $this->redirectUrl;
	}
	
	public function setRedirectUrl($redirectUrl) {
		$this->redirectUrl = $redirectUrl;
	}
	
}
?>