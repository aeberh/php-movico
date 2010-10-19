<?
class View extends Component {
	
	public function render() {
		$result = "<html><body>";
		foreach($this->children as $child) {
			$result .= $child->render();
		}
		return $result."</body></html>";
	}
	
	public function getValidParents() {
		return array();
	}
	
}
?>