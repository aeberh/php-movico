<?
class BoggleBean extends SessionBean {
	
	private $layout;
	private $words;
	private $word;
	
	private $glossary;
	
	private static $POINTS = array(3=>1, 4=>1, 5=>2, 6=>3, 7=>5, 8=>11);
	
	public function __construct() {
		$this->layout = BoggleGrid::generate("nl")->getLayout();
		$this->glossary = file("bean/games/boggle/glossary/nl", FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
		$this->words = array();
	}
	
	public function addWord() {
		try {
			$word = trim($this->word);
			$this->validateWord($word);
			$this->words[] = $word;
			sort($this->words);
			MessageUtil::info("Word $word was added to the list");
		} catch(BoggleWordException $e) {
			MessageUtil::error($e->getMessage());
		}
		$this->word = "";
		return null;
	}
	
	private function validateWord($word) {
		if(strlen($word) < 3) {
			throw new IllegalWordLengthException("Word should at least have 2 characters");
		}
		if(in_array($word, $this->words)) {
			throw new WordAlreadyEnteredException("Word was already entered before");
		}
		if(false) {
			throw new WordNotPossibleException("Word is impossible to make");
		}
		if(!in_array($word, $this->glossary)) {
			throw new WordNotInDictionaryException("Word doesn't exist in dicionary");
		}
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
	
	public function getPoints() {
		$result = 0;
		foreach($this->words as $word) {
			$result += self::$POINTS[strlen($word)];
		}
		return $result;
	}
	
	public function getColumns() {
		return sqrt(count($this->layout));
	}
	
	public function getLayout() {
		return $this->layout;
	}
	
}
?>