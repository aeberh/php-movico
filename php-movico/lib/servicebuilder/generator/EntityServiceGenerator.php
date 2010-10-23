<?php 
class EntityServiceGenerator {

	public function generate(Entity $entity) {
		$className = "{$entity->getName()}Service";
		$destination = "src/impl/service/$className.php";
		if(FileUtil::fileExists($destination)) {
			return;
		}
		$content = "<?php\nclass $className extends {$className}Base {\n\n}\n?>";
		FileUtil::storeFileContents($destination, $content);
	}

}
?>