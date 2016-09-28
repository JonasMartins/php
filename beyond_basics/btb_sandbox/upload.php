<?php

// In an application, this could be moved to a config file
$upload_errors = array(
	// http://www.php.net/manual/en/features.file-upload.errors.php
	UPLOAD_ERR_OK 				=> "No errors.",
	UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
  UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
  UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
  UPLOAD_ERR_NO_FILE 		=> "No file.",
  UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
  UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
  UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
);

echo "<pre>";
print_r($_FILES['userfile']); //finnaly working
echo "</pre>";
echo "<hr />";

// process the form data
$tmp_file = $_FILES['userfile']['tmp_name'];
$target_file = basename($_FILES['userfile']['name']);
$upload_dir = "uploads";


if(isset($_POST['submit'])) {
	if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
   echo "O arquivo ". $_FILES['userfile']['name'] ." foi enviado com sucesso. <br />";
   echo "Target file: {$target_file} <br />";
   echo "Mostrando o conteúdo <br />";
   readfile($_FILES['userfile']['tmp_name']);
} else {
   echo "Possível ataque de envio de arquivo: ";
   echo "nome do arquivo '". $_FILES['userfile']['tmp_name'] . "'.";
}

	
  
	// You will probably want to first use file_exists() to make sure
	// there isn't already a file by the same name.
	
	// move_uploaded_file will return false if $tmp_file is not a valid upload file 
	// or if it cannot be moved for any other reason
	// o arquivo a ser enviado e o diretorio onde deve estar
	// estes são os argumentos dessa função
	if(move_uploaded_file($tmp_file, $upload_dir."/".$target_file)) {
		$message = "File uploaded successfully.";
	} else {
		$error = $_FILES['userfile']['error'];
		$message = $upload_errors[$error];
	}
	
}
?>
<html>
	<head> 
		<title>Upload</title>
	</head>
	<body>
	<!-- forma de mandar arquivos enctype 
	significa que podem haver não apenas texto mas files 
	também
	-->
<?php
// The maximum file size (in bytes) must be declared before the file input field
// and can't be larger than the setting for upload_max_filesize in php.ini.
//
// This form value can be manipulated. You should still use it, but you rely 
// on upload_max_filesize as the absolute limit.
//
// Think of it as a polite declaration: "Hey PHP, here comes a file less than X..."
// PHP will stop and complain once X is exceeded.
// 
// 1 megabyte is actually 1,048,576 bytes.
// You can round it unless the precision matters.
?>
		<?php if(!empty($message)) { echo "<p>{$message}</p>"; } ?>
		<form enctype="multipart/form-data" action="upload.php" method="POST">
			 <!-- MAX_FILE_SIZE deve preceder o campo input -->
			<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
			 <!-- O Nome do elemento input determina o nome da array $_FILES -->
			<input name="userfile" type="file" />

			<input type="submit" name="submit" value="upload">
		</form>
	</body>
</html>