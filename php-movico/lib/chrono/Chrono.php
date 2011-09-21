<?php
class Chrono {
	
	private $started;
	private $startTime;
	private $time;
	
	private $stops;
	
	public function start() {
		if($this->started) {
			throw new ChronoAlreadyStartedException();
		}
		$this->tick("START");
		$this->started = true;
	}
	
	public function stop() {
		if(!$this->started) {
			throw new ChronoNotYetStartedException();
		}
		$this->tick("STOP");
		$this->started = false;
	}
	
	public function tick($label) {
		$this->stops[] = new ChronoStop($label, $this->getCurrentTime());
	}
	
	public function out() {
		$curTime = $this->stops[0]->getTime();
		$totalTime = 0;
		foreach($this->stops as $stop) {
			$diffTime = $stop->getTime() - $curTime;
			$totalTime += $diffTime;
			if(round($diffTime) > 100) {
				echo $stop->getLabel()." - ".round($totalTime)."ms (+".round($diffTime)."ms)<br/>";
			}
			$curTime = $stop->getTime();
		}
		echo "TOTAL: {$totalTime}ms";
	}
	
	private function getCurrentTime() {
		return microtime(true)*1000;
	}
	
}
?>