<?php
class BubbleHighScoreService extends BubbleHighScoreServiceBase {

	public function create($playerName, $seconds) {
		$hs = $this->createBubbleHighScore();
		$hs->setName($playerName);
		$hs->setSeconds($seconds);
		$hs->setPlayDate(Date::createNow());
		return $this->updateBubbleHighScore($hs);
	}
	
}
?>