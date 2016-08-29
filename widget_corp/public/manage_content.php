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

<div id="main">
	<div id="navigation">
			<!-- Esses ids e classes se referem ao css,
			ou seja os estilo que foi definido para navigation, subjects e todos listados aqui
			serão aplicados nestes padrões, notar a grande
			diferença que faz ao se adotar o css como 
			design da página -->
			<ul class="subjects">
			<?php
			echo "Visibles: <br />";
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
		
	 		while($subject = mysqli_fetch_assoc($result)){
				/* Abaixo da lista de subjects, queremos mostrar
				uma lista com todas as páginas
				*/
				?>	
				<li>				
				<?php echo $subject["menu_name"]; ?>
					<?php	
						$query = "SELECT * ";
						$query .= "FROM pages ";
						$query .= "WHERE visible = 1 ";
						$query .= "AND subject_id = {$subject["id"]} "; /* cuidado espaço.... */
						$query .= "ORDER BY position ASC";
						$page_set = mysqli_query($connection,$query);
						confirm_query($page_set);	
					?>
					<ul class="pages">
					<?php
					while($page = mysqli_fetch_assoc($page_set)){
						?>	
						<li><?php echo $page["menu_name"]; ?></li>
					<?php 
						}
					 ?>
					<?php mysqli_free_result($page_set); ?>
					</ul>
				</li>
			<?php 
				} 
			?>
	<?php mysqli_free_result($result); ?>
		</ul>
		</div>
	<div id="page">
		<h2>Manage Content</h2>
	</div>
</div>	 
<?php include("../includes/layouts/footer.php"); ?>
<!-- Close connection foi movido para o footer-->