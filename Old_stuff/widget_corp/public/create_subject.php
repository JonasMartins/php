<?php
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");
require_once("../includes/validation_functions.php");

?>

<?php 
if(isset($_POST['submit'])){

	// se o botão de submeter um subject for acionado...
	// tem um erro exatamente em mysqli_query....
	// esssa linha faz a aplicação quebrar....

	$menu_name = mysqli_prep($_POST["menu_name"]);
	$position = (int) $_POST["position"];
	$visible = (int) $_POST["visible"];

	// validations
	$required_fields = array("menu_name", "position", "visible");
	validate_presences($required_fields);

	$fields_with_max_lengths = array("menu_name" => 30);
	validate_max_lengths($fields_with_max_lengths);

	if(!empty($errors)){
		$_SESSION["errors"] = $errors;
		redirect_to("new_subject.php");
	}

	$query  = "INSERT INTO subjects (";
	$query .= " menu_name, position, visible)";
	$query .= " VALUES (";
	$query .= " '{$menu_name}', {$position}, {$visible}";
	$query .= ")";
	
	$result = mysqli_query($connection,$query);
	// result is a resource type, a new one
	if($result){
		//success, redirect_to... 
		$_SESSION["message"] = "Subject creation success.";
		redirect_to("manage_content.php");
	}else{
		$message = "Subject creation faild.";
		redirect_to("new_subject.php");
	}
}else{ // Faltava fechar uma chave por isso
			// o código não rodava, a análise de informações
		 // sem ver a saída do servidor causa isso...
	  // várias horas tentando descobrir isso, 
	 // próxima vez pesquisar pela saída so servidor.

	// Rails não teria acontecido isso!

	// Obs: Ligar o outputbuffer, rever aulas 
	// anteriores
	redirect_to("new_subject.php");
}

?>

	
<?php
 if (isset($connection)){
 	mysqli_close($connection);
 }
 ?>			
