<?php
class FileBrowser extends Component {

	public function doRender($rowIndex=null) {
		$ctx = parent::$settings->getContextPath();
		$finder = new CKFinder("$ctx/lib/component/input/ckfinder/") ;
		//$finder->SelectFunction = 'ShowFileInfo';
		return $finder->CreateHtml();
	}

}
?>