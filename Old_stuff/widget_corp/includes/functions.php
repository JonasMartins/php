<?php
	
	function redirect_to($new_location){
		header("Location: " . $new_location);
		exit;
	}

	function mysqli_prep($string){
		global $connection;

		$scaped_string = mysqli_real_escape_string($connection, $string);
		return $scaped_string;
	}

	function confirm_query($result){
		if(!$result){
			die("database connection faild.");

		}
	}

	function form_errors($errors=array()){
		$output = "";
		if(!empty($errors)){
			$output .= "<div class=\"error\">";
			$output .= "<Please fix the following errors:";
			$output .= "<ul>";
			foreach ($errors as $key => $error) {
				$output .= "<li>";
				$output .= htmlentities($error);
				$output .= "</li>";
			}
			$output .= "</ul>";
			$output .= "</div>";
		}
		return $output;
	}



	function find_pages_for_subject($subject_id){
		/* nice global, in right place */
		global $connection;

				/* Mais segurança */
		$safe_subject_id = mysqli_real_escape_string($connection, $subject_id);

		$query = "SELECT * ";
		$query .= "FROM pages ";
		$query .= "WHERE visible = 1 ";
		$query .= "AND subject_id = {$safe_subject_id} "; /* cuidado espaço.... */
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
	function find_selected_page(){
			global $current_page;
			global $current_subject;
			
			if (isset($_GET["subject"])) {
			$current_subject = find_subject_by_id($_GET["subject"]);
			$current_page = null;
			}elseif (isset($_GET["page"])){
				$current_page = find_page_by_id($_GET["page"]);
				$current_subject = null;
			}else{
				$current_page = null;
				$current_subject = null;  
			}
	}

	// esse array siginifica o objeto completo
	function navigation($subject_array,$page_array){
			/* Os dois argumentos de navigation são:
			o atual subject array selecionado e a 
			atual page array selecionada  */
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
				if($subject_array && $subject["id"]==$subject_array["id"]){
					$output_html .=  "class=\"selected\"";
					/*se os dois forem iguais aadiciona
					a marcação selected, do stylesheet */
				}
				$output_html .=  ">"; 
				$output_html .= "<a href=\"manage_content.php?subject=";
				$output_html .=  urlencode($subject["id"]);
				$output_html .= "\">";
				$output_html .=  htmlentities($subject["menu_name"]);
				$output_html .= "</a>";  

				/*	Pages  */
				$page_set = find_pages_for_subject($subject["id"]);
				$output_html .= "<ul class=\"pages\">";
				while($page = mysqli_fetch_assoc($page_set)){  
					$output_html .=  "<li";
					if($page_array && $page["id"]==$page_array["id"]){
						$output_html .=  "class=\"selected\"";
					}
					$output_html .=  ">"; 
					$output_html .= "<a href=\"manage_content.php?page=";
					$output_html .=  urlencode($page["id"]); 
					$output_html .= "\">";
					$output_html .=  htmlentities($page["menu_name"]);
					$output_html .= "</a>"; 
					$output_html .= "</li>"; 
				}
			mysqli_free_result($page_set);
				$output_html .= "</ul>";
				$output_html .= "</li>";
			} 
			mysqli_free_result($subject_set); 
				$output_html .= "</ul>";	
			return $output_html;	
			/* retornando todo o html em uma unica string para
			a pagina que requisitar essa função, uma forma
			de refatoração mais uma vez*/ 
	}

	function find_subject_by_id($subject_id){
		global $connection;

		/* Mais segurança */
		$safe_subject_id = mysqli_real_escape_string($connection, $subject_id);

		$query = "SELECT * ";
		$query .= "FROM subjects ";
		$query .= "WHERE id = {$safe_subject_id} ";
		$query .= "LIMIT 1";
		$result = mysqli_query($connection,$query);
		confirm_query($result); 
		// return the row, just one this time
		if ($subject = mysqli_fetch_assoc($result)){
		/* retorna false se não encontrar, 
			obviamente não fará diferença uma vez
			que esta informação vem de um link em uma
			página, ou seja totalmente seguro, mas
			seria esta uma boa prática
		*/
			return $subject;	 
		}else{
			return null;    
		}
	}
	function find_page_by_id($page_id){
		global $connection;

		/* Mais segurança */
		$safe_page_id = mysqli_real_escape_string($connection, $page_id);

		$query = "SELECT * ";
		$query .= "FROM pages ";
		$query .= "WHERE id = {$safe_page_id} ";
		$query .= "LIMIT 1";
		$result = mysqli_query($connection,$query);
		confirm_query($result); 
		if ($page = mysqli_fetch_assoc($result)){
				return $page;	
		}else{
			return null;    
		}
	}




?>