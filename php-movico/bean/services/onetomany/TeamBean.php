<?
class TeamBean extends RequestBean {
	
	private $teamId;
	private $players;
	private $teamName;
	private $playerName;
	
	private $showPlayerForm;
	private $showPlayerTable;
	
	public function getTeams() {
		return ArrayUtil::toIndexedArray(TeamServiceUtil::getTeams(), "teamId", "name");
	}
	
	public function showPlayers() {
		$team = TeamServiceUtil::getTeam($this->teamId);
		$this->players = $team->getPlayers();
		$this->showPlayerForm = true;
		return null;
	}
	
	public function addPlayer() {
		$player = PlayerServiceUtil::createPlayer();
		$player->setName($this->playerName);
		$player->setTeamId($this->teamId);
		PlayerServiceUtil::updatePlayer($player);
		$this->showPlayerForm = true;
		$this->playerName = "";
		return null;
	}
	
	public function getPlayers() {
		if(empty($this->teamId)) {
			return array();
		}
		return TeamServiceUtil::getTeam($this->teamId)->getPlayers();
	}
	
	public function addTeam() {
		$team = TeamServiceUtil::createTeam();
		$team->setName($this->teamName);
		TeamServiceUtil::updateTeam($team);
		return null;
	}
	
	public function getShowPlayerTable() {
		return $this->showPlayerForm && count($this->getPlayers()) > 0;
	}
	
	public function getShowPlayerForm() {
		return $this->showPlayerForm;
	}
	
	public function getPlayerName() {
		return $this->playerName;
	}
	
	public function setPlayerName($playerName) {
		$this->playerName = $playerName;
	}
	
	public function setTeamName($teamName) {
		$this->teamName = $teamName;
	}
	
	public function getTeamName() {
		return $this->teamName;
	}
	
	public function setTeamId($teamId) {
		$this->teamId = $teamId;
	}
	
	public function getTeamId() {
		return $this->teamId;
	}
	
}
?>