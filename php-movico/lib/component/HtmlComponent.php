<?
class HtmlComponent extends Component {
	
	private $tagName;
	private $attributes;
	private $text;
	
	public function __construct($tagName, $text, $attributes) {
		$this->tagName = $tagName;
		$this->attributes = $attributes;
		$this->text = $text;
	}
	
	public function render() {
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
		return array();
	}
	
}
?>