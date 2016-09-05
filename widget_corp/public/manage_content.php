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
		</div>
	<div id="page">

		<?php
		/* Iniciando o CRUD */
			 if($current_subject){ ?>
			 	<h2>Manage Subject</h2>
			 	Menu name: <?php 
			 	/* retorna um array associado, no caso uma
				 tupla, uma vez que é um único subject */
			 	echo $current_subject["menu_name"]; ?><br />
	

	<?php }elseif($current_page) { ?>
		<h2>Manage Page</h2>
			Menu name: <?php 
			 	echo $current_page["menu_name"]; ?><br />


		<?php }else{ ?> 
			Please select a subject or a page.
		<?php } ?>	
	</div> 
</div>	 
<?php include("../includes/layouts/footer.php"); ?>
<!-- Close connection foi movido para o   footer-->