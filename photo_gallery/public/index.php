<?php require_once("../includes/initialize.php"); ?>
<?php
	// Find all photos
	$photos = Photograph::find_all();
?>
<?php include_layout_template('header.php'); ?>
<!-- 
	Forma antiga
<a class="btn btn-primary" href="./admin/index.php" role="button">Admin Login</a>


Aqui será interessante usar o descendent
para evitar repetição de código
-->
<body>
<div class="container">
  <div class="row">	
  	<section >
			<h2 >Create an Account</h2>
			<div class="form-group">
			  <label for="usr">User Name:</label>
			  <input style="width: 300px;" type="text" class="form-control" id="usr">
			</div>
			<div class="form-group">
			  <label for="usr">First Name:</label>
			  <input style="width: 300px;" type="text" class="form-control" id="usr">
			</div>
			<div class="form-group">
			  <label for="usr">Last Name:</label>
			  <input style="width: 300px;" type="text" class="form-control" id="usr">
			</div>
			<div class="form-group">
			  <label for="pwd">Password:</label>
			  <input style="width: 300px;" type="password" class="form-control" id="pwd">
			</div>
			<form style="float: right" action="./admin/index.php">
	    	<input type="submit" class="btn btn-primary btn-md sharp" value="Admin Login" />
			</form>
			<form style="float: left" action="./admin/index.php">
    		<input style="width: 300px;" type="submit" class="btn btn-primary btn-md sharp" value=" Create " />
			</form>
		</section>
	</div> 
</div>

<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>

<?php include_layout_template('footer.php'); ?>


<!--

Parte anterior que ficava listando qulquer foto

<?php foreach($photos as $photo): ?>
  <div style="float: left; margin-left: 20px;">
		<a class="moldura" href="photo.php?id=<?php echo $photo->id; ?>">
			<img src="<?php echo $photo->image_path(); ?>" width="200"/>
		</a>
    <p><?php echo $photo->caption; ?></p>
  </div>
<?php endforeach;?>





Antigo logon dentro de uma tabela

<div class="container">
  <div class="row">	
  	<section class="col-lg-12">
	  	<form style="float: right" action="./admin/index.php">
	    	<input type="submit" class="btn btn-primary btn-md sharp" value="Admin Login" />
			</form>
		</section>
	</div>
  <div class="row">
    <section class="col-md-6">
    
     Adicionando styles a atbelas bootstrap
    hover dá um highlight na tupla

    table-condensed: deixa mais espremida as colunas
    table responsive põe um scroll nas tuplas ao 
    serem espremidas  
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
          <h2>Create an Account</h2>
          <tbody>
            <tr class="active">
              <th id="light_tan_th" scope="row">User Name</th>
              <td>
              <input type="text" name="user_name"/>
              </td>
            </tr>
            <tr class="active">
              <th id="light_tan_th" scope="row">First Name</th>
              <td>
              <input type="text" name="user_name" />
              </td>
            </tr>
            <tr class="active">
              <th id="light_tan_th" scope="row">Last Name</th>
              <td>
              <input type="text" name="user_name">
              </td>
             </tr>
            <tr class="active">
              <th id="light_tan_th" scope="row">Password</th>
              <td>
              <input type="text" name="user_name">
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
  </div> 
  <div class="row">	
  	<section class="col-lg-12 col-md-10">
  		<form style="float: left" action="./admin/index.php">
    		<input type="submit" class="btn btn-primary btn-md sharp" value=" Create " />
			</form> 
		</section>
	</div> 
</div>


-->

