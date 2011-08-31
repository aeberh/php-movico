<?php
abstract class NewsItemModel extends Model {

	private $itemId;

	public function getItemId() {
		return $this->itemId;
	}

	public function setItemId($itemId) {
		$this->itemId = $itemId;
	}

	private $date;

	public function getDate() {
		return $this->date;
	}

	public function setDate($date) {
		$this->date = $date;
	}

	private $title;

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	private $content;

	public function getContent() {
		return $this->content;
	}

	public function setContent($content) {
		$this->content = $content;
	}

	private $creatorId;

	public function getCreatorId() {
		return $this->creatorId;
	}

	public function setCreatorId($creatorId) {
		$this->creatorId = $creatorId;
	}

}
?>