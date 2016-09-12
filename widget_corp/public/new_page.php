<?php	
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");
require_once("../includes/session.php");

include("../includes/layouts/header.php");
find_selected_page(); ?>

<?php
	// não podemos adicionar uma pagina temos que ter um
	// subject para ela
	if(!$current_subject){
		// subject id was missing or invalid
		// objeto não pôde ser encontrado no banco de dados
		redirect_to("manage_content.php");
	}
?>
<?php
	if(isset($_POST['submit'])){
		//validations 
		$required_fields = array("menu_name", "position", "visible","content");
		validate_presences($required_fields);
		$fields_with_max_lengths = array("menu_name" => 30);
		validate_max_lengths($fields_with_max_lengths);

		if(empty($errors)){
			// perform create
			$subject_id = $current_subject["id"];
			$menu_name = mysql_prep($_POST["menu_name"]);
			$position = $_POST["position"];
			$visible = $_POST["visible"];
			$content = mysql_prep($_POST["content"]);
		
			$query  = "INSERT INTO pages (";
			$query .= " subject_id, menu_name, position, visible, content)";
			$query .= " VALUES (";
			$query .= " {subject_id}, '{$menu_name}', {$position}, {$visible}, '{$content}'";
			$query .= ")";
			
			$result = mysqli_query($connection,$query);
			// result is a resource type, a new one
			if($result){
				//success, redirect_to... 
				$_SESSION["message"] = "Subject created.";
				redirect_to("manage_content.php?subject=" . urlencode($current_subject["id"]));
			}else{
				$message = "Page creation faild.";
			}
		}else{}
	}
?>


<div id="main">
	<div id="navigation">
		<?php echo navigation($current_subject,$current_page); ?>
		</div>
	<div id="page">
	<?php echo message(); ?>
	<?php echo form_errors($errors); ?>

	<h2>Create Page</h2>
	<form action="create_subject.php?subject=<?php echo 
	urlencode($current_subject["id"]); ?>" method="post">
		<p>Menu Name:
			<input type="text" name="menu_name" value=""/>
		</p>
		<p>Position:
			<select name="position">
				<?php
					$page_set = find_pages_for_subject($current_subject["id"]);
					$page_count = mysqli_num_rows($page_set);
					
					for($count=1;$count <= ($page_count+1);$count++){
						echo "<option value=\"{$count}\">{$count}</option>"; 
					}
				?>
			</select>
		</p>
		<p>Visible:
			<input type="radio" name="visible" value="0" />No &nbsp;
			<input type="radio" name="visible" value="1" /> Yes
		</p>
		<p>Content:<br />
			<textarea name="content" rows="20" cols="80"></textarea>
		</p>
			<input type="submit" name="submit" value="Create Page" />
		</form>
		<br />
		<a href="manage_content.php?=subject=<?php echo 
		urlencode($current_subject["id"]); ?> ">Cancel</a>
	</div> 
</div>	 
<?php include("../includes/layouts/footer.php"); ?>	