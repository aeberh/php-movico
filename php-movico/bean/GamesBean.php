<?php
class GamesBean extends RequestBean {
	
	private $filterByWeek;
	private $filterByTeam;
	
	private $filteredGames;
	
	public function __construct() {
		$this->filterByWeek = $this->getFilterByWeekParam();
		$this->filterByTeam = $this->getFilterByTeamParam();
		$this->initFiltered();
	}
	
	public function getUpcoming() {
		return PingpongGameServiceUtil::getFirstUpcomingGames();
	}
	
	public function getPast() {
		return PingpongGameServiceUtil::getRecentlyPlayedGames();
	}
	
	public function getWeeks() {
		return PingpongGameServiceUtil::getPlayingWeeks();
	}
	
	public function getTeams() {
		return ArrayUtil::toIndexedArray(PingpongClubServiceUtil::getJevota()->getTeams(), "teamId", "fullTeamNo");
	}
	
	public function getFilteredGames() {
		return $this->filteredGames;
	}
	
	// Action methods
	public function filter() {
		$this->initFiltered();
		return "games/p/".$this->getFilterByWeekStr()."/".$this->getFilterByTeamStr();
	}
	
	private function initFiltered() {
		$this->filteredGames = $this->getFiltered();
	}
	
	private function getFiltered() {
		if(!empty($this->filterByWeek)) {
			return PingpongGameServiceUtil::filterByWeek($this->filterByWeek);
		} elseif(!empty($this->filterByTeam)) {
			return PingpongGameServiceUtil::filterByTeam($this->filterByTeam);
		} else {
			return array();
		}
	}
	
	// Request param helpers
	private function getFilterByWeekParam() {
		return $this->getParam(0);
	}
	
	private function getFilterByTeamParam() {
		return $this->getParam(1);
	}
	
	private function getParam($i) {
		return Params::has($i) ? (Params::get($i) == "-" ? null : Params::get($i)) : null;
	}
	
	// Getters & setters
	public function setFilterByWeek($filterByWeek) {
		$this->filterByWeek = $filterByWeek;
	}
	
	public function getFilterByWeek() {
		return $this->filterByWeek;
	}
	
	private function getFilterByWeekStr() {
		return empty($this->filterByWeek) ? "-" : $this->filterByWeek;
	}
	
	public function setFilterByTeam($filterByTeam) {
		$this->filterByTeam = $filterByTeam;
	}
	
	public function getFilterByTeam() {
		return $this->filterByTeam;
	}
	
	private function getFilterByTeamStr() {
		return empty($this->filterByTeam) ? "-" : $this->filterByTeam;
	}
	
}
?>