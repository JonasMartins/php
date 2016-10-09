<?php
require_once('../../includes/initialize.php');
// se is_logged_in reotrnar não true... então
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>
<?php include_layout_template('admin_header.php');?>
	<h2>Menu</h2>
	<!--Message from session-->
	<?php echo output_message($message); ?>
	<ul>
		<li><a href="logfile.php">View Log file</a></li>
		<li><a href="logout.php">Logout</a></li>
		<li><a href="photo_upload.php">Upload Photos</a></li>
		<li><a href="list_photos.php">List Photos</a></li>
		<li><a href="../index.php">Public Area</a></li>
	</ul>
<?php include_layout_template('admin_footer.php');?>		