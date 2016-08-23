<?php
	//how to redirect toa new page
	//this must be just like this, like this form
	function redirect_to($location){
		header("Location: " . $location);	
		exit; //exit após o redirecionamento
	}
	
	$logged = $_GET['logged_in'];
	if($logged_in == "1"){
		redirect_to("include.php");	
	} else {
		redirect_to("http://www.lynda.com");
	}

	//usando:
	//http://localhost/php/essential_training/web_pages/include.php?logged_in=1

	// esta é a forma de passar o valor para get

?>
<!DOCTYPE html PUBLIC "~//W3C//DTD HTML 4.0.1 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
	<head>
		<title>Redirect</title>
	</head>
	<body>
		<pre>
			<?php

		// Deve ser a primeir a coisa a aparecer no codigo
		// pois o header indica o que vem posteriormente
		// sem espaços antes do header

				 print_r(headers_list());
			?>
		</pre>
	</body>
</html>			