<?
class BoggleMainBean extends SessionBean {
	
	private $player;
	private $roomId;
	
	public function startMultiPlayer() {
		if($this->isInGame()) {
			
		}
	}
	
	public function isGameStarted() {
		return BoggleGameServiceUtil::getBoggleGame($this->roomId)->isStarted();
	}
	
}
?>