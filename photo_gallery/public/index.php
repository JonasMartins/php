<?php require_once("../includes/initialize.php"); ?>

<?php include_layout_template('header.php'); ?>

<?php


$user = User::find_by_id(1);
echo $user->full_name();

echo "<hr />";

// $user2 = new User();
// //$user2->id = 2;
// $user2->username = "usertest";
// $user2->password = "12345678";
// $user2->first_name = "User";
// $user2->last_name = "Test66";

// Working.....
// $user2 = User::find_by_id(4);
// $user2->first_name = "Updating1111...";
// $test = $user2->update();


// Working too....
// $user2 = User::find_by_id(4);
// $user2->delete();

$users = User::find_all();
foreach($users as $user) {
	 echo "Id: ". $user->id ."<br />";
   echo "User: ". $user->username ."<br />";
   echo "Name: ". $user->full_name() ."<br /><br />";
}



echo "<br />";
//print_r($test);
//$test = $user2->create();
//print_r($test);
//$user2->last_name = "Test99";
//echo $user2->id;
//$test = $user2->update();
echo "<br />";
//print_r($test);
	/**
	 * 	Test add some user example debug
	 * 	
 		*	global $database;
			$user2->id = $database->insert_id();
			$attributes = $user2->sanitized_attributes();
			$sql = "INSERT INTO "."users"." (";
			$sql .= join(", ", array_keys($attributes));
		  $sql .= ") VALUES ('";
			$sql .= join("', '", array_values($attributes));
			$sql .= "')";
			echo "<br />";
			
			if($result = $database->query($sql)) {
		 		 printf("Select returned %d rows.\n", $result->num_rows);
		 	}else{
		 		printf("Error: %s\n", mysqli_error());
		 	}	
			echo "<br />";
	 *
	 */
?>
<?php include_layout_template('footer.php'); ?>
