<?
class BoggleBean extends RequestBean {
	
	private $started = false;
	private $layout;
	
	public function isUnstarted() {
		return !$this->started;
	}
	
	public function start() {
		$this->started = true;
		$grid = BoggleGrid::generate("nl");
		$this->layout = $grid->getLayout();
		return null;
	}
	
	public function getLayout() {
		return $this->layout;
	}
	
}
?>