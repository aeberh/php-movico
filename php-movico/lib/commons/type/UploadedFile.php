<?php
class UploadedFile {
	
	private $originalClientName;
	private $mimeType;
	private $size; //in bytes
	private $tempServerName;
	private $errorCode; //see http://www.php.net/manual/en/features.file-upload.errors
	private $relativeDestination;
	
	public function __construct($postFile) {
		$this->originalClientName = $postFile["name"];
		$this->mimeType = $postFile["type"];
		$this->size = $postFile["size"];
		$this->tempServerName = $postFile["tmp_name"];
		$this->errorCode = $postFile["error"];
	}
	
	public function moveToFile($destinationFile) {
		if(!move_uploaded_file($this->tempServerName, $destinationFile)) {
			throw new FileUploadException("File cannot be moved from temporary directory");
		}
	}
	
	public function moveToDir($destinationDir, $renamedFile=null) {
		$newName = is_null($renamedFile) ? $this->getFileName() : $renamedFileName;
		$root = Singleton::create("Settings")->getRootPath();
		$relativeDestination = "$destinationDir/$newName";
		$uploadDestination = "$root/$relativeDestination";
		if(!move_uploaded_file($this->tempServerName, $uploadDestination)) {
			throw new FileUploadException("File cannot be moved from temporary directory");
		}
		$this->relativeDestination = $relativeDestination;
	}
	
	public function getDescriptiveError() {
		switch($this->errorCode) {
			case UPLOAD_ERR_OK: return "Success";
			case UPLOAD_ERR_INI_SIZE: return "Maximum server-side file size exceeded";
			case UPLOAD_ERR_FORM_SIZE: return "Maximum client-side file size exceeded";
			case UPLOAD_ERR_PARTIAL: return "File was only partially uploaded";
			case UPLOAD_ERR_NO_FILE: return "No file was uploaded";
			case UPLOAD_ERR_NO_TMP_DIR: return "No temporary directory defined";
			case UPLOAD_ERR_CANT_WRITE: return "Failed to write to disk";
			case UPLOAD_ERR_EXTENSION: return "An extension stopped the file upload";
		}
	}
	
	public function isUploadSuccess() {
		return $this->errorCode == UPLOAD_ERR_OK;
	}
	
	public function getRelativeDestination() {
		return $this->relativeDestination;
	}
	
	public function getFileName() {
		return basename($this->originalClientName);
	}
	
	public function getSize() {
		return $this->size;
	}
	
}
?>