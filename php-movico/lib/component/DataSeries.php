<?
abstract class DataSeries extends Component {
	
	protected $value;
	protected $var;
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function setVar($var) {
		$this->var = $var;
	}
	
	public function getVar() {
		return $this->var;
	}
	
	public function getValue() {
		return $this->value;
	}
	
}
?>