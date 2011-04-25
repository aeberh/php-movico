<?
class BoggleGrid {
	
	private $lang;
	private $layout;
	
	private function __construct($lang) {
		$this->lang = $lang;
		$this->generateLayout();
	}
	
	public static function generate($lang) {
		return new BoggleGrid($lang);
	}
	
	private function generateLayout() {
		$content = file_get_contents("bean/games/boggle/blocks/{$this->lang}");
		$dice = explode("\n", $content);
		$this->layout = array();
		foreach ($dice as $die) {
			$possibilities = explode(" ", $die);
			$this->layout[] = $possibilities[array_rand($possibilities)];
		}
		shuffle($this->layout);
	}
	
	public function getLayout() {
		return $this->layout;
	}
	
	/*
	public function getTable() {
		$result = "<table class=\"grid\"><tr>";
		for($i=0; $i<count($this->layout); $i++) {
			$result .= "<td>".$this->layout[$i]."</td>";
			if($i%4 === 3) {
				$result .= "</tr><tr>";
			}
		}
		return $result."</tr></table>";
	}
	*/

}
?>