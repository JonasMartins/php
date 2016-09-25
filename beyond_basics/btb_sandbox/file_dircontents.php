<?php
// assim como fopen/fread/fclose:

// opendir(), readdir(), closedir()

$dir = ".";
if(is_dir($dir)){
	if($dir_handler = opendir($dir)){
		while($filename = readdir($dir_handler)){
			echo "filename: {$filename}<br />";
		}
		closedir($dir_handler);
	}
}
?>