<?
class View extends Component {
	
	private $title;
	
	public function setTitle($title) {
		$this->title = $title;
	}
	
	public function render() {
		$result = "<html>\n\t<head>\n\t\t<title>".$this->title."</title>\n";
		$result .= $this->renderChildren(array("Css", "Js"));
		$result .= "\t</head>\n\t<body>\n";
		$result .= $this->renderChildren(array(), array("Css", "Js"));
		return $result."\t</body>\n</html>";
	}
	
	public function getValidParents() {
		return array();
	}
	
}
?>