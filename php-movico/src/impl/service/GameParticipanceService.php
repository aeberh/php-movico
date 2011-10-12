<?php
class GameParticipanceService extends GameParticipanceServiceBase {

	public function update($gameId, $teamId, $participants) {
		$this->deleteByGameAndTeam($gameId, $teamId);
		if(empty($participants)) {
			return;
		}
		foreach($participants as $playerId) {
			$part = $this->createGameParticipance();
			$part->setGameId($gameId);
			$part->setTeamId($teamId);
			$part->setPlayerId($playerId);
			$this->updateGameParticipance($part);
		}
	}
	
}
?>