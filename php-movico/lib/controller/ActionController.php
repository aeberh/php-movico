<?
class ActionController {
	
	private $defaultUrl;
	
	public function __construct() {
		$this->defaultUrl = Singleton::create("Settings")->getDefaultUrl();
	}
	
	public function perform($get, $post, $files) {
		$url = $this->defaultUrl;
		
		$req = new MovicoRequest($get, $post, $files);
		if($req->isRenderUrl()) {
			$url = $req->getUrl();
		} elseif($req->isActionUrl()) {
			$url = $req->getPreviousUrl();
			$this->updateModel($req);
			$actionResult = $this->executeAction($req);
			if(!empty($actionResult)) {
				$url = $actionResult;
			}
		}
		$forward = new ViewForward($url);
		Params::init($forward->getParams());
		return $forward->getView();
	}
	
	private function executeAction(MovicoRequest $req) {
		$action = $req->getAction();
		$expr = new MethodExpression($action);
		if($expr->isConstantValue()) {
			return $action;
		}
		return $expr->execute($req->getActionParams());
	}

	private function updateModel(MovicoRequest $req) {
		$postedFields = $req->getPostVars();
		foreach($postedFields as $key=>$val) {
			$expr = new ValueExpression($key);
			if($expr->isSingleExpression()) {
				$type = $postedFields->has("_type_$key") ? $postedFields->get("_type_$key") : "Null";
				$objValue = Singleton::create("Domain".$type."Converter")->fromViewToDom($val);
				list($beanClass, $nestedProperty) = BeanUtil::getBeanAndProperties($key, true);
				ReflectionUtil::callNestedSetter(BeanLocator::get($beanClass), $nestedProperty, $objValue);
			}
		}
		$files = $req->getFiles();
		foreach($files as $key=>$fileArray) {
			$file = new UploadedFile($fileArray);
			list($beanClass, $nestedProperty) = BeanUtil::getBeanAndProperties($key, true);
			ReflectionUtil::callNestedSetter(BeanLocator::get($beanClass), $nestedProperty, $file);
		}
	}
	
}
?>