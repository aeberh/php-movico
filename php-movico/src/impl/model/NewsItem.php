<?php
class NewsItem extends NewsItemModel {

	public function getCreator() {
		return PingpongPlayerServiceUtil::getPingpongPlayer($this->getCreatorId());
	}
	
}
?>