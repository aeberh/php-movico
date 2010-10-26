<?
abstract class Component {
	
	private $parent;
	protected $children = array();
	protected $id;
	
	protected $rendered = true;
	
	public function addChild(Component $component) {
		$parentClass = get_class($this);
		if(!in_array($parentClass, $component->getValidParents())) {
			throw new InvalidComponentHierarchyException($parentClass, get_class($component));
		}
		$this->children[] = $component;
		$component->setParent($this);
	}
	
	public abstract function render($index=null);
	
	public function renderChildren($include=array(), $exclude=array(), $index=null) {
		$result = "";
		$includeAll = empty($include);
		foreach($this->children as $child) {
			$childClass = get_class($child);
			$childInInclude = in_array($childClass, $include);
			$childInExclude = in_array($childClass, $exclude);
			if(($includeAll && !$childInExclude) || $childInInclude) {
				$result .= $child->render($index);
			}
		}
		return $result;
	}
	
	private function setParent(Component $parent) {
		$this->parent = $parent;
	}
	
	protected function getParent() {
		return $this->parent;
	}
	
	protected function getFirstAncestorOfType($className) {
		$result = null;
		$current = $this;
		while(get_class($current) !== $className) {
			$parent = $current->getParent();
			if(get_class($parent) === "View" && $className !== "View") {
				throw new NoSuchAnchestorComponentException(get_class($this), $className);
			}
			$current = $parent;
		}
		return $current;
	}
	
	protected function hasAnchestorOfType($className) {
		try {
			$this->getFirstAncestorOfType($className);
			return true;
		} catch(NoSuchAnchestorComponentException $e) {
			return false;
		}
	}
	
	protected function getConvertedValue($string, $rowIndex=null) {
		preg_match_all("/#\{[a-zA-Z\.]+\}/", $string, $matches);
		$replaces = array();
		foreach($matches as $match) {
			if(isset($match[0])) {
				$replaces[$match[0]] = $this->getBeanValue($match[0], $rowIndex);
			}
		}
		return str_replace(array_keys($replaces), array_values($replaces), $string);
	}
	
	private function getBeanValue($valueExpression, $rowIndex=null) {
		list($beanClass, $nestedProperty) = BeanUtil::getBeanAndProperties($valueExpression);
		try {
			$beanObj = BeanLocator::get($beanClass);
		} catch(NoSuchBeanException $e) {
			try {
				$dataTable = $this->getFirstAncestorOfType("DataTable");
				if($dataTable->getVar() !== $beanClass  || $rowIndex === null) {
					throw NoSuchBeanException($beanClass);
				}
				$rows = $dataTable->getRows();
				$beanObj = $rows[$rowIndex];
			} catch(NoSuchAnchestorComponentException $e) {
				throw new NoSuchBeanException($beanClass);
			}
		}
		return ReflectionUtil::callNestedGetter($beanObj, $nestedProperty);
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
	
	public function setRendered($rendered) {
		$this->rendered = $rendered;
	}
	
}
?>