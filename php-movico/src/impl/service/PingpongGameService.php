<?php
class PingpongGameService extends PingpongGameServiceBase {

	public function create($date, $homeClubId, $homeTeamNo, $outClubId, $outTeamNo) {
		$game = $this->createPingpongGame();
		return $this->doUpdate($game, $date, $homeClubId, $homeTeamNo, $outClubId, $outTeamNo, 0, 0, "", array(), array());
	}
	
	public function delete(PingpongGame $game) {
		$this->deletePingpongGame($game->getGameId());
	}
	
	public function update($gameId, $date, $homeClubId, $homeTeamNo, $outClubId, $outTeamNo, $homeTeamPts, $outTeamPts, $review, $homeParticipants, $outParticipants) {
		$game = $this->getPingpongGame($gameId);
		return $this->doUpdate($game, $date, $homeClubId, $homeTeamNo, $outClubId, $outTeamNo, $homeTeamPts, $outTeamPts, $review, $homeParticipants, $outParticipants);
	}
	
	private function doUpdate(PingpongGame $game, $date, $homeClubId, $homeTeamNo, $outClubId, $outTeamNo, $homeTeamPts, $outTeamPts, $review, $homeParticipants, $outParticipants) {
		$homeTeamId = PingpongTeamServiceUtil::getOrCreateTeamId($homeClubId, $homeTeamNo);
		$outTeamId = PingpongTeamServiceUtil::getOrCreateTeamId($outClubId, $outTeamNo);
		GameParticipanceServiceUtil::update($game->getGameId(), $homeTeamId, $homeParticipants);
		GameParticipanceServiceUtil::update($game->getGameId(), $outTeamId, $outParticipants);
		$game->setDate($date);
		$game->setHomeTeamId($homeTeamId);
		$game->setOutTeamId($outTeamId);
		$game->setHomeTeamPts($homeTeamPts);
		$game->setOutTeamPts($outTeamPts);
		$game->setReview($review);
		return $this->updatePingpongGame($game);
	}
	
	public function filterByWeek($weekIndex) {
		$weekNo = $this->getWeekByIndex($weekIndex);
		$result = array();
		foreach($this->getPingpongGames() as $game) {
			if($game->getDate()->getWeek() == $weekNo) {
				$result[] = $game;
			}
		}
		return $result;
	}
	
	public function filterByTeam($teamId) {
		$result = array();
		foreach($this->getPingpongGames() as $game) {
			if($game->isTeamParticipating($teamId)) {
				$result[$game->getGameId()] = $game;
			}
		}
		return array_values($result);
	}
	
	private function getWeekByIndex($i) {
		$reverse = array_flip($this->getPlayingWeeksMap());
		return $reverse[$i];
	}
	
	public function getWeekIndexByNo($weekNo) {
		$map = $this->getPlayingWeeksMap();
		$waitForAmount = 5;
		while(!isset($map[$weekNo])) {
			$weekNo++;
			$waitForAmount--;
			if($waitForAmount == 0) {
				return 1;
			}
		}
		return $map[$weekNo];
	}
	
	private function getPlayingWeeksMap() {
		$weeks = array();
		foreach($this->getPingpongGames() as $game) {
			$week = $game->getDate()->getWeek();
			$weeks[$week] = $week;
		}
		$result = array();
		$i = 1;
		foreach($weeks as $week) {
			$result[$week] = $i;
			$i++;
		}
		return $result;
	}
	
	public function getPlayingWeeks() {
		$values = array_values($this->getPlayingWeeksMap());
		return array_combine($values, $values);
	}
	
	public function getFirstUpcomingGames() {
		return $this->findByAfterDate(Date::createNow(), 0, 7);
	}
	
	public function getRecentlyPlayedGames() {
		return $this->findByBeforeDate(Date::createNow(), 0, 7);
	}
	
	public function getLastReviewed($max) {
		$result = array();
		$games = $this->getPingpongGames();
		usort($games, function($a, $b) {
			return $b->getDate()->getTime()-$a->getDate()->getTime();
		});
		foreach($games as $game) {
			if($game->isHasReview()) {
				$result[] = $game;
				if(count($result) == $max) {
					break;
				}
			}
		}
		return $result;
	}
	
}
?>