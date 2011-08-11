<?php
class MovicoRequest {
	
	const ACTION = "MovicoAction";
	const ROW_INDEX = "MovicoRowIndex";
	const PREV_URL = "MovicoPreviousUrl";
	const ACTION_PARAM = "MovicoActionParam";
	const URL = "u";
	
	private $post;
	private $get;
	private $files;
	
	public function __construct($get, $post, $files) {
		$this->get = HashMap::fromArray("string", "?", $get);
		$this->post = HashMap::fromArray("string", "?", $post);
		$this->files = HashMap::fromArray("string", "?", $files);
		PrintUtil::out($get);
		PrintUtil::out($post);
		PrintUtil::out($files);
	}
	
	public function isRenderUrl() {
		return $this->get->has(self::URL);
	}
	
	public function isActionUrl() {
		return $this->post->has(self::ACTION);
	}
	
	public function getUrl() {
		return $this->get->get(self::URL);
	}
	
	public function getAction() {
		return $this->post->get(self::ACTION);
	}
	
	public function getRowIndex() {
		return $this->post->get(self::ROW_INDEX);
	}
	
	public function getPreviousUrl() {
		return $this->post->get(self::PREV_URL);
	}
	
	public function getActionParams() {
		if($this->post->has(self::ACTION_PARAM) && $this->post->get(self::ACTION_PARAM)->has($this->getAction()."_".$this->getRowIndex())) {
			return $this->post->get(self::ACTION_PARAM)->get($this->getAction()."_".$this->getRowIndex())->toArray();
		}
		return array();
	}
	
	public function getPostVars() {
		return $this->post;
	}
	
	public function getFiles() {
		return $this->files;
	}
	
}
?>