<?php
class Settings {

	private $config;
	
	private $environment;
	private $ajaxEnabled;
	private $ajaxTimeout;
	private $defaultView;
	private $rootPath;
	
	public function __construct() {
		$config = new ConfigurationFile(ConfigurationConstants::MAIN_CONFIG);
		$this->environment = $config->getParam("environment", "prod")->getValue();
		$this->ajaxEnabled = $config->getParam("ajax_enabled", "true")->getValue();
		$this->ajaxTimeout = $config->getParam("ajax_timeout", "3000")->getValue();
		$this->defaultView = $config->getParam("default_view", View::DEFAULT_VIEW)->getValue();
	}
	
	public function getEnvironment() {
		return $this->environment;
	}
	
	public function isAjaxEnabled() {
		return $this->ajaxEnabled;
	}
	
	public function getAjaxTimeout() {
		return $this->ajaxTimeout;
	}
	
	public function getDefaultView() {
		return $this->defaultView;
	}
	
	public function setRootPath($rootPath) {
		$this->rootPath = $rootPath;
	}
	
	public function getRootPath() {
		return $this->rootPath;
	}

}
?>
