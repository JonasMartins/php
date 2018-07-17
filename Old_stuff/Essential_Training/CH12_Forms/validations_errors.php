<!DOCTYPE html PUBLIC "~//W3C//DTD HTML 4.0.1 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
	<head>
		<title>Validations Errors</title>
	</head>
	<body>
		<?php
			// *** Vaçidações
			// presence		

			$errors = array();

			$value = "";
			if (isset($value) || empty($value)){
				echo "Validations presence faild <br />";
				$errors['value'] = "Value can't br blank";
			}
			// string length
			if (strlen($value) < 5 || strlen($value) > 15){
				echo "Validations string length min/max faild <br />";
			}
			// type
			if (!is_string($value)){
				echo "Validations type faild <br />";
			}
			// included in a set
			$set = array(1,2,3);
			if (!in_array($value,$set)){
				echo "Validations included in a set faild <br />";
			}
			//$value = "#@$@#";
			//format
			if(!preg_match("/#/", $value)){
				echo "Validations format v1 failed <br />";
			}
			// === significa exato....
			if (strpos($value, "@") === false){
				echo "validarions format v2 failed <br />";
			}
			?>
		<?php
			function form_errors($errors=array()){
				$output="";
				if(!empty($errors)){
					$output = "<div class=\"error\">";
					$output .= "please fix the errors:";
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
		<?php 
		//call
		echo form_errors($errors); ?>

	</body>
</html>			

