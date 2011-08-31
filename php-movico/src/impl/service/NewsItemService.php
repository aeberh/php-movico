<?php
class NewsItemService extends NewsItemServiceBase {

	public function create($userId, $title, $content) {
		$item = $this->createNewsItem();
		$item->setCreatorId($userId);
		$item->setDate(Date::createNow());
		return $this->doUpdate($item, $title, $content);
	}
	
	public function update($itemId, $title, $content) {
		$item = $this->getNewsItem($itemId);
		return $this->doUpdate($item, $title, $content);
	}
	
	private function doUpdate(NewsItem $item, $title, $content) {
		$this->validate($title, $content);
		$item->setTitle($title);
		$item->setContent($content);
		return $this->updateNewsItem($item);
	}
	
	private function validate($title, $content) {
		if(empty($title) || empty($content)) {
			throw new RequiredInformationException();
		}
		if(strlen($content)>500) {
			throw new NewsItemContentTooLongException();
		}
	}
	
}
?>