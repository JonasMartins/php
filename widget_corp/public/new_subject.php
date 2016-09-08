<?php	
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");
require_once("../includes/session.php");

include("../includes/layouts/header.php");
find_selected_page(); ?>

<div id="main">
	<div id="navigation">
		<?php echo navigation($current_subject,$current_page); ?>
		</div>
	<div id="page">
	<?php echo message(); ?>
	<?php $errors = errors(); ?>
	<?php echo form_errors($errors); ?>

	<h2>Create Subject</h2>
	<form action="create_subject.php" method="post">
		<p>Menu Name:
			<input type="text" name="menu_name" value=""/>
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

					for($count=1;$count <= ($subject_count+1);$count++){
						echo "<option value=\"{$count}\">{$count}</option>"; 
					}
				?>
			</select>
		</p>
		<p>Visible:
			<input type="radio" name="visible" value="0" />No &nbsp;
			<input type="radio" name="visible" value="1" /> Yes
		</p>
			<input type="submit" name="submit" value="Create Subject" />
		</form>
		<br />
		<a href="manage_content.php">Cancel</a>
	</div> 
</div>	 
<?php include("../includes/layouts/footer.php"); ?>	