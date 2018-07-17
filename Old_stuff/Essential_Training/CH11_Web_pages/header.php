<?php
	header("HTTP 1.1/ 404 Not Found");
	header("X-Powered-By: SomeOne");
?>
<!DOCTYPE html PUBLIC "~//W3C//DTD HTML 4.0.1 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
	<head>
		<title>Headers</title>
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