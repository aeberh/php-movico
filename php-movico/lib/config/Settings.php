<?php
class Settings {

	private $config;
	private $title;
	
	private $environment;
	private $ajaxEnabled;
	private $ajaxTimeout;
	private $defaultUrl;
	private $rootPath;
	private $contextPath;
	private $locale;
	private $gmapsApiKey;
	private $viewCacheEnabled;
	private $dbCacheEnabled;
	private $showSql;
	
	private $smtpHost;
	private $smtpPort;
	private $smtpAuth;
	private $smtpUsername;
	private $smtpPassword;
	private $smtpDefaultFromEmail;
	private $smtpDefaultFromName;
	
	public function __construct() {
		$config = new ConfigurationFile(ConfigurationConstants::MAIN_CONFIG);
		$this->title = $config->getParam("title", "")->getValue();
		$this->environment = $config->getParam("environment", "prod")->getValue();
		$this->ajaxEnabled = $config->getParam("ajax_enabled", "true")->getValue();
		$this->ajaxTimeout = $config->getParam("ajax_timeout", "3000")->getValue();
		$this->defaultUrl = $config->getParam("default_url", "index")->getValue();
		$this->contextPath = $config->getParam("context_path", "/")->getValue();
		$this->locale = $config->getParam("locale", "en_US")->getValue();
		$this->gmapsApiKey = $config->getParam("gmaps_api_key", "")->getValue();
		$this->viewCacheEnabled = $config->getParam("view_cache_enabled", "true")->getValue();
		$this->dbCacheEnabled = $config->getParam("db_cache_enabled", "true")->getValue();
		$this->showSql = $config->getParam("show_sql", "false")->getValue();
		$this->smtpHost = $config->getParam("smtp_host", "localhost")->getValue();
		$this->smtpPort = $config->getParam("smtp_port", "25")->getValue();
		$this->smtpUsername = $config->getParam("smtp_username", "")->getValue();
		$this->smtpPassword = $config->getParam("smtp_password", "")->getValue();
		$this->smtpDefaultFromEmail = $config->getParam("smtp_default_from_email", "")->getValue();
		$this->smtpDefaultFromName = $config->getParam("smtp_default_from_name", "")->getValue();
		$this->smtpAuth = $config->getParam("smtp_auth", "false")->getValue();
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
	
	public function isGmapsEnabled() {
		return !empty($this->gmapsApiKey);
	}
	
	public function isViewCacheEnabled() {
		return $this->viewCacheEnabled;
	}
	
	public function isDbCacheEnabled() {
		return $this->dbCacheEnabled;
	}
	
	public function showSql() {
		return $this->showSql;
	}
	
	public function getSmtpHost() {
		return $this->smtpHost;
	}
	
	public function getSmtpPort() {
		return $this->smtpPort;
	}
	
	public function getSmtpAuth() {
		return $this->smtpAuth;
	}
	
	public function getSmtpUsername() {
		return $this->smtpUsername;
	}
	
	public function getSmtpPassword() {
		return $this->smtpPassword;
	}
	
	public function getSmtpDefaultFromEmail() {
		return $this->smtpDefaultFromEmail;
	}
	
	public function getSmtpDefaultFromName() {
		return $this->smtpDefaultFromName;
	}
	
	public function getTitle() {
		return $this->title;
	}
	
}
?>
