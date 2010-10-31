<?
class CounterBean extends ApplicationBean {
	
	private $count = 0;
	
	public function increment() {
		$this->count++;
		return null;
	}
	
	public function getCount() {
		return $this->count;
	}
	
}
?>