<?php
abstract class NewsItemModel extends Model {

	protected $itemId;

	public function getItemId() {
		return $this->itemId;
	}

	public function setItemId($itemId) {
		$this->itemId = $itemId;
	}

	protected $date;

	public function getDate() {
		return $this->date;
	}

	public function setDate($date) {
		$this->date = $date;
	}

	protected $title;

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	protected $content;

	public function getContent() {
		return $this->content;
	}

	public function setContent($content) {
		$this->content = $content;
	}

	protected $creatorId;

	public function getCreatorId() {
		return $this->creatorId;
	}

	public function setCreatorId($creatorId) {
		$this->creatorId = $creatorId;
	}

}
?>