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
	
	protected function renderChildren($include=array(), $exclude=array()) {
		$result = "";
		$includeAll = empty($include);
		foreach($this->children as $child) {
			$childClass = get_class($child);
			$childInInclude = in_array($childClass, $include);
			$childInExclude = in_array($childClass, $exclude);
			if(($includeAll && !$childInExclude) || $childInInclude) {
				$result .= $child->render();
			}
		}
		return $result;
	}
	
	protected function hasChildren() {
		return !empty($this->children);
	}
	
	protected abstract function getValidParents();
	
	protected function getChildrenOfType($class) {
		$result = array();
		foreach($this->children as $child) {
			if($child instanceof $class) {
				$result[] = $child;
			}
		}
		return $result;
	}

	public function setId($id) {
		$this->id = $id;
	}
	
}
?>