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
	/* Os dois argumentos de navigation são:
	o atual subject selecionado e a atual page
	selecionada  */
	function navigation($subject_id,$page_id){
	/*	
	<!-- Esses ids e classes se referem ao css,
			ou seja os estilo que foi definido para navigation, subjects e todos listados aqui
			serão aplicados nestes padrões, notar a grande
			diferença que faz ao se adotar o css como 
			design da página --> */
			$output_html = "<ul class=\"subjects\">";
			$subject_set = find_all_subjects();
			
	 		while($subject = mysqli_fetch_assoc($subject_set)){
				/* Abaixo da lista de subjects, queremos mostrar
				uma lista com todas as páginas
				*/	
				$output_html .= "<li";// concatenando tudo
				/* artificion feito para musar a classe
				selected vinda do stylesheet para que 
				o nome do objeto subject esteja em bold
				apenas se o mesmo estiver selecionado
				por isso o if dentro do php, dentro do
				li */
				if($subject["id"]==$subject_id){
					$output_html .=  "class=\"selected\"";
					/*se os dois forem iguais aadiciona
					a marcação selected, do stylesheet */
				}
				$output_html .=  ">"; 
				$output_html .= "<a href=\"manage_content.php?subject=";
				$output_html .=  urlencode($subject["id"]);
				$output_html .= "\">";
				$output_html .=  $subject["menu_name"];
				$output_html .= "</a>";  

				/*	Pages  */
				$page_set = find_pages_for_subject($subject["id"]);
				$output_html .= "<ul class=\"pages\">";
				while($page = mysqli_fetch_assoc($page_set)){  
					$output_html .=  "<li";
					if($page["id"]==$page_id){
						$output_html .=  "class=\"selected\"";
					}
					$output_html .=  ">"; 
					$output_html .= "<a href=\"manage_content.php?page=";
					$output_html .=  urlencode($page["id"]); 
					$output_html .= "\">";
					$output_html .=  $page["menu_name"];
					$output_html .= "</a>"; 
					$output_html .= "</li>"; 
				}
			mysqli_free_result($page_set);
			$output_html .= "</ul>";
			$output_html .= "</li>";
			} 
	mysqli_free_result($subject_set); 
		$output_html .= "</ul>";
	/* retornando todo o html em uma unica string para
	a pagina que requisitar essa função, uma forma
	de refatoração mais uma vez*/	
	return $output_html;	
	}
?>