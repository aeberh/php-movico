<?php
class PlayerBean extends RequestBean {
	
	private $player;
	private $players;
	private $latest;
	private $overview;
	
	public function __construct() {
		$this->overview = !Context::hasParam(0);
		$this->latest = PingpongPlayerServiceUtil::getLatestPlayers(10);
		if(Context::hasParam(0)) {
			$this->player = PingpongPlayerServiceUtil::getPingpongPlayer(Context::getParam(0));
			$this->overview = false;
		} else {
			$this->players = PingpongPlayerServiceUtil::getActivePlayers();
			$this->overview = true;
		}
	}
	
	public function getPlayer() {
		return $this->player;
	}
	
	public function getPlayers() {
		return $this->players;
	}
	
	public function getLatest() {
		return $this->latest;
	}
	
}
?>