<?
abstract class Component {
	
	protected $children = array();
	protected $id;
	
	public function addChild(Component $component) {
		$parentClass = get_class($this);
		if(!in_array($parentClass, $component->getValidParents())) {
			throw new InvalidComponentHierarchyException();
		}
		$this->children[] = $component;
	}
	
	public abstract function render();
	
	protected function renderChildren() {
		$result = "";
		foreach($this->children as $child) {
			$result .= $child->render();
		}
		return $result;
	}
	
	protected function hasChildren() {
		return !empty($this->children);
	}
	
	protected abstract function getValidParents();
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	
}
?>