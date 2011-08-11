<?php
class RenderLink extends Component {
	
	private $view;
	private $value;
	private $selectedPrefix;
	
	public function setSelectedPrefix($selectedPrefix) {
		$this->selectedPrefix = $selectedPrefix;
	}
	
	public function setView($view) {
		$this->view = $view;
	}
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function doRender($rowIndex=null) {
		$context = parent::$settings->getContextPath();
		$view = $this->getConvertedValue($this->view, $rowIndex);
		$value = $this->getConvertedValue($this->value, $rowIndex);
		$params = new ArrayList("String");
		foreach($this->getChildrenOfType("Param") as $param) {
			$paramVal = $this->getConvertedValue($param->getValue(), $rowIndex);
			$params->add(String::create($paramVal));
		}
		$url = $view;
		if(!$params->isEmpty()) {
			$url .= ViewForward::URL_DELIMITER.$params->join("/")->getPrimitive();
		}
		$selPrefix = empty($this->selectedPrefix) ? $url : $this->selectedPrefix;
		return "<a selectedPrefix=\"$selPrefix\" class=\"RenderLink\" href=\"{$context}/{$url}\">$value</a>";
	}
	
	public function getValidParents() {
		return -1;
	}
	
}
?>