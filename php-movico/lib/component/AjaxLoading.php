<?
class AjaxLoading extends Component {
	
	private $src;
	const CLASS_NAME = "AjaxLoading";
	
	public function setSrc($src) {
		$this->src = $src;
	}
	
	public function doRender($rowIndex=null) {
		$src = isset($this->src) ? $this->src : "loading.gif";
		$form = $this->getFirstAncestorOfType("Form");
		$id = $form->getId()."Loading";
		return "<img src=\"www/img/$src\" class=\"".self::CLASS_NAME."\" style=\"display:none\"/>";
	}
	
	public function getValidParents() {
		return array("View", "Form", "PanelGrid", "Column");
	}
	
}
?>