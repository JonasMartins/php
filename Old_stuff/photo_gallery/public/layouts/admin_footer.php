    </div>
    <div id="footer">Copyright <?php echo date("Y", time()); ?>, Kevin Skoglund</div>
  </body>
  <script src="../javascripts/jquery-3.1.1.min.js"></script>
	<script src="../javascripts/bootstrap.min.js"></script>
	<script src="../javascripts/script.js"></script>
</html>
<?php if(isset($database)) { $database->close_connection(); } ?>