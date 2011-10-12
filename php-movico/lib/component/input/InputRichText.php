<?php
class InputRichText extends Component {
	
	private $value;
	private $fileBrowser = "true";
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function setFileBrowser($fileBrowser) {
		$this->fileBrowser = $fileBrowser;
	}
	
	public function doRender($index=null) {
		$ctx = parent::$settings->getContextPath();
		$editor = new CKEditor("$ctx/lib/component/input/ckeditor/");
		$editor->returnOutput = true;
		$editor->config['toolbar'] = array(
			array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
			array( 'Image', 'Link', 'Unlink', 'Anchor' )
		);
		$editor->textareaAttributes = array("class"=>"MovicoInputRichText", "id"=>($this->id.rand(10000,99999)));
		if($this->fileBrowser === "true") {
			$finder = new CKFinder("$ctx/lib/component/input/ckfinder/");
			$finder->SetupCKEditorObject($editor);
		}
		return $editor->editor($this->value, $this->getConvertedValue($this->value, $index));
	}
	
}
?>