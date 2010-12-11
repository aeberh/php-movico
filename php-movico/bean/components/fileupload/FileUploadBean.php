<?
class FileUploadBean extends RequestBean {
	
	private $file;
	
	public function upload() {
		if($this->file->isUploadSuccess()) {
			$this->file->moveToDir("tmp");
		}
		return null;
	}
	
	public function getShowSize() {
		return !empty($this->file);
	}
	
	public function setFile(UploadedFile $file) {
		$this->file = $file;
	}
	
	public function getFile() {
		return $this->file;
	}
	
}
?>