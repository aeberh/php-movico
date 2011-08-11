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
			$renderUrl = $req->getUrl();
			$url = empty($renderUrl) ? $url : $renderUrl;
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
		$vars = $req->getPostVars();
		foreach($vars as $var) {
			list($beanClass, $nestedProperty) = BeanUtil::getBeanAndProperties($var->getName(), true);
			ReflectionUtil::callNestedSetter(BeanLocator::get($beanClass), $nestedProperty, $var->getConvertedValue());
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