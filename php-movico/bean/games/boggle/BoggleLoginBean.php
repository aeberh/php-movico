<?
class BoggleLoginBean extends SessionBean {
	
	private $playerName;
	
	public function getPlayerName() {
		return $this->playerName;
	}
	
	public function setPlayerName($playerName) {
		$this->playerName = $playerName;
	}
	
	public function login() {
		if(empty($this->playerName)) {
			MessageUtil::error("Your name must not be empty");
			return null;
		}
		$this->getBoggleBean()->setPlayerId(BogglePlayerServiceUtil::findOrCreate($this->playerName)->getPlayerId());
		$this->playerName = null;
		return "games/boggle/main";
	}
	
	private function getBoggleBean() {
		return BeanLocator::get("BoggleBean");
	}
	
}
?>