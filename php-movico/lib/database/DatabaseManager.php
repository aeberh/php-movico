<?php
/**
 * This is an OO version of the mysql commands. Each query is executed in its
 * own connection. Database parameters should be in the database.conf configuration
 * file.
 */
class DatabaseManager {

	private $host, $db, $user, $pass;
	private $conn = false;
	
	private $nbQueries = 0;
	private $showSql;

	/**
	 * Initializes a new DatabaseManager
	 */
	public function __construct() {
		$settings = Singleton::create("Settings");
		$this->showSql = $settings->showSql();
		$this->importParameters($settings->getEnvironment());
	}

	private function importParameters($env) {
		$dbConfig = new ConfigurationFile(ConfigurationConstants::DB_CONFIG);
		$params = $dbConfig->getGroup($env);
		$this->host = $params->getParam("mysql_host")->getValue();
		$this->db = $params->getParam("mysql_db")->getValue();
		$this->user = $params->getParam("mysql_user")->getValue();
		$this->pass = $params->getParam("mysql_pass")->getValue();
	}

	private function connect() {
		if($this->conn !== false)
			throw new DatabaseException("Trying to reconnect to an already connected database");
		if(($this->conn = @mysql_connect($this->host, $this->user, $this->pass)) === false)
			throw new DatabaseException("Error connecting to the database");
		if(@mysql_select_db($this->db, $this->conn) === false)
			throw new DatabaseException("Error selecting database");
	}

	private function disconnect() {
		if($this->conn === false)
			throw new DatabaseException("The connection is already closed");
		if(@mysql_close($this->conn) === false)
			throw new DatabaseException("Failed to disconnect from the database");
		$this->conn = false;
	}

	/**
	 * @param   $query  The select query to execute.
	 * @throws  DatabaseException if:
	 *          * An error occurred during the execution of the query.
	 *          * The query didn't return a resultset (it was an update query).
	 * @return  ResultSet containing the result of the query.
	 */
	public function selectQuery($query) {
		$this->logQuery($query);
		$this->connect();
		$resource = @mysql_query($query, $this->conn);
		if(get_resource_type($resource) === false)
			throw new DatabaseException("Query '$query' does not return a resultset");
		if($resource === false)
			throw new DatabaseException(mysql_error($this->conn));
		$result = array();
		while($row = @mysql_fetch_assoc($resource))
			$result[] = $row;
		$this->disconnect();
		return new ResultSet($result);
	}

	/**
	 * @param   $query  The select query to execute.
	 * @throws  DatabaseException if an error occurred during the query execution.
	 */
	public function updateQuery($query) {
		$this->logQuery($query);
		$this->connect();
		$ok = @mysql_query($query, $this->conn);
		if(!$ok) {
			$error = mysql_error($this->conn);
			$this->disconnect();
			if(StringUtil::contains($error, "Duplicate entry")) {
				throw new UniqueConstraintViolationException($error);
			} elseif(StringUtil::contains($error, "Table") && StringUtil::contains($error, "doesn't exist")) {
				throw new DatabaseTableNotExistsException($error);
			} else {
				throw new DatabaseException("Unknown error while executing query: ".$error);
			}
		}
		$this->disconnect();
	}
	
	private function logQuery($query) {
		if($this->showSql) {
			$this->nbQueries++;
			echo $this->nbQueries.". ".$query."<br/>";
		}
	}

}
?>