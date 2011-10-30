<?php
class XmasBean extends RequestBean {
	
	private $name;
	private $wishList;
	private $listVisible = false;
	
	private static $names = array("Elke", "Stijn", "Yannick", "Sandra", "Peter", "Tania", "Raf", "Agnes", "Marc");
	
	public function getNames() {
		return array_combine(self::$names, self::$names);
	}
	
	public function __construct() {
		$this->wishList = new WishList();
	}

	public function showList() {
		if(empty($this->name)) {
			return null;
		}
		$this->listVisible = true;
		try{
			$this->wishList = WishListServiceUtil::getOrCreateWishList($this->name);
		} catch(Exception $e) {
			MessageUtil::error("Onbekende fout bij ophalen van lijstje. Contacteer Peter!");
		}
		return null;
	}
	
	public function saveList() {
		$this->listVisible = true;
		try {
			$this->wishList = WishListServiceUtil::save($this->name, $this->wishList->getList());
			MessageUtil::info("Je lijstje werd succesvol opgeslagen!");
		} catch(Exception $e) {
			MessageUtil::error("Onbekende fout bij opslaan van lijstje. Contacteer Peter!");
		}
		return null;
	}
		
	public function getName() {
		return $this->name;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function isListVisible() {
		return $this->listVisible;
	}
	
	public function getWishList() {
		return $this->wishList;
	}
	
}
?>