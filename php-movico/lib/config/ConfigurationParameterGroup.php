<?php
class ConfigurationParameterGroup extends ConfigurationItem {

	private $params;

	public function __construct($key, $values) {
		parent::__construct($key);
		foreach($values as $ckey=>$cval) {
			$this->params[$ckey] = new ConfigurationParameter($ckey, $cval);
		}
	}

	public function getParam($key, $default=null) {
		$item = $this->params[$key];
		if(!isset($item) || !$item instanceof ConfigurationParameter) {
			if($default === null) {
				throw new ConfigurationException("No configuration parameter '$key' exists inside group '{$this->key}'");
			} else {
				$item = new ConfigurationParameter($key, $default);
			}
		}
		return $item;
	}

	public function getAllParams() {
		return $this->params;
	}

}
?>
