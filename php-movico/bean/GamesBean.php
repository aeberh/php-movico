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
		if(Params::has(0) && Params::get(0) !== "-") {
			return Params::get(0);
		}
		if(!Params::has(0) && !Params::has(1) && empty($this->filterByTeam)) {
			return Date::createNow()->getWeek();
		}
		return null;
	}
	
	private function getFilterByTeamVal() {
		if(!empty($this->filterByTeam)) {
			return $this->filterByTeam;
		}
		if(Params::has(1) && Params::get(1) !== "-") {
			return Params::get(1);
		}
		return null;
	}
	
	/*
	
	private function getFilterByWeekParam() {
		return $this->isParamsEmpty() ? Date::createNow()->getWeek() : $this->getParam(0);
	}
	
	private function getFilterByTeamParam() {
		return $this->isParamsEmpty() ? null : $this->getParam(1);
	}
	
	private function getParam($i) {
		return Params::has($i) ? (Params::get($i) == "-" ? null : Params::get($i)) : null;
	}
	
	private function isParamsEmpty() {
		return !Params::has(0) && !Params::has(1);
	}
	*/
	
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