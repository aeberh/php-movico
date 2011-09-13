<?php
class NewsItemBean extends RequestBean {
	
	private $items = array();
	
	public function __construct() {
		if(Context::hasParam(0)) {
			$itemId = Context::getParam(0);
			$this->items[] = NewsItemServiceUtil::getNewsItem($itemId);
		} else {
			$this->items = NewsItemServiceUtil::getNewsItems();
		}
	}
	
	public function getItems() {
		return $this->items;
	}
	
}
?>