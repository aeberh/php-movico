<?
class BubbleSortGame {
	
	private $grid;
	private $faults;
	private $timer;
	
	public function __construct() {
		$this->grid = BubbleSortGrid::generate();
		$this->timer = new SecondsChrono();
	}
	
	public function start() {
		$this->timer->start();
	}
	
	public function stop() {
		$this->timer->stop();
	}
	
	public function clickFieldWithIndex($index) {
		return $this->grid->click($index);
	}
	
	// Getters
	
	public function getGrid() {
		return $this->grid;
	}
	
	public function getTime() {
		return $this->timer->getTime();
	}
	
}
?>