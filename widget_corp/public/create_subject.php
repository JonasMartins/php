<?php
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");
?>

<?php 
if(isset($_POST['submit'])){

	// se o botão de submeter um subject for acionado...
	
	$menu_name = mysqli_prep($_POST["menu_name"]);
	$position = (int) $_POST["position"];
	$visible = (int) $_POST["visible"];

	$query  = "INSERT INTO subjects (";
	$query .= " menu_name, position, visible)";
	$query .= " VALUES (";
	$query .= " '{$menu_name}', {$position}, {$visible}";
	$query .= ")";
	
	
	$result = mysqli_query($connection,$query);
	// result is a resource type, a new one
	if($result){
		//success, redirect_to... 
		$message = "Subject creation success.";
		redirect_to("manage_content.php");
	}else{
		$message = "Subject creation faild.";
		redirect_to("new_subject.php");
}else{

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
