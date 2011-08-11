<?php
class ViewForward {
	
	const URL_DELIMITER = "/p/";
	
	private $view;
	private $params;
	
	public function __construct($url) {
		$viewParts = String::create($url)->split("/p/", 2);
		$this->view = $viewParts->get(0)->getPrimitive();
		$this->params = $viewParts->size() > 1 ? String::toPrimitives($viewParts->get(1)->split("/")) : array();
	}
	
	public function getView() {
		return $this->view;
	}
	
	public function getParams() {
		return $this->params;
	}
	
}
?>