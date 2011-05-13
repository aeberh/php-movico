<?php
class FileUtil {

	public static function fileExists($filename) {
		return file_exists($filename) && is_file($filename);
	}

	public static function directoryExists($dirName) {
		return file_exists($dirName) && is_dir($dirName);
	}

	public static function checkFileExists($filename) {
		if(!self::fileExists($filename)) {
			throw new FileNotExistsException($filename);
		}
	}

	public static function writeLines($filename, $lines) {
		$pointer = @fopen($filename, 'w');
		foreach($lines as $line) {
			@fwrite($pointer, $line."\n");
		}
		@fclose($pointer);
	}

	public static function getFileContents($filename) {
		self::checkFileExists($filename);
		return file_get_contents($filename);
	}

	public static function storeFileContents($filename, $content) {
		self::createFile($filename);
		$pointer = fopen($filename, "w+");
		fwrite($pointer, $content);
		fclose($pointer);
	}

	public static function createFile($filename) {
		if(self::fileExists($filename)) {
			return;
		}
		$path = dirname($filename);
		if(!self::directoryExists($path)) {
			mkdir($path, 0777, true);
		}
		$pointer = @fopen($filename, "w+");
		@chmod($filename, 0777);
		@fclose($pointer);
	}

	public static function generateRandomPhpFileName() {
		return rand(1000000, 9999999).".php";
	}
	
	public static function delete($filename) {
		@unlink($filename);
	}

}
?>
