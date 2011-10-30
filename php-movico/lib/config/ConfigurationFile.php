<?php
class ConfigurationFile {

    private $filename;
	private $items;

    public function __construct($filename) {
		try {
			FileUtil::checkFileExists($filename);
		} catch(FileNotExistsException $e) {
			throw new ConfigurationException("Configuration file '$filename' does not exist");
		}
		$this->filename = $filename;
		$this->importItems();
    }

	private function importItems() {
		$settings = parse_ini_file($this->filename, true, INI_SCANNER_RAW);
		foreach($settings as $key=>$val) {
            $item = null;
			if(is_array($val) && ArrayUtil::isAssociative($val)) {
				$item = new ConfigurationParameterGroup($key, $val);
			} else {
				$item = new ConfigurationParameter($key, $val);
			}
			$this->items[$key] = $item;
		}
	}

	public function getParam($key, $default=null) {
		if(!isset($this->items[$key]) || !$this->items[$key] instanceof ConfigurationParameter) {
			if($default === null) {
				throw new ConfigurationException("No configuration parameter '$key' exists");
			} else {
				return new ConfigurationParameter($key, $default);
			}
		}
		return $this->items[$key];
	}

	public function getGroup($key) {
		if(!isset($this->items[$key]) || !$this->items[$key] instanceof ConfigurationParameterGroup) {
			throw new ConfigurationException("No configuration parameter group '$key' exists");
		}
		return $this->items[$key];
	}

	public function getAllGroups() {
		$result = array();
		foreach($this->items as $item) {
			if($item instanceof ConfigurationParameterGroup) {
				$result[] = $item;
			}
		}
		return $result;
	}

}
?>
