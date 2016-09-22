<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');

class User {

	// like database fields
  public $id;
  public $username;
  public $password;
  public $first_name;
  public $last_name;

  // Método estatico/instância
	public static function find_all() {
		return self::find_by_sql("SELECT * FROM users");
  }
  
  public static function find_by_id($id=0) {
    // aqui adequamos a mudança feita 
    // para o retorno do objeto ao invés de um
    // array
    global $database;
    $result_array = self::find_by_sql("SELECT * FROM users WHERE id={$id} LIMIT 1");
    /*
     se o array estiver vazio... retorna false
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
      $object_array[] = self::instantiate($row);
    }
    return $object_array;
  }


  public function full_name(){
    if(isset($this->first_name) && isset($this->last_name)){
      return $this->first_name . " " . $this->last_name;
    }else { return " "; }
  }

  // Forma de como o Objeto se construir, sem ter que ficar 
  // ordenando os valores do arrey e passando para os 
  // atributos do objeto
  private static function instantiate($record){
    // checar antes se record existe e se é de fato um array
    $object = new self;
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

  private function has_attribute($attribute){
    // get_object_vars retorna um array associado com todos
    // os atributos, incuindo os privados como keys e seus respectivos
    // valores como values
    $object_vars = get_object_vars($this);
    // Não á importancia com relação aos valores, apenas
    // precisamos saber se eles de fato existem ou não, retorna true or false
    return array_key_exists($attribute, $object_vars);

  }
  // Método authenticate usando na verificação de 
  // login de um usuário 
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

}

?>