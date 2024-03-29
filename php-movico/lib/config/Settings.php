<?php
class Settings {

	private $config;
	private $title;
	
	private $fileUploadDir;
	
	private $environment;
	private $ajaxEnabled;
	private $ajaxTimeout;
	private $defaultUrl;
	private $errorPage;
	private $rootPath;
	private $contextPath;
	private $locale;
	private $timezone;
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
		$this->errorPage = $config->getParam("error_page", "error")->getValue();
		$this->contextPath = $config->getParam("context_path", "/")->getValue();
		$this->locale = $config->getParam("locale", "en_US")->getValue();
		$this->timezone = $config->getParam("timezone", "Europe/Brussels")->getValue();
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
		$this->fileUploadDir = $config->getParam("file_upload_dir", "/uploads")->getValue();
	}
	
	public function getEnvironment() {
		return $this->environment;
	}
	
	public function isAjaxEnabled() {
		return $this->ajaxEnabled === "true";
	}
	
	public function getAjaxTimeout() {
		return $this->ajaxTimeout;
	}
	
	public function getDefaultUrl() {
		return $this->defaultUrl;
	}
	
	public function getErrorPage() {
		return $this->errorPage;
	}
	
	public function setRootPath($rootPath) {
		$this->rootPath = $rootPath;
	}
	
	public function getFileUploadDir() {
		return $this->fileUploadDir;
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
	
	public function getTimezone() {
		return $this->timezone;
	}
	
	public function getGmapsApiKey() {
		return $this->gmapsApiKey;
	}
	
	public function isGmapsEnabled() {
		return !empty($this->gmapsApiKey);
	}
	
	public function isViewCacheEnabled() {
		return $this->viewCacheEnabled === "true";
	}
	
	public function isDbCacheEnabled() {
		return $this->dbCacheEnabled === "true";
	}
	
	public function showSql() {
		return $this->showSql === "true";
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
