<?php
class PlayerBean extends RequestBean {
	
	private $player;
	
	public function __construct() {
		$this->player = PingpongPlayerServiceUtil::getPingpongPlayer(Context::getParam(0));
	}
	
	public function getPlayer() {
		return $this->player;
	}
	
}
?>