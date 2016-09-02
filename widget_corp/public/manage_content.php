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
				<?php 
				echo "<li";
				/* artificion feito para musar a classe
				selected vinda do stylesheet para que 
				o nome do objeto subject esteja em bold
				apenas se o mesmo estiver selecionado
				por isso o if dentro do php, dentro do
				li */
				if($subject["id"]==$selected_subject_id){
					echo "class=\"selected\"";
					/*se os dois forem iguais aadiciona
					a marcação selected, do stylesheet */
				}
				echo ">"; 
				?>			
				<a href="manage_content.php?subject=<?php
				echo urlencode($subject["id"]); ?>"><?php echo $subject["menu_name"]; ?></a>  
					<?php	
							$page_set = find_pages_for_subject($subject["id"]);
					?>
					<ul class="pages">
					<?php
					while($page = mysqli_fetch_assoc($page_set)){
						?>	
							<?php 
							echo "<li";
							if($page["id"]==$selected_page_id){
								echo "class=\"selected\"";
							}
							echo ">"; 
						?>
						<a href="manage_content.php?page=<?php
				echo urlencode($page["id"]); ?>"><?php echo $page["menu_name"]; ?></a> 
						</li>
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
		<?php echo $selected_subject_id; ?><br />
		<?php echo $selected_page_id; ?>

	</div> 
</div>	 
<?php include("../includes/layouts/footer.php"); ?>
<!-- Close connection foi movido para o   footer-->