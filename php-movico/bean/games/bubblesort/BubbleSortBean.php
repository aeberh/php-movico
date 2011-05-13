<?
class BubbleSortBean extends SessionBean {
	
	private $game;
	private $name;
	
	public function start() {
		$this->game = new BubbleSortGame();
		$this->game->start();
		return "games/bubblesort/bubble";
	}
	
	public function clickField() {
		$over = $this->game->clickFieldWithIndex($this->getSelectedRowIndex());
		if($over) {
			$this->game->stop();
			BubbleHighScoreServiceUtil::create($this->name, $this->game->getTime());
			return "games/bubblesort/results";
		}
		return null;
	}
	
	public function getHighScores() {
		return BubbleHighScoreServiceUtil::getBubbleHighScores();
	}
	
	// Getters & setters
	
	public function getName() {
		return $this->name; 
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function getGame() {
		return $this->game;
	}
	
}
?>