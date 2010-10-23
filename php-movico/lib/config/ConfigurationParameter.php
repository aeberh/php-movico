<?php
class ConfigurationParameter extends ConfigurationItem {

	private $values;

	public function __construct($key, $values) {
		parent::__construct($key);
		$this->values = $values;
	}

	public function getValue() {
		if($this->hasMultipleValues()) {
			throw new ConfigurationException("Parameter with key '{$this->key}' has multiple values");
		}
		return $this->values;
	}

	public function getValues() {
		if(!$this->hasMultipleValues()) {
			throw new ConfigurationException("Parameter with key '{$this->key}' has only one value");
		}
		return $this->values;
	}

	private function hasMultipleValues() {
		return is_array($this->values);
	}

}
?>
