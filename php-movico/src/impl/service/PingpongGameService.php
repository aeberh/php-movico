<?php
class PingpongGameService extends PingpongGameServiceBase {

	public function create($date, $homeClubId, $homeTeamNo, $outClubId, $outTeamNo) {
		$game = $this->createPingpongGame();
		$game->setDate($date);
		$game->setHomeTeamId(PingpongTeamServiceUtil::getOrCreateClubId($homeClubId, $homeTeamNo));
		$game->setOutTeamId(PingpongTeamServiceUtil::getOrCreateClubId($outClubId, $outTeamNo));
		return $this->updatePingpongGame($game);
	}
	
	public function delete(PingpongGame $game) {
		$this->deletePingpongGame($game->getGameId());
	}
	
	public function update($gameId, $homeTeamPts, $outTeamPts, $review) {
		$game = $this->getPingpongGame($gameId);
		$game->setHomeTeamPts($homeTeamPts);
		$game->setOutTeamPts($outTeamPts);
		$game->setReview($review);
		return $this->updatePingpongGame($game);
	}
	
	public function getFirstUpcomingGames() {
		return $this->findByAfterDate(Date::createNow(), 0, 10);
	}
	
	public function getRecentlyPlayedGames() {
		return $this->findByBeforeDate(Date::createNow(), 0, 10);
	}
	
}
?>