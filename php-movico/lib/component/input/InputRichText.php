<?php
class InputRichText extends Component {
	
	private $value;
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function doRender($index=null) {
		$ctx = parent::$settings->getContextPath();
		$editor = new CKEditor("$ctx/lib/component/input/ckeditor/");
		$editor->returnOutput = true;
		$editor->config['toolbar'] = array(
			array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
			array( 'Image', 'Link', 'Unlink', 'Anchor' )
		);
		return $editor->editor($this->value, $this->getConvertedValue($this->value, $index));
	}
	
}
?>