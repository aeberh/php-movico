<?php
class ManageNewsBean extends RequestBean {
	
	private $selected;
	
	public function __construct() {
		$this->selected = new NewsItem();
	}
	
	public function getItems() {
		return NewsItemServiceUtil::getNewsItems();
	}
	
	public function create() {
		try {
			NewsItemServiceUtil::create($this->getPlayerId(), $this->selected->getTitle(), $this->selected->getContent());
			MessageUtil::info("Item werd succesvol toegevoegd!");
			return "admin/news/overview";
		} catch(RequiredInformationException $e) {
			MessageUtil::error("Een of meer verplichte velden werden niet ingevuld!");
		} catch(NewsItemContentTooLongException $e) {
			MessageUtil::error("Inhoud van het item is te lang!");
		}
		return null;
	}
	
	public function edit($itemId) {
		$this->selected = NewsItemServiceUtil::getNewsItem($itemId);
		return "admin/news/edit";
	}
	
	public function save() {
		try {
			NewsItemServiceUtil::update($this->selected->getItemId(), $this->selected->getTitle(), $this->selected->getContent());
			MessageUtil::info("Item werd succesvol aangepast!");
			return "admin/news/overview";
		} catch(RequiredInformationException $e) {
			MessageUtil::error("Een of meer verplichte velden werden niet ingevuld!");
		} catch(NewsItemContentTooLongException $e) {
			MessageUtil::error("Inhoud van het item is te lang!");
		}
		return null;
	}
	
	public function delete($itemId) {
		NewsItemServiceUtil::deleteNewsItem($itemId);
		MessageUtil::info("Item werd succesvol verwijderd!");
		return null;
	}
	
	private function getPlayerId() {
		return BeanLocator::get("LoginBean")->getPlayerId();
	}
	
	public function getSelected() {
		return $this->selected;
	}
	
}
?>