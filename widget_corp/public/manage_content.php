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
<?php
	if (isset($_GET["subject"])) {
		$selected_page_id = null;
		$selected_subject_id = $_GET["subject"];
	}elseif (isset($_GET["page"])){
		$selected_subject_id = null;
		$selected_page_id = $_GET["page"];
	}else{
		$selected_page_id = null;
		$selected_subject_id = null;
	}

?>
<div id="main">
	<div id="navigation">
		<?php echo navigation($selected_subject_id,$selected_page_id); ?>
		</div>
	<div id="page">

		<h2>Manage Content</h2>
		<?php
		/* Iniciando o CRUD */
			 if($selected_subject_id){ ?>

			 	<?php $current_subject = find_subject_by_id($selected_subject_id); ?>
			 	Menu name: <?php 
			 	/* retorna um array associado, no caso uma
				 tupla, uma vez que é um único subject */
			 	echo $current_subject["menu_name"]; ?><br />
	

	<?php }elseif($selected_page_id) { ?>
			<?php	echo $selected_page_id; ?>
		<?php }else{ ?> 
			Please select a subject or a page.
		<?php } ?>	
	</div> 
</div>	 
<?php include("../includes/layouts/footer.php"); ?>
<!-- Close connection foi movido para o   footer-->