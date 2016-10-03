<?php /**
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
 */

 ?>


<?php 
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');
/**
 *  This class must be able to upload images
 *  and work with her on oriented obejct way, 
 *  using the same methods from DatabaseObject since 
 *  we inherited from DatabaseObject.
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
 
}

 ?>
