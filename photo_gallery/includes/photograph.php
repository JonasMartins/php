
<?php 
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');


	/**
		* 	AFTER READ DESCRIPTION IN CONFIG.PHP, TO HOW TO LOGIN
		* 	ON MYSQL TERMINAL:
		* 	
		* 	Photographs table 
		* 	
		* 	create table photographs (
		* 	id int(11) not null auto_increment primary key,
		* 	filename varchar(255) not null,
		* 	type varchar(100) not null,
		* 	size int(11) not null,
		* 	caption varchar(255) not null
		* 	);
		* 
		*
		*  This class must be able to upload images
		*  and work with her on oriented obejct way, 
		*  using the same methods from DatabaseObject since 
		*  we inherited from DatabaseObject.
		*  
		*/

class Photograph extends DatabaseObject {
	/**
	 * [$table_name description]
	 * @var string
	 * $table_name: a help when static method calls him, 
	 * to be more abstract as possible and help to decide 
	 * what table put in some sql queries. 
	 * 		
	 */	
	protected static $table_name="photographs";
	/**
	 * [$db_fields description]
	 * @var array 
	 * A helper when we want to "clean" the arguments that 
	 * we want over a specifc class, not all the attributes
	 * but only those who concern about our database
	 */
	protected static $db_fields=array('id', 'filename', 'type', 'size', 'caption');
	public $id;
	public $filename;
	public $type;
	public $size;
	public $caption;
 
 	private $temp_path;
  protected $upload_dir="images";

  // keep the upload errors in this array
  public $errors=array();
  
  protected $upload_errors = array(
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

	// Pass in $_FILE(['uploaded_file']) as an argument
  public function attach_file($file) {
		// Perform error checking on the form parameters
		if(!$file || empty($file) || !is_array($file)) {
		  // error: nothing uploaded or wrong argument usage
		  $this->errors[] = "No file was uploaded.";
		  return false;
		} elseif($file['error'] != 0) {
		  // error: report what PHP says went wrong
		  $this->errors[] = $this->upload_errors[$file['error']];
		  return false;
		} else {
			// Set object attributes to the form parameters.
		  $this->temp_path  = $file['tmp_name'];
		  $this->filename   = basename($file['name']);
		  $this->type       = $file['type'];
		  $this->size       = $file['size'];
			// Don't worry about saving anything to the database yet.
			return true;
		}
	}

/**
 * [save description]
 * @return [type] [description]
 *
 *  Aparentemente esse ḿétodo só é interessante
 *  para a classe photoghaph, todos os campos encontrados
 *  nela são referentes a essa classe
 *  Obs: sem nada a ser testado ainda, ainda haverá 
 *  o momento de debugar todos esses métodos e ver se
 *  o get_called_class() ou static estão funcionando
 *  corretamente.
 *
 *	Obs: remover todos esses returns no meio do metodo
 *	se possivel 
 * 
 */
	public function save() {
		// A new record won't have an id yet.
		if(isset($this->id)) {
			// Really just to update the caption
			$this->update();
		} else {
			// Make sure there are no errors
			// Can't save if there are pre-existing errors
		  if(!empty($this->errors)) { return false; }
			// Make sure the caption is not too long for the DB
		  if(strlen($this->caption) > 255) {
				$this->errors[] = "The caption can only be 255 characters long.";
				return false;
			}
		  // Can't save without filename and temp location
		  if(empty($this->filename) || empty($this->temp_path)) {
		    $this->errors[] = "The file location was not available.";
		    return false;
		  }
			// Determine the target_path
		  $target_path = SITE_ROOT .DS. 'public' .DS. $this->upload_dir .DS. $this->filename;
		  // Make sure a file doesn't already exist in the target location
		  if(file_exists($target_path)) {
		    $this->errors[] = "The file {$this->filename} already exists.";
		    return false;
		  }
			// Attempt to move the file 
			if(move_uploaded_file($this->temp_path, $target_path)) {
		  	// Success
				// Save a corresponding entry to the database
				if($this->create()) {
					// We are done with temp_path, the file isn't there anymore
					unset($this->temp_path);
					return true;
				}
			} else {
				// File was not moved.
		    $this->errors[] = "The file upload failed, possibly due to incorrect permissions on the upload folder.";
		    return false;
			}
		}
	}
	/**
	 * [image_path description]
	 * @return [type] [description]
	 *
	 * Para evitar que constantemente sendo mudado
	 * o diretório de imagens aqui, tenha que ser
	 * feito também na página html.
	 */
	public function image_path(){
		return $this->upload_dir.DS.$this->filename;
	}

	/**
	 * [size_as_text description]
	 * @return [type] [description]
	 *
	 * Uma forma mais eficiente de mostrar
	 * o tamanho da imagem, usando POO para
	 * sempre chamar esta função quando necessário.
	 */
	public function size_as_text() {
		if($this->size < 1024) {
			return "{$this->size} bytes";
		} elseif($this->size < 1048576) {
			$size_kb = round($this->size/1024);
			return "{$size_kb} KB";
		} else {
			$size_mb = round($this->size/1048576, 1);
			return "{$size_mb} MB";
		}
	}
}

 ?>
