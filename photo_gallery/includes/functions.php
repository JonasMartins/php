 <?php

function strip_zeros_from_date( $marked_string="" ) {
  // first remove the marked zeros
  $no_zeros = str_replace('*0', '', $marked_string);
  // then remove any remaining marks
  $cleaned_string = str_replace('*', '', $no_zeros);
  return $cleaned_string;
}

function redirect_to( $location = NULL ) {
  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}

function output_message($message="") {
  if (!empty($message)) { 
    return "<p class=\"message\">{$message}</p>";
  } else {
    return "";
  }
}

  /*  Esse autoload, é chamado sempre que for necessário
  a adição de um objeto a ser usado, ou seja sem precisar
  escrever sempre o require_once, esta função carrega sempre
  as definições especificadas, é uma ótima estratégia para
  não ter sempre que colocar todos os headers no topo do arquivo.
  */
function __autoload($class_name) {
  $class_name = strtolower($class_name);
  $path = "../includes/{$class_name}.php";
  if(file_exists($path)) {
    require_once($path);
  } else {
    die("The file {$class_name}.php could not be found.");
  }
}

?>