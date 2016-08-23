<!DOCTYPE html PUBLIC "~//W3C//DTD HTML 4.0.1 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
	<head>
		<title>Form_Processing</title>
	</head>
	<body>
		<pre>
			<?php
				// superglobal
				// este post é um array que pega todas 
				// as informações da outra form para esta
				print_r($_POST)

			?>	
		</pre>
		<?php
			$username = isset($_POST["username"]) ?$_POST["username"] : "";	
			$password = isset($_POST["password"]) ?$_POST["password"] : "";
		?>	
		<?php		
			echo "{username}: {password}";
		?>
	</body>
</html>			

