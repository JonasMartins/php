<?php require_once("../includes/initialize.php"); ?>
<?php
	// Find all photos
	$photos = Photograph::find_all();
?>
<?php include_layout_template('header.php'); ?>
<!-- 
	Forma antiga
<a class="btn btn-primary" href="./admin/index.php" role="button">Admin Login</a>
-->

<form action="./admin/index.php">
    <input type="submit" class="btn btn-primary btn-md sharp" value="Admin Login" />
</form>

<br />
<br />
<?php foreach($photos as $photo): ?>
  <div style="float: left; margin-left: 20px;">
		<a class="moldura" href="photo.php?id=<?php echo $photo->id; ?>">
			<img src="<?php echo $photo->image_path(); ?>" width="200"/>
		</a>
    <p><?php echo $photo->caption; ?></p>
  </div>
<?php endforeach;?>
<?php include_layout_template('footer.php'); ?>
