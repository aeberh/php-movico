<?php
class Settings {

	private $config;
	
	private $environment;
	private $ajaxEnabled;
	private $ajaxTimeout;
	private $defaultUrl;
	private $rootPath;
	private $contextPath;
	private $locale;
	private $gmapsApiKey;
	private $viewCacheEnabled;
	
	public function __construct() {
		$config = new ConfigurationFile(ConfigurationConstants::MAIN_CONFIG);
		$this->environment = $config->getParam("environment", "prod")->getValue();
		$this->ajaxEnabled = $config->getParam("ajax_enabled", "true")->getValue();
		$this->ajaxTimeout = $config->getParam("ajax_timeout", "3000")->getValue();
		$this->defaultView = $config->getParam("default_url", "index")->getValue();
		$this->contextPath = $config->getParam("context_path", "/")->getValue();
		$this->locale = $config->getParam("locale", "en_US")->getValue();
		$this->gmapsApiKey = $config->getParam("gmaps_api_key", "")->getValue();
		$this->viewCacheEnabled = $config->getParam("view_cache_enabled", "true")->getValue();
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
	
	public function getDefaultUrl() {
		return $this->defaultUrl;
	}
	
	public function setRootPath($rootPath) {
		$this->rootPath = $rootPath;
	}
	
	public function getRootPath() {
		return $this->rootPath;
	}
	
	public function getContextPath() {
		return $this->contextPath;
	}
	
	public function getLocale() {
		return $this->locale;
	}
	
	public function getGmapsApiKey() {
		return $this->gmapsApiKey;
	}
	
	public function isViewCacheEnabled() {
		return $this->viewCacheEnabled;
	}

}
?>
