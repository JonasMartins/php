<?php require_once("../includes/initialize.php"); ?>
<?php
	// Find all photos
	$photos = Photograph::find_all();
?>
<?php include_layout_template('header.php'); ?>
<!-- 
	Forma antiga
<a class="btn btn-primary" href="./admin/index.php" role="button">Admin Login</a>
-->
<body>

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
    
    <!--
     Adicionando styles a atbelas bootstrap
    hover dá um highlight na tupla

    table-condensed: deixa mais espremida as colunas
    table responsive põe um scroll nas tuplas ao 
    serem espremidas  
    -->
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
          <h2>Create an Account</h2>
          <!--
          Espécie de cabeçalho da tabela
          <thead>
            <tr>
              <th id="light_tan_th">Create an Account</th>
              
            </tr>
          </thead> -->
          <tbody>
            <tr class="active">
              <th id="light_tan_th" scope="row">User Name</th>
              <td>Uma espécie de text field</td>
              <!--
              <td>Default</td>
              <td>Default color to a particular row or cell</td> -->
            </tr>
            <tr class="active">
              <th id="light_tan_th" scope="row">First Name</th>
              <td>Uma espécie de text field</td>
              <!--
              <td>Gray</td>
              <td>Active color to a particular row or cell</td> -->
            </tr>
            <tr class="active">
              <th id="light_tan_th" scope="row">Last Name</th>
              <td>Uma espécie de text field</td>
              <!-- 
              <td>Green</td>
              <td>A successful or positive action</td>
            	-->
            </tr>
            <tr class="active">
              <th id="light_tan_th" scope="row">Password</th>
              <td>Uma espécie de text field</td>
              <!--
              <td>Blue</td>
              <td>A neutral informative change or action</td>
            	-->
            </tr>
          </tbody>
        </table>
      </div>
    </section>
  </div><!-- row -->  
  <div class="row">	
  	<section class="col-lg-12 col-md-10">
  		<form style="float: left" action="./admin/index.php">
    		<input type="submit" class="btn btn-primary btn-md sharp" value=" Create " />
			</form> 
		</section>
	</div><!-- row --> 
</div><!-- content container -->


<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>


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
-->

<?php include_layout_template('footer.php'); ?>
