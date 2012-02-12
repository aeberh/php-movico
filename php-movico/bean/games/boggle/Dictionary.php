<?php
class Dictionary {
	
	private $words;
	
	private function __construct($words) {
		$this->words = $words;
	}
	
	public function getWords() {
		return $this->words;
	}
	
	public static function create($lang, $size) {
		$file = file("bean/games/boggle/data/glossary/{$lang}_{$size}", FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
		return new Dictionary($file);
	}
	
	public function contains(BoggleWord $word) {
		$wordStr = $word->getWord()->__toString();
		$lo = 0;
		$hi = count($this->words)-1;
		
		while($lo <= $hi) {
			$mid = (int)(($hi-$lo)/2)+$lo;
			$cmp = strcmp($this->words[$mid], $wordStr);
			if($cmp < 0)
				$lo = $mid+1;
			elseif($cmp > 0)
				$hi = $mid-1;
			else
				return true;
		}
		return false;
	}
	
	public function getPossibleWords(BoggleGrid $grid) {
		$result = array();
		foreach($this->words as $word) {
			$w = new BoggleWord($word);
			$possible = true;
			foreach($w->getWord() as $char) {
				if(!$grid->getLayout()->contains($char)) {
					$possible = false;
					break;
				}
			}
			if(!$possible) {
				continue;
			}
			if($w->isPossibleInLayout($grid)) {
				$result[] = $w->getWord();
			}
		}
		return $result;
	}
	
}
?>