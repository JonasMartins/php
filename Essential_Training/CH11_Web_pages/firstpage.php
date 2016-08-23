<html>
	<head>
		<title>First Page</title>
	</head>
	<body>
		<?php
			$linktext = "<Click> & you will see";
		?>
		<!-- Aqui a referencia  a página que ele 
		quer usar	
		o urlencode é um tipo de codificação -->
		<a href="secondpage.php?name=
		<?php echo urlencode("kevin "); ?>&id=42">Second Page</a>

		<!-- tipos de codificação html-->
		<?php echo htmlspecialchars($linktext); ?>

	</body>
</html>
