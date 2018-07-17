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
	// perform database query
	$query = "SELECT * ";
	$query .= "FROM subjects ";
	$query .= "WHERE visible = 1 ";
	$query .= "ORDER BY position DESC";


	$query2 = "SELECT * ";
	$query2 .= "FROM subjects ";
	$query2 .= "WHERE visible = 0 ";
	$query2 .= "ORDER BY position ASC";


	$result = mysqli_query($connection,$query);
	// result is a resource type, a new one
	if(!$result){
		die("database connection faild.");
	} 
	$result2 = mysqli_query($connection,$query2);
	// result is a resource type, a new one
	if(!$result2){
		die("database connection faild.");
	} 


?>
<!DOCTYPE html PUBLIC "~//W3C//DTD HTML 4.0.1 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
	<head>
	<title>Databases</title>
	</head>
	<body>
			<?php
			/*

			// enquanto puder retornar algum valor...
			while($row = mysqli_fetch_row($result)){
				var_dump($row);
				echo "<hr /> "; 
			}
 			// outra forma...
			while($row = mysqli_fetch_assoc($result)){
				var_dump($row);
				echo "<hr /> "; 
			}
 			*/
 			?>
			<ul>
			<?php
			echo "Visibles: <br />";
			while($subject = mysqli_fetch_assoc($result)){
				?>
				<li><?php echo $subject["menu_name"] . " (" . $subject["id"] . ")"; ?></li>
			<?php
				}
				/* // alternando entre php e html no meio do loop
				echo $row["id"] . "<br />";
				echo $row["position"] . "<br />";				
				echo $row["visible"] . "<br />";
				echo "<hr /> ";
				*/
			?>
			</ul>	 
			<br />
			<ul>
			<?php
			echo "Invisibles: <br />";
			while($subject = mysqli_fetch_assoc($result2)){
				?>
				<li><?php echo $subject["menu_name"] . " (" . $subject["id"] . ")"; ?></li>
			<?php
				}
			?>	
			</ul>	
		<?php
			// liberando o reesultado
			mysqli_free_result($result);
		?>
	</body>
</html>
<?php
	//close the connection
	mysqli_close($connection);

?>			

