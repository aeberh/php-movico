<?php
class PingpongGameService extends PingpongGameServiceBase {

	public function create($date, $homeClubId, $homeTeamNo, $outClubId, $outTeamNo) {
		$game = $this->createPingpongGame();
		return $this->doUpdate($game, $date, $homeClubId, $homeTeamNo, $outClubId, $outTeamNo, 0, 0, "");
	}
	
	public function delete(PingpongGame $game) {
		$this->deletePingpongGame($game->getGameId());
	}
	
	public function update($gameId, $date, $homeClubId, $homeTeamNo, $outClubId, $outTeamNo, $homeTeamPts, $outTeamPts, $review) {
		$game = $this->getPingpongGame($gameId);
		return $this->doUpdate($game, $date, $homeClubId, $homeTeamNo, $outClubId, $outTeamNo, $homeTeamPts, $outTeamPts, $review);
	}
	
	private function doUpdate(PingpongGame $game, $date, $homeClubId, $homeTeamNo, $outClubId, $outTeamNo, $homeTeamPts, $outTeamPts, $review) {
		$game->setDate($date);
		$game->setHomeTeamId(PingpongTeamServiceUtil::getOrCreateClubId($homeClubId, $homeTeamNo));
		$game->setOutTeamId(PingpongTeamServiceUtil::getOrCreateClubId($outClubId, $outTeamNo));
		$game->setHomeTeamPts($homeTeamPts);
		$game->setOutTeamPts($outTeamPts);
		$game->setReview($review);
		return $this->updatePingpongGame($game);
	}
	
	public function filterByWeek($weekNo) {
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
	
	public function getPlayingWeeks() {
		$result = array();
		foreach($this->getPingpongGames() as $game) {
			$week = $game->getDate()->getWeek();
			$result[$week] = $week;
		}
		return $result;
	}
	
	public function getFirstUpcomingGames() {
		return $this->findByAfterDate(Date::createNow(), 0, 15);
	}
	
	public function getRecentlyPlayedGames() {
		return $this->findByBeforeDate(Date::createNow(), 0, 15);
	}
	
}
?>