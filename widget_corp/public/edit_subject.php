<?php	
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");
require_once("../includes/session.php");
require_once("../includes/validation_functions.php");
find_selected_page(); ?>

<?php

	if(!$current_subject){
		retirect_to("manage_content.php");
	}
?>

<?php 
if(isset($_POST['submit'])){

	// se o botão de submeter um subject for acionado...
	// tem um erro exatamente em mysqli_query....
	// esssa linha faz a aplicação quebrar....

	$menu_name = mysqli_prep($_POST["menu_name"]);
	$position = (int) $_POST["position"];
	$visible = (int) $_POST["visible"];

	// validations
	$required_fields = array("menu_name", "position", "visible");
	validate_presences($required_fields);

	$fields_with_max_lengths = array("menu_name" => 30);
	validate_max_lengths($fields_with_max_lengths);

	if(empty($errors)){
		// faz a atualização	
		$id = $current_subject["id"];
		$query  = "UPDATE subjects SET";
		$query .= " menu_name = '{$menu_name}',";
		$query .= " position = {$position},";
		$query .= " visible = {$visible}";
		$query .= " WHERE id = {$id}";
		$query .= " LIMIT 1";
		
		$result = mysqli_query($connection,$query);
		// result is a resource type, a new one
		if($result && mysqli_affected_rows($connection) >= 0){
			//success, redirect_to... 
			$_SESSION["message"] = "Subject updated success.";
			redirect_to("manage_content.php");
		}else{
			$message = "Subject update faild.";
		}
	}
}else{ 
}

?>

<?php include("../includes/layouts/header.php");?>

<div id="main">
	<div id="navigation">
		<?php echo navigation($current_subject,$current_page); ?>
		</div>
	<div id="page">
	<?php if(!empty($message))
		echo "<div class=\"message\">" .htmlentities($message) . "</div>"; // message agora é apenas uma variável
	?>
	<?php echo form_errors($errors); ?>

	<h2>Edit Subject <?php echo htmlentities($current_subject["menu_name"]);  ?></h2>
	<form action="edit_subject.php?subject=<?php echo urlencode($current_subject["id"]);  ?>" method="post">
		<p>Menu Name:
			<input type="text" name="menu_name" value="<?php echo htmlentities($current_subject["menu_name"]);  ?>"/>
		</p>
		<p>Position:
			<select name="position">
				<?php
					$subject_set = find_all_subjects();
					/* O Numero de rows do retorno desta
					função vai nos dizer exatamente o número 
					de subjects que temos no banco, é uma forma
					não muito eficiente, uma vez que busca todos
					os objetos e os armazena, para só assim saber
					a quatidade ezata de subjects para fazer o
					loop */
					$subject_count = mysqli_num_rows($subject_set);

					for($count=1;$count <= ($subject_count  );$count++){
						echo "<option value=\"{$count}\"";
						if($current_subject["position"]==$count)
							echo " selected";
						echo ">{$count}</option>"; 
					}
				?>
			</select>
		</p>
		<p>Visible:
			 <input type="radio" name="visible" value="0" <?php
			// se está selecionado, então retorna para o html
			if($current_subject["visible"]==0)
				echo "checked";
			?>
			/>No &nbsp;
			<input type="radio" name="visible" value="1" <?php
			// se está selecionado, então retorna para o html
			if($current_subject["visible"]==1)
				echo "checked";
			?> /> Yes
		</p>
			<input type="submit" name="submit" value="Save" />
		</form>
		<br />
		<a href="manage_content.php">Cancel</a>&nbsp;
		&nbsp;
		<a href="delete_subject.php?subject=<?php  
		echo urlencode($current_subject["id"]); ?>" onclick="
		return confirm('Are you sure?');">Delete Subject </a>
	</div> 
</div>	 
<?php include("../includes/layouts/footer.php"); ?>	