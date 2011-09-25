<?php
class ViewForward {
	
	const URL_DELIMITER = "/p/";
	
	private $view;
	private $params;
	private $url;
	
	public function __construct($url) {
		$this->url = $url;
		$viewParts = String::create($url)->split(self::URL_DELIMITER, 2);
		$this->view = $viewParts->get(0)->getPrimitive();
		$this->params = $viewParts->size() > 1 ? String::toPrimitives($viewParts->get(1)->split("/")) : array();
	}
	
	public function getView() {
		return $this->view;
	}
	
	public function getParams() {
		return $this->params;
	}
	
	public function getUrl() {
		return $this->url;
	}
	
}
?>