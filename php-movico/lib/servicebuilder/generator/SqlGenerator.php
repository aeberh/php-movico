<?php
class SqlGenerator {

	public function generate($entities) {
		PrintUtil::log("Generating sql scripts... ");
		$sql = "";
		foreach ($entities as $entity) {
			$sql .= $this->generateSql($entity) . "\n\n";
		}
		FileUtil::storeFileContents("src/sql/tables.sql", $sql);
		PrintUtil::logln("SQL scripts generated.");
	}
	
	private function generateSql(Entity $entity) {
		$table = $entity->getTable();
		$primKey = $entity->getPrimaryKey();
		$sql = "CREATE TABLE `$table` (\n";
		$sql .= "\t`{$primKey->getName()}` {$primKey->getDbType()} unsigned NOT NULL AUTO_INCREMENT,\n";
		foreach($entity->getProperties() as $property) {
			$sql .= "\t`{$property->getName()}` {$property->getDbType()} NOT NULL,\n";
		}
		$sql .= implode(",\n", $this->generateIndexes($entity));
		$sql .= "\n);";
		return $sql;
	}
	
	private function generateIndexes(Entity $entity) {
		$indexes = array("\tPRIMARY KEY (`{$entity->getPrimaryKey()->getName()}`)");
		foreach($entity->getFinders() as $finder) {
			$indexes[] = "\t".$finder->getIndexDefinition();
		}
		return $indexes;
	}

}
?>
