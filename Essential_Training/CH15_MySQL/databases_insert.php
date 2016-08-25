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

	$menu_name = "Edit me";
	$position = 4;
	$visible = 1;

	$query  = "INSERT INTO subjects (";
	$query .= " menu_name, position, visible)";
	$query .= " VALUES (";
	$query .= " '{$menu_name}', {$position}, {$visible}";
	$query .= ")";



	$result = mysqli_query($connection,$query);
	// result is a resource type, a new one
	if($result){
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
	<title>Databases Insert</title>
	</head>
	<body>



	</body>
</html>
<?php
	//close the connection
	mysqli_close($connection);

?>			

