<?php
class ExceptionGenerator {

	public function generate(Entity $entity) {
		$this->generateNoSuchModelException($entity);
	}

	private function generateNoSuchModelException(Entity $entity) {
		$className = "NoSuch{$entity->getName()}Exception";
		$content = "<?php\nclass $className extends Exception {\n\n}\n?>";
		$destination = "src/exceptions/$className.php";
		FileUtil::storeFileContents($destination, $content);
	}

}
?>
