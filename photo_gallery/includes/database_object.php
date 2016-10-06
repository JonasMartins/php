 <?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');

class DatabaseObject {


	// + Instruções : video 6-13 late static linding
  public static function test() {
        echo static::who(); // Here comes Late Static Bindings
        echo "<br />"."This Class table name: ".static::$table_name."<br />";
    }

	// se precisar do nome da classe apenas digitar:
	// $class_name = get_called_class();
	// assim podemos criar uma nova instancia
	// simplesmente digitando new $class_name 
	//*** Common Database Methods 

	public static function find_all() {
		return static::find_by_sql("SELECT * FROM ".static::$table_name);
  }
  
  public static function find_by_id($id=0) {
    // aqui adequamos a mudança feita 
    // para o retorno do objeto ao invés de um
    // array
    global $database;
    $result_array = static::find_by_sql("SELECT * FROM ".static::$table_name." WHERE id={$id} LIMIT 1");
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
  private static function instantiate($record){
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
   * @return [type] booelan [return an array of attributes
   *  keys and their values] [type] array
   *
   *  Fuñção refatorada  que usa apenas os campos
   *  usados pelo banco de dados para aquela classe
   *  específica.
   *
   *  Obs: Sempre lembrar de get_called_class()...
   */
  protected static function attributes(){
    
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
      if(property_exists(get_called_class(), $field)) {
        $attributes[$field] = get_called_class()->$field;
      }
    }
    return $attributes;

  }

  protected static function sanitized_attributes() {
    global $database;
    $clean_attributes = array();
    // sanitize the values before submitting
    // Note: does not alter the actual value of each attribute
    foreach(static::attributes() as $key => $value){
      $clean_attributes[$key] = $database->escape_value($value);
    }
    return $clean_attributes;
  }
  /**
   *  DockBlockr
   * 
   */
  private static function has_attribute($attribute){
    // get_object_vars retorna um array associado com todos
    // os atributos, incuindo os privados como keys e seus respectivos
    // valores como values
    $object_vars = static::attributes();  
    
    /**
     * Não á importancia com relação aos valores, apenas
     *  precisamos saber se eles de fato existem ou não, 
     *  retorna true or false
     */
    return array_key_exists($attribute, $object_vars);

  }

  // ****** Daqui para baixo o poder do static estava funcionando....
  // a quesão do get_id ainda é dúvida, pode dar erro


  /*  FAZENDO O USO DO STATIC DE FORMA ABSTRATA PARA TODAS AS
  CLASSES QUE EXTENDEREM DATABASE_OBJECT */

 private static function create() {
    global $database;
    // Don't forget your SQL syntax and good habits:
    // - INSERT INTO table (key, key) VALUES ('value', 'value')
    // - single-quotes around all values
    // - escape all values to prevent SQL injection
    $attributes = static::sanitized_attributes();
    $sql = "INSERT INTO ".static::$table_name." (";
    $sql .= join(", ", array_keys($attributes));
    $sql .= ") VALUES ('";
    $sql .= join("', '", array_values($attributes));
    $sql .= "')";
    if($database->query($sql)) {
      get_called_class()->set_id($database->insert_id());
      return true;
    } else {
      return false;
    }
  }

  private static function update() {
    global $database;
    
    /**
     * Don't forget your SQL syntax and good habits:
     * UPDATE table SET key='value', key='value' WHERE 
     * condition
     * single-quotes around all values
     *  - escape all values to prevent SQL injection
     */
    
    $attributes = static::sanitized_attributes();
    $attribute_pairs = array();
    foreach($attributes as $key => $value) {
      $attribute_pairs[] = "{$key}='{$value}'";
    }
    $sql = "UPDATE ".static::$table_name." SET ";
    $sql .= join(", ", $attribute_pairs);
    $sql .= " WHERE id=". $database->escape_value(get_called_class()->get_id());
    $database->query($sql);
    return ($database->affected_rows() == 1) ? true : false;
  }


  private static function delete() {
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
    $sql .= " WHERE id=". $database->escape_value(get_called_class()->get_id());
    $sql .= " LIMIT 1";
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