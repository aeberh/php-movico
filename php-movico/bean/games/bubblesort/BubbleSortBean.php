<?
class BubbleSortBean extends SessionBean {
	
	private $grid;
	
	public function __construct() {
		$this->grid = BubbleSortGrid::generate();
	}
	
	public function clickField() {
		$this->grid->click($this->getSelectedRowIndex());
	}
	
	public function getGrid() {
		return $this->grid;
	}
	
}
?>