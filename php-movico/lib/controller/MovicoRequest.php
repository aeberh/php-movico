<?php
class MovicoRequest {
	
	const ACTION = "MovicoAction";
	const ROW_INDEX = "MovicoRowIndex";
	const PREV_URL = "MovicoPreviousUrl";
	const ACTION_PARAM = "MovicoActionParam";
	const URL = "u";
	
	const TYPE_PREFIX = "_type_";
	const DEFAULT_TYPE = "Null";
	
	private $post;
	private $get;
	private $files;
	
	private $postVars;
	
	public function __construct($get, $post, $files) {
		$this->get = HashMap::fromArray("string", "?", $get);
		$this->post = HashMap::fromArray("string", "?", $post);
		$this->files = $files;
		$this->postVars = new ArrayList("MovicoPostVar");
		foreach($post as $name=>$value) {
			if(String::create($name)->startsWith("#")) {
				$type = isset($post[self::TYPE_PREFIX.$name]) ? $post[self::TYPE_PREFIX.$name] : self::DEFAULT_TYPE;
				$this->postVars->add(new MovicoPostVar($name, $value, $type));
			}
		}
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
		return $this->postVars;
	}
	
	public function getFiles() {
		return $this->files;
	}
	
}
?>