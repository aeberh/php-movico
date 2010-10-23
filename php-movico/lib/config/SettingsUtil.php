<?php
class SettingsUtil {

	public static function getRootPath() {
		return self::isLocal() ? self::getLocalPath()."/" : "";
	}

	public static function isLocal() {
		return file_exists(self::getLocalPath());
	}

	public static function getLocalPath() {
		return self::getConfig()->getParam("local_path")->getValue();
	}
	
	public static function getContextPath() {
		return self::getConfig()->getParam("context_path")->getValue();
	}
	
	private static function getConfig() {
		return new ConfigurationFile(ConfigurationConstants::MAIN_CONFIG);
	}

}
?>
