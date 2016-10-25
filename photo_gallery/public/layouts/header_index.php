<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Photo Gallery</title>
    
    <link href="stylesheets/main.css" media="all" rel="stylesheet" type="text/css" />            

    <link href="stylesheets/bootstrap.min.css" media="all" rel="stylesheet" type="text/css">

  </head>
  <body>
    <div id="header">
    <div class="container">
      <div class="row">
        <h1 style="float:left; padding: 1em;">Photo Gallery</h1>
      
         <form class="form-inline" style="float:right;" action="../public/admin/index.php">
          <div class="form-group">
            <input class="btn btn-default btn-md sharp pull-right" type="submit" value="Sign In">
          </div>
        </form>



        <form class="form-inline" style="float:right;">
          <div class="form-group">
            <!-- class="sr-only"  caso queira
            esconder o User Name -->
            <label for="exampleInputEmail1">User Name</label>
            <input style="width: 150px;" type="login" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input style="width: 150px;" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
        </form>



        </div>
        
        

        <!--
        <div class="row">
          <form action="../public/admin/index.php">
            <div class="form-group">
            <input type="submit" class="btn/ btn-primary btn-md sharp" value="Sign in" />
            </div>
          </form>     
        </div>
        -->
      </div>
   </div>    
  <div id="main">
