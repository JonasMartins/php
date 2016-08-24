<?php
/**
	*** Vaçidações de funções
	assim posso adicinar várias funções aqui, no caso
	de validações e simplesmete adicionar em outro arquivo : require_once('validations_functions.php');
	e posso chamar estas funções direto do outro arquivo
	obviamente tomando cuidado com o path.
*/

function has_presence($value){
	return isset($value) && $value !== "";
}

function has_right_size($value){
	return strlen($value) < 5 || strlen($value) > 15;  
}	
?>

