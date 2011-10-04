<?php
class NewsItem extends NewsItemModel {

	public function getCreator() {
		return PingpongPlayerServiceUtil::getPingpongPlayer($this->getCreatorId());
	}
	
	public function getShortTitle() {
		$maxChars = 16;
		if(strlen($this->getTitle())>$maxChars-3) {
			return substr($this->getTitle(), 0, $maxChars-3)."...";
		}
		return $this->getTitle();
	}
	
}
?>