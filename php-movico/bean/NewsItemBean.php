<?php
class NewsItemBean extends RequestBean {
	
	private $items = array();
	
	public function __construct() {
		if(Params::has(0)) {
			$itemId = Params::get(0);
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