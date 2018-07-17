<?php
	// constantes
	define("DB_SERVER","localhost");		
	define("DB_USER","jonas");		
	define("DB_PASS","123456");		
	define("DB_NAME","widget_corp");		

	$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	// testing the connection
	// die means exit
	if(mysqli_errno()){
			die("database connection faild: " .
			mysqli_error() . "(" . mysqli_errno() .")" );
		}
?>