<?php
abstract class Model {

	private $new;

	public function isNew() {
		return $this->new;
	}

	public function setNew($new) {
		$this->new = $new;
	}

}
?>
