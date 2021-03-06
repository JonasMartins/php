<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');

class User extends DatabaseObject{

  /**
   * [$table_name description]
   * @var string
   * $table_name: a help when static method calls him, 
   * to be more abstract as possible and help to decide 
   * what table put in some sql queries. 
   *    
   */ 
  protected static $table_name="users";
  /**
   * [$db_fields description]
   * @var array 
   * A helper when we want to "clean" the arguments that 
   * we want over a specifc class, not all the attributes
   * but only those who concern about our database
   */
  public static $db_fields = array('id', 'username', 'password', 'first_name', 'last_name');

  public $id;
  public $username;
  public $password;
  public $first_name;
  public $last_name;

  public function full_name(){
    if(isset($this->first_name) && isset($this->last_name)){
      return $this->first_name . " " . $this->last_name;
    }else { return " "; }
  }

  // Método authenticate usando na verificação de 
  // login de um usuário 
  
  /**
   * 
   * @param [type] $[username] [<description>]  string
   * @param [type] $[password] [<description>]  string
   * @return [type] [retorna true or false] [type]
   *
   * Método authenticate que verifica se a os dados 
   * do usuário foram insridos e valida o seu login
   */
  public static function authenticate($username="", $password="") {
    //global $database;

    // aqui estava o erro, em escape_value
    //$username = $database->escape_value($username);
    //$password = $database->escape_value($password);

    $sql  = "SELECT * FROM users ";
    $sql .= "WHERE username = '{$username}' ";
    $sql .= "AND password = '{$password}' ";
    $sql .= "LIMIT 1";
    $result_array = self::find_by_sql($sql);
    return !empty($result_array) ? array_shift($result_array) : false;
  }



/*
// falta testar ainda....
  protected static function attributes(){
    // return an array of attributes keys and their values
    return get_object_vars($this);
  }

  protected static function sanitized_attributes() {
    global $database;
    $clean_attributes = array();
    // sanitize the values before submitting
    // Note: does not alter the actual value of each attribute
    foreach($this->attributes() as $key => $value){
      $clean_attributes[$key] = $database->escape_value($value);
    }
    return $clean_attributes;
  }
  
  */

  /*

  public function save() {
    // A new record won't have an id yet.
    return isset($this->id) ? $this->update() : $this->create();
  }

   public function create() {
    global $database;
    // Don't forget your SQL syntax and good habits:
    // - INSERT INTO table (key, key) VALUES ('value', 'value')
    // - single-quotes around all values
    // - escape all values to prevent SQL injection
    $sql = "INSERT INTO ".self::$table_name." (";
    $sql .= "username, password, first_name, last_name";
    $sql .= ") VALUES ('";
    $sql .= $database->escape_value($this->username) ."', '";
    $sql .= $database->escape_value($this->password) ."', '";
    $sql .= $database->escape_value($this->first_name) ."', '";
    $sql .= $database->escape_value($this->last_name) ."')";
    if($database->query($sql)) {
      $this->id = $database->insert_id();
      return true;
    } else {
      return false;
    }
  }

  public function update() {
    global $database;
    // Don't forget your SQL syntax and good habits:
    // - UPDATE table SET key='value', key='value' WHERE condition
    // - single-quotes around all values
    // - escape all values to prevent SQL injection
    $sql = "UPDATE ".self::$table_name." SET ";
    $sql .= "username='". $database->escape_value($this->username) ."', ";
    $sql .= "password='". $database->escape_value($this->password) ."', ";
    $sql .= "first_name='". $database->escape_value($this->first_name) ."', ";
    $sql .= "last_name='". $database->escape_value($this->last_name) ."' ";
    $sql .= "WHERE id=". $database->escape_value($this->id);
    $database->query($sql);
    return ($database->affected_rows() == 1) ? true : false;
  }

  public function delete() {
      global $database;
    // Don't forget your SQL syntax and good habits:
    // - DELETE FROM table WHERE condition LIMIT 1
    // - escape all values to prevent SQL injection
    // - use LIMIT 1
    $sql = "DELETE FROM ".self::$table_name;
    $sql .= " WHERE id=". $database->escape_value($this->id);
    $sql .= " LIMIT 1";
    $database->query($sql);
    return ($database->affected_rows() == 1) ? true : false;
  
    // NB: After deleting, the instance of User still 
    // exists, even though the database entry does not.
    // This can be useful, as in:
    //   echo $user->first_name . " was deleted";
    // but, for example, we can't call $user->update() 
    // after calling $user->delete().
  }
  */
}

?>