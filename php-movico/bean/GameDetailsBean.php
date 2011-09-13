<?php
class GameDetailsBean extends RequestBean {
	
	private $game;
	
	public function __construct() {
		$gameId = Context::getParam(0);
		$this->game = PingpongGameServiceUtil::getPingpongGame($gameId);
	}
	
	public function getGame() {
		return $this->game;
	}
	
}
?>