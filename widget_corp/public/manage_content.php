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
			<?php $subject_set = find_all_subjects(); ?>
			<?php
	 		while($subject = mysqli_fetch_assoc($subject_set)){
				/* Abaixo da lista de subjects, queremos mostrar
				uma lista com todas as páginas
				*/
				?>	
				<li>				
				<?php echo $subject["menu_name"]; ?>
					<?php	
							$page_set = find_pages_for_subject($subject["id"]);
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
	<?php mysqli_free_result($subject_set); ?>
		</ul>
		</div>
	<div id="page">
		<h2>Manage Content</h2>
	</div>
</div>	 
<?php include("../includes/layouts/footer.php"); ?>
<!-- Close connection foi movido para o   footer-->