<?php
class BogglePlayer extends BogglePlayerModel {
	
	public function isInGame() {
		return $this->getGameId() != 0;
	}

}
?>