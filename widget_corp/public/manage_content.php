<?php	
/** Ao invés de ter o código da conexão, basta colocar 
	aqui usando o require_once
*/
require_once("../includes/db_connection.php");
 
/** Header, footer e functions, como aproveita-las
em outros arquivos  */
require_once("../includes/functions.php"); 
?>
<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_page(); ?>

<div id="main">
	<div id="navigation">
		<?php echo navigation($current_subject,$current_page); ?>
		<br />
		<a href="new_subject.php">+ Add a subject</a>
		</div>
	<div id="page">

		<?php
		/* Iniciando o CRUD */
			 if($current_subject){ ?>
			 	<h2>Manage Subject</h2>
			 	Menu name: <?php 
			 	/* retorna um array associado, no caso uma
				 tupla, uma vez que é um único subject */
			 	echo htmlentities($current_page["menu_name"]); ?><br />
				Postion: <?php echo $current_subject["position"]; ?><br />
				Visible: <?php echo $current_subject["visible"] == 1 ? 'yes':'no'; ?><br />				
				<br />
			 	<a href="edit_subject.php?subject=<?php
			 	/* passando o id do subject que eu quero editar*/
			 	echo urlencode($current_subject["id"]); ?>">Edit Subject</a> 
	<?php }elseif($current_page) { ?>
		<h2>Manage Page</h2>
			Menu name: <?php 
				//segurança da string dada para o html
			 	echo htmlentities($current_page["menu_name"]); ?><br />
			Postion: <?php echo $current_page["position"]; ?><br />
				Visible: <?php echo $current_page["Visible"] == 1 ? 'yes':'no'; ?><br />
			Content:<br />
			 	<div class="view-content">
			 	<?php echo htmlentities($current_page["content"]); ?>
			 	</div>
		<?php }else{ ?> 
			Please select a subject or a page.
		<?php } ?>	
	</div> 
</div>	 
<?php include("../includes/layouts/footer.php"); ?>
<!-- Close connection foi movido para o   footer-->