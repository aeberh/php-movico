<?php
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
	
	public function doRender($row=null) {
		$tag = $this->tagName;
		$result = "<$tag".$this->getExpandedAttrs();
		if(empty($this->children) && empty($this->text) && $tag != "div") {
			return "$result/>";
		}
		$result .= ">";
		$result .= $this->hasChildren() ? $this->renderChildren(array(), array(), $row) : $this->text;
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
				return array("ul", "ol", "PanelGroup");
			default:
				return array_merge(array("View", "Form", "PanelGrid", "Column", "PanelGroup", "PanelSeries", "ColHeader", "PanelGridSeries", "HtmlComponent"), self::getPossibleTags());
		}
	}
	
	private function checkValidTag($tagName) {
		if(!in_array($tagName, self::getPossibleTags())) {
			throw new ComponentNotExistsException($tagName);
		}
	}
	
	public static function getPossibleTags() {
		return array("div", "span", "p", "ul", "ol", "li", "h1", "h2", "h3", "h4", "h5", "h6");
	}
	
}
?>