<?php	
/** Ao invés de ter o código da conexão, basta colocar 
	aqui usando o require_once
*/
require_once("../includes/db_connection.php");
 
/** Header, footer e functions, como aproveita-las
em outros arquivos  */
require_once("../includes/functions.php"); 
?>
<?php

	// perform database query
	$query = "SELECT * ";
	$query .= "FROM subjects ";
	$query .= "WHERE visible = 1 ";
	$query .= "ORDER BY position DESC";


	$query2 = "SELECT * ";
	$query2 .= "FROM subjects ";
	$query2 .= "WHERE visible = 0 ";
	$query2 .= "ORDER BY position ASC";


	$result = mysqli_query($connection,$query);
	$result2 = mysqli_query($connection,$query2);

	/** Usando uma função de functions.php */
	confirm_query($result);
	confirm_query($result);
	 
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
			while($subject = mysqli_fetch_assoc($result)){
				?>
				<li><?php echo $subject["menu_name"] . " (" . $subject["id"] . ")"; ?></li>
			<?php
				}
			?>
			</ul>	 
			<br />
			<ul class="subjects">
			<?php
			/* Tirar as informações invisíveis */
			echo "Invisibles: <br />";
			while($subject = mysqli_fetch_assoc($result2)){
				?>
				<li><?php echo $subject["menu_name"] . " (" . $subject["id"] . ")"; ?></li>
			<?php
				}
			?>	
			</ul>
	</div>
	<div id="page">
		<h2>Manage Content</h2>
	</div>
</div>	
<?php
	// liberando o reesultado
	mysqli_free_result($result);
?>
<?php include("../includes/layouts/footer.php"); ?>
<!-- Close connection foi movido para o footer-->