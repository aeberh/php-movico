<?
class BoggleBean extends RequestBean {
	
	private $started = false;
	private $layout;
	
	public function isUnstarted() {
		return !$this->started;
	}
	
	public function start() {
		$this->started = true;
		$this->layout = BoggleGrid::generate("nl")->getLayout();
		return null;
	}
	
	public function getLayout() {
		return $this->layout;
	}
	
}
?>