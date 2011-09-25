<?php
abstract class TeamModel extends Model {

	protected $teamId;

	public function getTeamId() {
		return $this->teamId;
	}

	public function setTeamId($teamId) {
		$this->teamId = $teamId;
	}

	protected $name;

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getPlayers($from=0, $limit=9999999999) {
		return PlayerServiceUtil::findByTeamId($this->teamId, $from=-1, $limit=-1);
	}

}
?>