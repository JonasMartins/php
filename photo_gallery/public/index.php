<?php require_once("../includes/initialize.php"); ?>

<?php include_layout_template('header.php'); ?>

<?php


$user = User::find_by_id(1);
echo $user->full_name();
$user->who();

//User::test();

echo "<hr />";

$users = User::find_all();
foreach($users as $user) {
   echo "User: ". $user->username ."<br />";
   echo "Name: ". $user->full_name() ."<br /><br />";
}

echo "<br />";

$array = User::attributes();
print_r($array);

/**
 *	funções a debugar: 
 *	
 * 	attributes : OK
 *
 * 
 */

?>
<?php include_layout_template('footer.php'); ?>
