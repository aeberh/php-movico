<?php
class InputRichText extends AbstractInput {
	
	public function doRender($index=null) {
		$ctx = Singleton::create("Settings")->getContextPath();
		$editor = new CKEditor("$ctx/lib/component/input/ckeditor/");
		$editor->returnOutput = true;
		return $editor->editor($this->value, $this->getConvertedValue($this->value, $index));
	}
	
//	public function doRender($index=null) {
//		return "<textarea id=\"editor1\" name=\"editor1\">&lt;p&gt;Initial value.&lt;/p&gt;</textarea>".
//			"<script type=\"text/javascript\">".
//			"CKEDITOR.replace( 'editor1' );".
//			"</script>";
//	}
	
	public function getType() {
		return null;
	}
	
}
?>