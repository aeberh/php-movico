<?php
class GamesBean extends RequestBean {
	
	private $filterByWeek;
	private $filterByTeam;
	
	private $filteredGames;
	
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
		$filterByWeek = $this->getFilterByWeekVal();
		$filterByTeam = $this->getFilterByTeamVal();
		if(!empty($filterByWeek)) {
			$this->filterByWeek = $filterByWeek;
			return PingpongGameServiceUtil::filterByWeek($this->filterByWeek);
		} elseif(!empty($filterByTeam)) {
			$this->filterByTeam = $filterByTeam;
			return PingpongGameServiceUtil::filterByTeam($this->filterByTeam);
		} else {
			return array();
		}
	}
	
	// Request param helpers
	private function getFilterByWeekVal() {
		if(!empty($this->filterByWeek)) {
			return $this->filterByWeek;
		}
		if(Context::hasParam(0) && Context::getParam(0) !== "-") {
			return Context::getParam(0);
		}
		if(!Context::hasParam(0) && !Context::hasParam(1) && empty($this->filterByTeam)) {
			return Date::createNow()->getWeek();
		}
		return null;
	}
	
	private function getFilterByTeamVal() {
		if(!empty($this->filterByTeam)) {
			return $this->filterByTeam;
		}
		if(Context::hasParam(1) && Context::getParam(1) !== "-") {
			return Context::getParam(1);
		}
		return null;
	}
	
	public function getCurrentWeekNo() {
		return Date::createNow()->getWeek();
	}
	
	// Getters & setters
	public function setFilterByWeek($filterByWeek) {
		$this->filterByWeek = $filterByWeek;
	}
	
	public function getFilterByWeek() {
		if(!isset($this->filteredGames)) {
			$this->initFiltered();
		}
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