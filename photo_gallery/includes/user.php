<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once('database.php');

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
    global $database;
    $result_set = self::find_by_sql("SELECT * FROM users WHERE id={$id} LIMIT 1");
    
    // Notar que fatch_array na verdade é um simples 
    // array não um objeto
    $found = $database->fetch_array($result_set);
    return $found;
  }
  /* Recebe qualquer string em forma de função
    e já a executa  */
  public static function find_by_sql($sql="") {
    global $database;
    $result_set = $database->query($sql);
		return $result_set;
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
 
}

?>