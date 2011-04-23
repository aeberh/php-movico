<?
class BoggleBean extends SessionBean {
	
	private $layout;
	private $words;
	private $word;
	
	public function __construct() {
		$this->layout = BoggleGrid::generate("nl")->getLayout();
		$this->words = array();
	}
	
	public function addWord() {
		$this->words[] = $this->word;
		$this->word = "";
		return null;
	}
	
	public function setWord($word) {
		$this->word = $word;
	}
	
	public function getWord() {
		return $this->word;
	}
	
	public function getWords() {
		return $this->words;
	}
	
	public function getColumns() {
		return sqrt(count($this->layout));
	}
	
	public function getLayout() {
		return $this->layout;
	}
	
}
?>