<?php
class SqlGenerator {

	public function generate($entities) {
		PrintUtil::log("Generating sql scripts... ");
		$sql = "";
		foreach ($entities as $entity) {
			$sql .= $this->generateSql($entity) . "\n\n";
		}
		foreach(Singleton::create("ServiceBuilder")->getManyToManyMappingTables() as $table=>$props) {
			$sql .= $this->generateMappingTable($table, $props);
		}
		FileUtil::storeFileContents("src/sql/tables.sql", $sql);
		$data = FileUtil::fileExists("src/sql/data.sql") ? FileUtil::getFileContents("src/sql/data.sql") : "";
		FileUtil::storeFileContents("src/sql/all.sql", $sql.$data);
		PrintUtil::logln("SQL scripts generated.");
	}
	
	private function generateSql(Entity $entity) {
		$table = $entity->getTable();
		$primKey = $entity->getPrimaryKey();
		$sql = "CREATE TABLE `$table` (\n";
		$sql .= "\t`{$primKey->getName()}` {$primKey->getDbType()} NOT NULL AUTO_INCREMENT,\n";
		foreach($entity->getProperties() as $property) {
			$sql .= "\t`{$property->getName()}` {$property->getDbType()} NOT NULL,\n";
		}
		foreach(Singleton::create("ServiceBuilder")->getOneToManyMappedProperties($entity) as $property) {
			$sql .= "\t`{$property->getMappingKey()}` {$property->getEntity()->getPrimaryKey()->getDbType()} NOT NULL,\n";
		}
		$sql .= implode(",\n", $this->generateIndexes($entity));
		$sql .= "\n);";
		return $sql;
	}
	
	private function generateMappingTable($table, $props) {
		$sql = "CREATE TABLE `$table` (\n";
		$pkNames = array();
		foreach($props as $prop) {
			$pk = Singleton::create("ServiceBuilder")->getEntity($prop->getEntityName())->getPrimaryKey();
			$pkName = "`{$pk->getName()}`";
			$sql .= "\t$pkName {$pk->getDbType()} NOT NULL,\n";
			$pkNames[] = $pkName;
		}
		return $sql."\t PRIMARY KEY (".implode(",", $pkNames).")\n);\n\n";
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
