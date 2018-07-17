<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');

class DatabaseObject {

/**
 *  ONLY THIS METHODS MUST BE STATIC AT FIRST PLACE....
 *  
 */	


    public static function find_all() {
      return static::find_by_sql("SELECT * FROM ".static::$table_name);
    }
    
    public static function find_by_id($id=0) {
      // aqui adequamos a mudança feita 
      // para o retorno do objeto ao invés de um
      // array
      global $database;
      $result_array = static::find_by_sql("SELECT * FROM ".static::$table_name." WHERE id=".$database->escape_value($id)." LIMIT 1");
      /*
       se o array es tiver vazio... retorna false
       se não faz um array shift no array resultante
       * fetch_array retira o primeiro elemento do array */
      return !empty($result_array) ? array_shift($result_array) : false;
    }
    /* Recebe qualquer string em forma de função
      e já a executa, e ao invés de simples retornar
      um array, já faz uma varredura no array e já  
      instancia e retorna o objeto relacionado.
     */
    public static function find_by_sql($sql="") {
      /* Notando que esse database é um objeto
        que é chamado em cima pelo require_once
        no arquivo database, notar a questão de
        mesmo sendo chamado tem esse global para
        referencia-lo.
        
       * fetch_array retira o primeiro elemento do array

      */
      global $database;  
      $result_set = $database->query($sql);
      $object_array = array();
      while ($row = $database->fetch_array($result_set)) {
        $object_array[] = static::instantiate($row);
      }
      return $object_array;
    }


    // Forma de como o Objeto se construir, sem ter que ficar 
    // ordenando os valores do arrey e passando para os 
    // atributos do objeto
    public static function instantiate($record){
      // checar antes se record existe e se é de fato um array
      $object = new static;
      // forma mais dinâmica de se preencher os atributos do 
      // objeto com as campos do array
      foreach($record as $attribute=>$value){
        if($object->has_attribute($attribute)){
          $object->$attribute = $value;
        }
      }
     /* 
      // forma mais trabalhosa de se preencher o objeto...
      // tendo que escrever todos os dados um por um. 

      $object = new self; // User();
      $object->id         = $record['id'];
      $object->username   = $record['username'];
      $object->password   = $record['password'];
      $object->first_name = $record['first_name'];
      $object->last_name  = $record['last_name'];
      */
      return $object;
    }


/**
 *  NON STATIC METHODS, SIMPLE HERITAGE
 */
  
  /**
   * [has_attribute description]
   * @param  [type]  $attribute [description]
   * @return boolean            [description]
   *      
   * Apenas saber se existe determinado atributo
   * no objeto que chamou esse atributo.
   * 
   */
  private function has_attribute($attribute){
    // get_object_vars retorna um array associado com todos
    // os atributos, incuindo os privados como keys e seus respectivos
    // valores como values    
    /**
     * Não á importancia com relação aos valores, apenas
     *  precisamos saber se eles de fato existem ou não, 
     *  retorna true or false
     */
    return array_key_exists($attribute, $this->attributes());

  }


  /**
   * @return [type] booelan [return an array of attributes
   *  keys and their values] [type] array
   *
   *  Fuñção refatorada  que usa apenas os campos
   *  usados pelo banco de dados para aquela classe
   *  específica.
   *
   *  Obs: Sempre lembrar de get_called_class()...
   */
  public function attributes(){
    
    /* Return object vars é de certa forma incoveniente
    para a nossa aplicação uma vez que traz todas as 
    variáveis e campos da classe, mas na verdade 
    precisaríamos de apenas alguns campos relativos
    ao banco de dados */
    // versão antiga trazendo todos os tipos de 
    // variáveis da classe static
    // return get_object_vars(new static);
    
    $attributes = array();
    foreach(static::$db_fields as $field) {
      if(property_exists($this, $field)) {
        $attributes[$field] = $this->$field;
      }
    }
    return $attributes;
  }

 public function sanitized_attributes() {
    global $database;
    $clean_attributes = array();
    // sanitize the values before submitting
    // Note: does not alter the actual value of each attribute
    foreach($this->attributes() as $key => $value){
      $clean_attributes[$key] = $database->escape_value($value);
    }
    return $clean_attributes;
  }

/**
 *  DATABASE CRUD FUNCTIONS 
 */
  public function save() {
    // A new record won't have an id yet.
    return isset($this->id) ? $this->update() : $this->create();
  }
  // all go
  public function create() {
    global $database;
    // Don't forget your SQL syntax and good habits:
    // - INSERT INTO table (key, key) VALUES ('value', 'value')
    // - single-quotes around all values
    // - escape all values to prevent SQL injection
    $this->id = $database->insert_id();
    $attributes = $this->sanitized_attributes();
    $sql = "INSERT INTO ".static::$table_name." (";
    $sql .= join(", ", array_keys($attributes));
    $sql .= ") VALUES ('";
    $sql .= join("', '", array_values($attributes));
    $sql .= "')";
    if($database->query($sql)) {
      return true;
    } else {
      return false;
    }
  }

  public function update($id) {
    global $database;
    
    /**
     * Don't forget your SQL syntax and good habits:
     * UPDATE table SET key='value', key='value' WHERE 
     * condition
     * single-quotes around all values
     *  - escape all values to prevent SQL injection
     */
    $attributes = $this->sanitized_attributes();
    $attribute_pairs = array();
    foreach($attributes as $key => $value) {
      $attribute_pairs[] = "{$key}='{$value}'";
    }
    $sql = "UPDATE ".static::$table_name." SET ";
    $sql .= join(", ", $attribute_pairs);
    $sql .= " WHERE id=". $database->escape_value($this->id);
    // debug....
    // if($database->query($sql)){
    // 	return $sql;
    // }else{
    // 	return $sql." fail";
    // }
    
    $database->query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
  }


  public function delete() {
    global $database;
    /**
     * [$sql description]
     * @var string
     * Don't forget your SQL syntax and good habits:
    - DELETE FROM table WHERE condition LIMIT 1
    - escape all values to prevent SQL injection
    - use LIMIT 1
     */
    $sql = "DELETE FROM ".static::$table_name;
    $sql .= " WHERE id=". $database->escape_value($this->id);
    $sql .= " LIMIT 1";
    // debug....
    // if($database->query($sql)){
    // 	return $sql;
    // }else{
    // 	return $sql." fail";
    // }
   
   	// tradicional
   	$database->query($sql);
    return ($database->affected_rows() == 1) ? true : false;
  /**
    NB: After deleting, the instance of User still exists, 
    even though the database entry does not.
   * 
   *  This can be useful, as in: 
   *  echo $user->first_name . " was deleted";
   *  but, for example, we can't call $user->update() 
   *  after calling $user->delete().
   *  
   */   
  }

} 