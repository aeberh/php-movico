<?
class AjaxLoading extends Component {
	
	const CLASS_NAME = "AjaxLoading";
	
	public function doRender($rowIndex=null) {
		if(!parent::$settings->isAjaxEnabled()) {
			return "";
		}
		$src = isset($this->src) ? $this->src : "loading.gif";
		return "<img status=\"idle\" src=\"".parent::$settings->getContextPath()."/lib/component/ajax/img/connect_idle.gif\" class=\"".self::CLASS_NAME."\"/>";
	}
	
	public function getValidParents() {
		return array("View", "Form", "PanelGrid", "Column", "PanelGroup");
	}
	
}
?>