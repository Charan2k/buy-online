<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
$mailid=test_input($_POST["mailid"]);
$newpass=test_input($_POST["newpass"]);
$resetpass=test_input($_POST["resetpass"]);

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

include 'dbconnect.php';


$newhash=hash("sha256",$newpass);

?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <title>Buy Projects</title>
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
       <?php include 'nav.php';?><br>

<?php

if (!$conn) 
{
    die("Connection failed: " . mysqli_connect_error());
}
else 
{
    $sqll = "Update lmsusers set password='$newhash' where mail='$mailid'";
    if (mysqli_query($conn, $sqll))
    {
        $sql = "Update lmsusers set resetpassword=0 where mail='$mailid'";
        if (mysqli_query($conn, $sql))
        echo('
            <div class="modal fade" id="redirect" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
    
             <!-- Modal content-->
             <div class="modal-content">

             <div class="modal-body">
             <p>Password changes Successfully.<br>You will be redirected to the Home page in few seconds.</p>
             </div>

             </div>
      
            </div>
            </div>
            <script>
            $(document).ready(function(){
            $("#redirect").modal();
            });
            setTimeout(function(){window.location.href = "index.php"; }, 2500);
            </script>
            ');
    }  
    else
    {
        echo('
            <div class="modal fade" id="redirect" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
    
             <!-- Modal content-->
             <div class="modal-content">

             <div class="modal-body">
             <p>Error occured.<br>You will be redirected to the Forgot Password page in few seconds.<br>Try Again later.</p>
             </div>

             </div>
      
            </div>
            </div>
            <script>
            $(document).ready(function(){
            $("#redirect").modal();
            });
            setTimeout(function(){window.location.href = "forgotpassword.php"; }, 2500);
            </script>
            ');
    }
} 
mysqli_close($conn);
?>
</body>
</html>