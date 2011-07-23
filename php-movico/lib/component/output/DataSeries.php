<?
abstract class DataSeries extends Component {
	
	protected $value;
	protected $var;
	protected $rows;
	protected $columnClasses;
	protected $pagination;
	
	public function getValue() {
		return $this->value;
	}
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function setColumnClasses($columnClasses) {
		$this->columnClasses = $columnClasses;
	}
	
	protected function getCurrentColumnClass($i) {
		$this->classList = String::create($this->columnClasses)->split(",");
		return $this->classList->get($i % $this->classList->size())->getPrimitive();
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
	
	public function isPagination() {
		return $this->pagination;
	}
	
	public function setPagination($pagination) {
		$this->pagination = $pagination;
	}
	
}
?>