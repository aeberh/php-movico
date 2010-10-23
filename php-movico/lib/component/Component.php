<?
abstract class Component {
	
	private $parent;
	protected $children = array();
	protected $id;
	
	public function addChild(Component $component) {
		$parentClass = get_class($this);
		if(!in_array($parentClass, $component->getValidParents())) {
			throw new InvalidComponentHierarchyException($parentClass, get_class($component));
		}
		$this->children[] = $component;
		$component->setParent($this);
	}
	
	public abstract function render($index=null);
	
	protected function renderChildren($include=array(), $exclude=array(), $index=null) {
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
	
	private function getFirstAncestorOfType($className) {
		$result = null;
		$current = $this;
		while(get_class($current) !== $className) {
			$parent = $current->getParent();
			if(get_class($parent) === "View") {
				throw new NoSuchAnchestorComponentException(get_class($this), $className);
			}
			$current = $parent;
		}
		return $current;
	}
	
	protected function getConvertedValue($string, $rowObject=null) {
		preg_match_all("/#\{[a-zA-Z\.]+\}/", $string, $matches);
		$replaces = array();
		foreach($matches as $match) {
			$replaces[$match[0]] = $this->getBeanValue($match[0], $rowObject);
		}
		return str_replace(array_keys($replaces), array_values($replaces), $string);
	}
	
	private function getBeanValue($valueExpression, $rowObject=null) {
		list($beanClass, $nestedProperty) = BeanUtil::getBeanAndProperties($valueExpression);
		try {
			$beanObj = BeanLocator::get($beanClass);
		} catch(NoSuchBeanException $e) {
			try {
				$dataTable = $this->getFirstAncestorOfType("DataTable");
				if($dataTable->getVar() !== $beanClass  || $rowObject === null) {
					throw NoSuchBeanException($beanClass);
				}
				$beanObj = $rowObject;
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
	
}
?>