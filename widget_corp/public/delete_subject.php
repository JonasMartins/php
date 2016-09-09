<?php	
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");
require_once("../includes/session.php"); ?>

<?php find_selected_page(); ?>

<?php
	$current_subject = find_subject_by_id($_GET["subject"]);
	// id subject não foi encontrado
	// então é redirecionado para manage_content
	if(!$current_subject){
		retirect_to("manage_content.php");
	}

	// assegurar que deletar apenas subjects sem páginas
	// relacionadas
	$pages_set = find_pages_for_subject($current_subject["id"]);
	if(mysqli_num_rows($pages_set)>0){
		$_SESSION["message"] = "Can't delete subjects with pages.";
		redirect_to("manage_content.php?subject={$current_subject["id"]}");
	}

	$id = $current_subject["id"];
	$query = "DELETE FROM subjects WHERE id = {$id} LIMIT 1";
	$result = mysqli_query($connection,$query);
		// result is a resource type, a new one
		if($result && mysqli_affected_rows($connection)==1 ){
			//success, redirect_to... 
			$_SESSION["message"] = "Subject deleted successfully.";
			redirect_to("manage_content.php");
		}else{
			$_SESSION["message"] = "Subject deletion failed.";
			redirect_to("manage_content.php?subject={$id}");
		}

?>
