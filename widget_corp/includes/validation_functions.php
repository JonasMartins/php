<?php
/**
	*** Vaçidações de funções
	assim posso adicinar várias funções aqui, no caso
	de validações e simplesmete adicionar em outro arquivo : require_once('validations_functions.php');
	e posso chamar estas funções direto do outro arquivo
	obviamente tomando cuidado com o path.
*/
$errors = array();

function fieldname_as_text($fiedlname){
	// troca todos os _ por " " no fieldname
	$fieldname = str_replace("_"," ",$fieldname);
	// primeira letra maiúscula...
	$fieldname = ucfirst($fieldname);
	return $fieldname;

}

function has_presence($value){
	return isset($value) && $value == "";
}

function validate_presences($required_fields){
	global $errors;
	foreach ($required_fields as $field) {
		$value = trim($_POST[$field]);
		if(!has_presence($value)){
			$errors[$field] =  fieldname_as_text($field). " can't be blank";
		}
	}
}

function has_max_length($value, $max{
	return strlen($value) <= $max;  
}	

function validate_max_lengths($fields_with_max_lengths){
	global $errors;
	foreach ($fields_with_max_lengths as $field => $max) {
		$value = trim($_POST[$field]);
		if(!has_max_length($value, $max)){
			$errors[$field] =  fieldname_as_text($field). " is too long";
		}
	}
}

function has_inclusion_in($value, $set){
	return in_array($value, $set);
}

function form_errors($errors=array()){
	$output = "";
	if(!empty($errors)){
		$output .= "<div class=\"error\">";
		$output .= "<Please fix the following errors:";
		$output .= "<ul>";
		foreach ($errors as $key => $error) {
			$output .= "<li>{$error}</li>";
		}
		$output .= "</ul>";
		$output .= "</div>";
	}
	return $output;
}


?>

