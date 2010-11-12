<?php
class SettingsUtil {

	public static function getEnvironment() {
		return self::getConfig()->getParam("environment")->getValue();
	}
	
	public static function isAjaxEnabled() {
		return self::getConfig()->getParam("ajax_enabled", "false")->getValue();
	}
	
	public static function getAjaxTimeout() {
		return self::getConfig()->getParam("ajax_timeout", "3000")->getValue();
	}
	
	private static function getConfig() {
		return new ConfigurationFile(ConfigurationConstants::MAIN_CONFIG);
	}

}
?>
