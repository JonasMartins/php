<?php
	function confirm_query($result){
		if(!$result){
			die("database connection faild.");

		}
	}
	function find_pages_for_subject($subject_id){
		/* nice global, in right place */
		global $connection;

		$query = "SELECT * ";
		$query .= "FROM pages ";
		$query .= "WHERE visible = 1 ";
		$query .= "AND subject_id = {$subject_id} "; /* cuidado espaço.... */
		$query .= "ORDER BY position ASC";
		$page_set = mysqli_query($connection,$query);
		confirm_query($page_set);
		return $page_set;
	}
	function find_all_subjects(){
		/* nice global, in right place */
		global $connection;

		/* Fazendo um loop para mostrar todas as informações dos subjects, no caso apenas uma tebela e não um objeto em sí, notar como
		for feito a quebra no meio do loop para listar
		de uma forma desejável as informações na página.
		*/	
		$query = "SELECT * ";
		$query .= "FROM subjects ";
		$query .= "WHERE visible = 1 ";
		$query .= "ORDER BY position ASC";
		$result = mysqli_query($connection,$query);
		confirm_query($result); 
		return $result;
	}

?>