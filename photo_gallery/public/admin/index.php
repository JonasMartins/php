<?php
require_once('../../includes/functions.php');
require_once('../../includes/session.php');
// se is_logged_in reotrnar não true... então
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>
<html>
  <head>
    <title>Photo Gallery</title>
    <link href="../stylesheets/main.css" media="all" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div id="header"> 
      <h1>Photo Gallery</h1>
    </div>
    <div id="main">
		<h2>Menu</h2>
		
		</div>
		<!-- Esse footer pode estar em outro arquivo.... -->
    <div id="footer">Copyright <?php echo date("Y", time()); ?>, Kevin Skoglund</div>
  </body>
</html>
