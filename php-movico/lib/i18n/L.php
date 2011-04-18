<?
class L extends SessionBean {
	
	private $locale = "nl";
	
	public function getLocale() {
		return $this->locale;
	}
	
	public function __get($key) {
		return $this->getResourceBundle()->getParam($key, "???$key???");
	}
	
	private function getResourceBundle() {
		$configFile = new ConfigurationFile(ConfigurationConstants::LANG_CONFIG);
		return $configFile->getGroup($this->locale);
	}
	
}
?>