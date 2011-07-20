<?
class String implements IteratorAggregate {
	
	private $string;
	
	public function __construct($string) {
		$this->string = $string;
	}
	
	public static function fromPrimitives(array $strings) {
		$result = new ArrayList("String");
		foreach ($strings as $string) {
			$result->add(self::create($string));
		}
		return $result;
	}
	
	public static function create($str) {
		return new String($str);
	}
	
	public function length() {
		return strlen($this->string);
	}
	
	public function charAt($index) {
		if(!$this->isValidIndex($index)) {
			throw new IndexOutOfBoundsException();
		}
		return self::create($this->string[$index]);
	}
	
	public function getFirstChar() {
		return $this->charAt(0);
	}
	
	public function getLastChar() {
		return $this->charAt($this->length()-1);
	}
	
	public function substring($start, $end=-1) {
		$length = ($end === -1) ? $this->length()-$start : $end-$start;
		return self::create(substr($this->string, $start, $length));
	}
	
	public function split($delimiter, $limit=null) {
		self::toObject($delimiter);
		if($delimiter->isEmpty()) {
			$list = array($this);
		} else {
			$list = is_null($limit) ? explode($delimiter, $this->string) : explode($delimiter, $this->string, $limit);
		}
		return self::fromPrimitives($list);
	}
	
	public function toLowerCase() {
		return self::create(strtolower($this->string));
	}
	
	public function toUpperCase() {
		return self::create(strtoupper($this->string));
	}
	
	public function trim() {
		return self::create(trim($this->string));
	}
	
	public function indexOf($needle, $offset=0) {
		self::toObject($needle);
		$result = $needle->isEmpty() ? false : strpos($this->string, $needle->string, $offset);
		return $result === false ? -1 : $result;
	}
	
	public function indexesOf($needle) {
		$result = new ArrayList("integer");
		$offset = 0;
		do {
			$index = $this->indexOf($needle, $offset);
			if($index == -1) {
				break;
			}
			$result->add($index);
			$offset = $index+1;
		} while(true);
		return $result;
	}
	
	public function contains($needle) {
		self::toObject($needle);
		return $this->indexOf($needle) > -1;
	}
	
	public function startsWith($substring) {
		self::toObject($substring);
		return $this->indexOf($substring) === 0;
	}
	
	public function endsWith($substring) {
		self::toObject($substring);
		$index = $this->length() - $substring->length();
		return $this->indexOf($substring) === $index;
	}
	
	public function getMatches($regex) {
		self::toObject($regex);
		preg_match_all($regex, $this, $matches, PREG_SET_ORDER);
		$result = new ArrayList("ArrayList");
		foreach($matches as $match) {
			$list = new ArrayList("String");
			foreach($match as $m) {
				$list->add(self::create($m));
			}
			$result->add($list);
		}
		return $result;
	}
	
	public function compareTo(String $other) {
		return strcmp($this->string, $other->string);
	}
	
	public function isEmpty() {
		return "" === $this->string;
	}
	
	public function remove($part) {
		return $this->replace($part, "");
	}
	
	public function replace($search, $by) {
		self::toObject($search);
		self::toObject($by);
		return self::create(str_replace($search, $by, $this->string));
	}
	
	public static function BLANK() {
		return self::create("");
	}
	
	public function append(String $other) {
		return self::create($this->string.$other->__toString());
	}
	
	public function getIterator() {
		$chars = array();
		for($i=0; $i<$this->length(); $i++) {
			$chars[] = self::create($this->string[$i]);
		}
		return new ArrayIterator($chars);
	}
	
	private function isValidIndex($index) {
		if($this->isEmpty()) {
			return false;
		}
		return $index >= 0 && $index < $this->length();
	}
	
	private static function toObject(&$input) {
		if(is_string($input)) {
			$input = self::create($input);
		}
	}
	
	public function __toString() {
		return $this->string;
	}
	
}
?>