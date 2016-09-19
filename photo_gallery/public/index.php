<?php
require_once("../includes/database.php");
require_once("../includes/user.php");

/*
			--- Exemplo antigo.....

// teste simples de conexão
if(isset($database)) { echo "true"; } else { echo "false"; }
echo "<br />";


// objeto estatico vindo da classe database
echo $database->escape_value("It's working?<br />");

//---- Exemplo de consulta de um banco simples


 $sql  = "INSERT INTO users (id, username, password, first_name, last_name) ";
 $sql .= "VALUES (1, 'kskoglund', 'secretpwd', 'Kevin', 'Skoglund')";
 $result = $database->query($sql);


$sql = "SELECT * FROM users WHERE id = 1";
$result_set = $database->query($sql);
$found_user = $database->fetch_array($result_set);
echo $found_user['username'];

echo "<hr />";

*/

/*
	uma variável que recebe a saída de um método
	estático vindo de User, notar que da forma de instancia
	deveríamos fazer assim: 
	$User = new User();
	$found_user = $User->find_by_id(1);

	Questão de estático e instância já foi bastante demosntrada
	eis as suas diferenças.

*/
// record pois isto é um array...
$record = User::find_by_id(1);
//echo $record['username'];




// isso não é um array, mas um atributo de um objeto
// before fullname: echo $user->username;
// after full name:
echo $user->full_name();

echo "<hr />";




/*
$user_set = User::find_all();
while ($user = $database->fetch_array($user_set)) {
  echo "User: ". $user['username'] ."<br />";
  echo "Name: ". $user['first_name'] . " " . $user['last_name'] ."<br /><br />";
}*/

?>