<?php
class ManageNewsBean extends RequestBean {
	
	private $selected;
	private $redirectUrl;
	
	public function __construct() {
		if(Context::hasParam(0)) {
			$this->selected = NewsItemServiceUtil::getNewsItem(Context::getParam(0));
		} else {
			$this->selected = new NewsItem();
		}
		if(Context::hasParam(1)) {
			$this->redirectUrl = Context::getParam(1);
		}
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
	
	public function save() {
		try {
			NewsItemServiceUtil::update($this->selected->getItemId(), $this->selected->getTitle(), $this->selected->getContent());
			MessageUtil::info("Item werd succesvol aangepast!");
			return empty($this->redirectUrl) ? "admin/news/overview" : $this->redirectUrl;
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
	
	public function getRedirectUrl() {
		return $this->redirectUrl;
	}
	
	public function setRedirectUrl($redirectUrl) {
		$this->redirectUrl = $redirectUrl;
	}
	
}
?>