<?
abstract class DataSeries extends Component {
	
	protected $value;
	protected $var;
	protected $rows;
	
	public function getValue() {
		return $this->value;
	}
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function getVar() {
		return $this->var;
	}
	
	public function setVar($var) {
		$this->var = $var;
	}
	
	public function getRows() {
		return $this->rows;
	}
	
	public function setRows($rows) {
		$this->rows = $rows;
	}
	
}
?>