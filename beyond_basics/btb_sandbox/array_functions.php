<!DOCTYPE html>
<html>
<head>
	<title>Array Functions</title>
</head>
<body>
<?php
	
	$numbers = array(1,2,3,4,5,6);
	print_r($numbers);
	echo "<br /><br />";

	$a = array_shift($numbers);
	echo "a:" . $a ."<br />";    

	print_r($numbers);
	echo "<br /><br />";


	$b = array_unshift($numbers, 'first');
	echo "b: ". $b ."<br />";

	print_r($numbers);
	echo "<br /><br />";

	echo "<hr />";

	$a = array_pop($numbers);
	echo "a:" . $a ."<br />";    

	print_r($numbers);
	echo "<br /><br />";


	$b = array_push($numbers, 'last');
	echo "b: ". $b ."<br />";

	print_r($numbers);
	echo "<br /><br />";	

?>
</body>
</html>