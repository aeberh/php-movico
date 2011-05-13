<?
abstract class Chrono {
	
	private $started;
	private $start;
	private $time;
	
	public function start() {
		if($this->started) {
			throw new ChronoAlreadyStartedException($this->getTime());
		}
		$this->start = $this->getCurrentTime();
		$this->started = true;
	}
	
	public function stop() {
		if(!$this->started) {
			throw new ChronoNotYetStartedException();
		}
		$this->started = false;
		$this->time = $this->getCurrentTime() - $this->start;
		return $this->time;
	}
	
	public function getTime() {
		return $this->started ? $this->getCurrentTime() - $this->start : $this->time;
	}
	
	protected abstract function getCurrentTime();
	
}
?>