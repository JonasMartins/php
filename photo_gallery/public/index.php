<?php require_once("../includes/initialize.php"); ?>

<?php include_layout_template('header.php'); ?>

<?php


$user = User::find_by_id(1);
echo $user->full_name();

echo "<hr />";

$user2 = new User();
//$user2->id = 2;
$user2->username = "usertest";
$user2->password = "12345678";
$user2->first_name = "User";
$user2->last_name = "Test";

$users = User::find_all();
foreach($users as $user) {
   echo "User: ". $user->username ."<br />";
   echo "Name: ". $user->full_name() ."<br /><br />";
}

echo "<br />";
		global $database;
		$user2->id = $database->insert_id();
		$attributes = $user2->sanitized_attributes();
		$sql = "INSERT INTO "."users"." (";
		$sql .= join(", ", array_keys($attributes));
	  $sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
	print_r($sql);	
	echo "<br />";
	


	if($result = $database->query($sql)) {

 		 printf("Select returned %d rows.\n", $result->num_rows);
 	}else{
 		printf("Error: %s\n", mysqli_error());
 	}	
	//   //   $this->id = $database->insert_id();
	//   //   return true;
	// //   } else {
	//   //   return false;
	//   // }
	// 	}else{ print_r($database->query($sql)); echo "<br />";}
	
	// echo "<br />";
	// //		print_r($sql);
	//	print_r($attributes);
	echo "<br />";
?>
<?php include_layout_template('footer.php'); ?>
