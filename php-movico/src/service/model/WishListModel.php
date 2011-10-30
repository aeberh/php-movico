<?php
abstract class WishListModel extends Model {

	protected $id;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	protected $name;

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	protected $list;

	public function getList() {
		return $this->list;
	}

	public function setList($list) {
		$this->list = $list;
	}

	protected $updateDate;

	public function getUpdateDate() {
		return $this->updateDate;
	}

	public function setUpdateDate($updateDate) {
		$this->updateDate = $updateDate;
	}

}
?>