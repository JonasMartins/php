<?php
	// enter mysql: 
	// >>mysql -u jonas -u phot_gallery

	// create table comments (
	//  -> id int(11) not null auto_increment primary key,
	//  -> photograph_id int(11) not null,
	//  -> created datetime not null,
	//  -> author varchar(255) not null,
	//  -> body text not null
	//  -> );
	//deixa a pesquisa mais rápida usando essa foreing key
	//  alter table comments add index (photograph_id);
?>
<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');
class Comment extends DatabaseObject {

	protected static $table_name="comments";
  protected static $db_fields=array('id', 'photograph_id', 'created', 'author', 'body');

  public $id;
  public $photograph_id;
  public $created;
  public $author;
  public $body;

  // "new" is a reserved word so we use "make" (or "build")
	/**
	 * [make description]
	 * @param  [type] $photo_id [description]
	 * @param  string $author   [description]
	 * @param  string $body     [description]
	 * @return [type]           [description]
	 *
	 * Like a factory to create new comments
	 * given the right necessary elements.
	 */
	public static function make($photo_id, $author="Anonymous", $body="") {
    if(!empty($photo_id) && !empty($author) && !empty($body)) {
			$comment = new Comment();
	    $comment->photograph_id = (int)$photo_id;
	    $comment->created = strftime("%Y-%m-%d %H:%M:%S", time());
	    $comment->author = $author;
	    $comment->body = $body;
	    return $comment;
		} else {
			return false;
		}
	}
	/**
	 * [find_comments_on description]
	 * @param  integer $photo_id [description]
	 * @return [type]            [description]
	 *
	 * Find the comments that belongs to that specific
	 * photo
	 */
	public static function find_comments_on($photo_id=0) {
    global $database;
    $sql = "SELECT * FROM " . self::$table_name;
    $sql .= " WHERE photograph_id=" .$database->escape_value($photo_id);
    $sql .= " ORDER BY created ASC";
    return self::find_by_sql($sql);
	}
}

?>