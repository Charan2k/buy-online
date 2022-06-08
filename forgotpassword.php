<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <title>Forgot Password</title>
      <!-- Favicon-->
      <link rel="icon" type="image/png" href="icon.png">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <!-- Font Awesome icons (free version)-->
      <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
      <!-- Google fonts-->
      <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
      <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
      <!-- Third party plugin CSS-->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
      
      <!-- Core theme CSS (includes Bootstrap)-->
      <link href="css/styles.css?time=<?php echo time();?>" type="text/css" rel="stylesheet" />
   </head>
   <body>
       <?php include 'nav.php';?><br><br>
	<div class="container pt-5 mt-5 mb-5 pb-5">
		<div class="row pt-3 mt-3 mb-5">
			<div class="col-sm-8"><form action="sendforgotmail.php" method="post">
				<div class="form-group">
					<label for="regmail">Enter registered Email Id</label>
					<input type="email" class="form-control" id="regmail" name="regmail" required>
				</div>
				<button type="submit" id="submit" class="btn btn-success">Submit</button>
				</form>
			</div>
			<div class="col-sm-6">
			    
			</div>
		</div>
	</div>
	<?php include 'footer.php';?>
</body>
</html>