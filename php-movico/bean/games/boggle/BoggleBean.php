<?
class BoggleBean extends SessionBean {
	
	private $name;
	private $lang;

	public function getName() {
		return $this->name;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function getLang() {
		return $this->lang;
	}
	
	public function setLang($lang) {
		$this->lang = $lang;
	}
	
	const TIMER = 10000;
	
	private $grid;
	private $words;
	private $word;
	private $dictionary;
	private $pointsList;
	private $millis;
	
	public function __construct() {
		$this->pointsList = HashMap::fromArray("integer", "integer", array(0=>0, 1=>0, 2=>0, 3=>1, 4=>1, 5=>2, 6=>3, 7=>5, 8=>11));
	}
	
	public function getMillis() {
		return $this->millis;
	}
	
	public function setMillis($millis) {
		$this->millis = $millis;
	}
	
	public function start() {
		$this->millis = self::TIMER;
		$this->grid = BoggleGrid::create($this->lang);
		$this->dictionary = Dictionary::create($this->lang, "4x4");
		$this->words = new ArrayList("BoggleWord");
		return "games/boggle/boggle";
	}
	
	public function stop() {
		BoggleHighScoreServiceUtil::create($this->name, $this->lang, $this->grid, $this->getPoints());
		return "games/boggle/results";
	}
	
	public function add() {
		try {
			$word = $this->addWord();
			MessageUtil::info("Word {$word->getWord()} was added to the list - {$word->getPoints($this->pointsList)} point(s)");
		} catch(BoggleWordException $e) {
			MessageUtil::error($e->getMessage());
		}
		$this->word = "";
		return null;
	}
	
	public function getHighScores() {
		return BoggleHighScoreServiceUtil::findByLang($this->lang);
	}
	
	private function addWord() {
		$word = new BoggleWord($this->word);
		$this->validate($word);
		$this->words->add($word);
		$this->words->sort();
		return $word;
	}

	private function validate(BoggleWord $word) {
		if($word->getLength() < 3) {
			throw new IllegalWordLengthException("Word should at least have 2 characters");
		}
		if($this->words->contains($word)) {
			throw new WordAlreadyEnteredException("Word was already entered before");
		}
		if(!$word->isPossibleInLayout($this->grid)) {
			throw new WordNotPossibleException("Word is impossible to make");
		}
		if(!$this->dictionary->contains($word)) {
			throw new WordNotInDictionaryException("Word doesn't exist in dictionary");
		}
	}
	
	public function setWord($word) {
		$this->word = $word;
	}
	
	public function getWord() {
		return $this->word;
	}
	
	public function getWords() {
		$result = array();
		foreach($this->words as $word) {
			$result[] = $word->getWord();
		}
		return $result;
	}
	
	public function getPoints() {
		$result = 0;
		foreach($this->words as $word) {
			$result += $word->getPoints($this->pointsList);
		}
		return $result;
	}
	
	public function getColumns() {
		return $this->grid->getColumns();
	}
	
	public function getLayout() {
		return $this->grid->getLayout()->toArray();
	}
	
}
?>