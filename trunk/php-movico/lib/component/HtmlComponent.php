<?
class HtmlComponent extends Component {
	
	private $tagName;
	private $attributes;
	private $text;
	
	public function __construct($tagName, $text, $attributes) {
		$this->checkValidTag($tagName);
		$this->tagName = $tagName;
		$this->attributes = $attributes;
		$this->text = $text;
	}
	
	public function getTagName() {
		return $this->tagName;
	}
	
	public function doRender($rowIndex=null) {
		$tag = $this->tagName;
		$result = "<$tag".$this->getExpandedAttrs();
		if(empty($this->children) && empty($this->text)) {
			return "$result/>";
		}
		$result .= ">";
		$result .= $this->hasChildren() ? $this->renderChildren() : $this->text;
		return $result."</$tag>";
	}
	
	private function getExpandedAttrs() {
		$result = "";
		foreach($this->attributes as $key=>$val) {
			$result .= " $key=\"$val\"";
		}
		return $result;
	}
	
	public function getValidParents() {
		switch($this->tagName) {
			case "li":
				return array("ul", "ol");
			default:
				return array("View", "Form", "PanelGrid", "Column", "PanelGroup", "div", "p");
		}
	}
	
	private function checkValidTag($tagName) {
		if(!in_array($tagName, array("div", "p", "ul", "ol", "li", "br", "h1", "h2", "h3", "h4", "h5", "h6"))) {
			throw new ComponentNotExistsException($tagName);
		}
	}
	
}
?>