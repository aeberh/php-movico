<?php
class EntityGenerator {

	public function generate(Entity $entity) {
		$className = "{$entity->getName()}";
		$destination = "src/impl/model/$className.php";
		if(FileUtil::fileExists($destination)) {
			return;
		}
		$content = "<?php\nclass $className extends {$className}Model {\n\n}\n?>";
		FileUtil::storeFileContents($destination, $content);
	}

}
?>
