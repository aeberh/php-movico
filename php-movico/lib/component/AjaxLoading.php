<?
class AjaxLoading extends Component {
	
	const CLASS_NAME = "AjaxLoading";
	
	public function doRender($rowIndex=null) {
		$src = isset($this->src) ? $this->src : "loading.gif";
		$form = $this->getFirstAncestorOfType("Form");
		$id = $form->getId()."Loading";
		return "<img src=\"lib/component/img/connect_idle.gif\" class=\"".self::CLASS_NAME."\"/>";
	}
	
	public function getValidParents() {
		return array("View", "Form", "PanelGrid", "Column", "PanelGroup");
	}
	
}
?>