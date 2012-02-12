<?php
class BoggleWord implements Comparable {
	
	private $word;
	
	public function __construct($word) {
		$this->word = String::create($word)->trim()->toUpperCase();
	}
	
	public function getLength() {
		return $this->word->length();
	}
	
	public function getWord() {
		return $this->word;
	}
	
	public function getPoints($pointsList) {
		try {
			return $pointsList->get($this->getLength());
		} catch(IndexOutOfBoundsException $e) {
			return $pointsList->getLast();
		}
	}
	
	public function isPossibleInLayout(BoggleGrid $grid) {
		return !$this->getPossibleCombinations($grid)->isEmpty();
	}
	
	private function getPossibleCombinations(BoggleGrid $grid) {
		$results = new ArrayList("ArrayList");
		$results->add(new ArrayList("integer"));
		foreach($this->word as $char) {
			$newResults = new ArrayList("ArrayList");
			foreach($grid->getIndices($char) as $index) {
				foreach($results as $result) {
					if($result->contains($index) || (!$result->isEmpty() && !$grid->isIndicesAdjacent($result->getLast(), $index))) {
						continue;
					}
					/*
					$newResult = new ArrayList("integer");
					$newResult->addAll($result);
					$newResult->add($index);
					*/
					$newResult = clone($result);
					$newResult->add($index);
					$newResults->add($newResult);
				}
			}
			$results = clone($newResults);
			//$results = new ArrayList("ArrayList");
			//$results->addAll($newResults);
		}
		return $results;
	}
	
	public function compareTo(self $other) {
		return $this->word->compareTo($other->word);
	}
	
}
?>