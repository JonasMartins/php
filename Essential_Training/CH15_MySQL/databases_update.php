<?php
	// create database connection
	
		$dbhost = "localhost";
		$dbuser = "jonas";
		$dbpass = "123456";
		$dbname = "widget_corp";
	
	$connection = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	// testing the connection
	// die means exit
	if(mysqli_errno()){
		die("database connection faild: " .
		mysqli_error() . "(" . mysqli_errno() .")" );
	}
?>
<?php

	$menu_name = "Edit me3";
	$position = 6;
	$visible = 0;
	$id = 6;

	$query  = "UPDATE subjects SET ";
	$query .= "menu_name = '{$menu_name}', ";
	$query .= "position = {$position}, ";
	$query .= "visible = {$visible} ";
	$query .= "WHERE id = {$id}";

	$result = mysqli_query($connection,$query);
	// result is a resource type, a new one
	// affected rows, testa se foi alterado o banco
	// não apenas se o resultado ocorreu com sucesso.
	if($result && mysqli_affected_rows($connection) == 1){
		//success, redirect_to...
		echo "Sucess!";
	}else{
		die("database connection faild. " . mysqli_error($connection));
	} 

?>
<!DOCTYPE html PUBLIC "~//W3C//DTD HTML 4.0.1 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
	<head>
	<title>Databases Update</title>
	</head>
	<body>



	</body>
</html>
<?php
	//close the connection
	mysqli_close($connection);

?>			

