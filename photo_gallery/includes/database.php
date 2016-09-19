<?php
/*
	Lembrar de passar tudo para msqli, msql
	está obsoleto hoje em dia
*/

require_once("config.php");

class MySQLDatabase {
	
	private $connection;
	private $magic_quotes_active;
	private $real_escape_string_exists;
	public $last_query;


  function __construct() {
    $this->open_connection();
		$this->magic_quotes_active = get_magic_quotes_gpc();
		$this->real_escape_string_exists = function_exists( "mysqli_real_escape_string" );
  }

	public function open_connection() {
		$this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		if (!$this->connection) {
			die("Database connection failed: " . mysqli_error());
		} else {
			$db_select = mysqli_select_db(DB_NAME, $this->connection);
			if (!$db_select) {
				die("Database selection failed: " . mysqli_error());
			}
		}
	}

	public function query($sql) {
		// sempre salvando a última query executada
		$this->last_query = $sql;
		$result = mysqli_query($sql, $this->connection);
		$this->confirm_query($result);
		return $result;
	}
	
	public function escape_value( $value ) {
		if( $this->real_escape_string_exists ) { // PHP v4.3.0 or higher
			// undo any magic quote effects so mysql_real_escape_string can do the work
			if( $this->magic_quotes_active ) { $value = stripslashes( $value ); }
			$value = mysqli_real_escape_string( $value );
		} else { // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if( !$this->magic_quotes_active ) { $value = addslashes( $value ); }
			// if magic quotes are active, then the slashes already exist
		}
		return $value;
	}
	
	
	//*** Métodos feitos para uma futura adaptação com 
	// outro banco de dados, dessa forma podemos 
	// fazer as alterações aqui sem ter que chamar
	// explicitamente a função msqli do código.

	// "database-neutral" methods
  public function fetch_array($result_set) {
    return mysql_fetch_array($result_set);
  }
  
  public function num_rows($result_set) {
   return mysqli_num_rows($result_set);
  }
  
  public function insert_id() {
		// get the last id inserted over the current db connection
    return mysqli_insert_id($this->connection);
  }
  
  public function affected_rows() {
    return mysqli_affected_rows($this->connection);
  }


	private function confirm_query($result) {
		if (!$result) {
			$output = "Database query failed: " . msqli_error(). "<br />";
			$output .= "Last SQL query: " . $this->last_query;
			die("$output");
		}
	}

	public function close_connection() {
		if(isset($this->connection)) {
			mysqli_close($this->connection);
			unset($this->connection);
		}
	}
}
// é possível ficar chamando esse objeto
// sem precisar instanciar sempre em outra classe, 
// ou em qualquer outra parte de projeto uma vez
// que o arquivo tenha require_once database...
$database = new MySQLDatabase();
$db =& $database;

?>