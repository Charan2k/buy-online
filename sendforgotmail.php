<?php

// Start the session
session_start();


$found="no";
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
$regmail=test_input($_POST["regmail"]);

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


include 'dbconnect.php';

// Check connection
if (!$conn) 
{
    die("Connection failed: " . mysqli_connect_error());
}
else 
{
    $sql = "select * from lmsusers";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0)
     {
       while($row = mysqli_fetch_assoc($result))
        {
         if($regmail==$row["mail"])
          {
              $key=$row["id"];
              $sql ="update lmsusers set resetpassword=1 where id=$key";
              if(mysqli_query($conn, $sql))
              $found="yes";
          }
        }
     }
}

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <title>Sending Forgot Mail</title>
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
if($found=="yes"){
$code=hash("sha256",$regmail);
$subject = "Reset Account Password";
$txt = " Use this link to reset your Account. - https://nagarseva.tech/buyonline/setpassword.php?code=$code&key=$key \n If it doesn't work copy and paste it in the url.\nThanks for choosing us,\nLabour Management System";
$headers = "From: admin@buyprojects.tech"; 
mail($regmail,$subject,$txt,$headers);
$response="Mail Id Found.<br>Password Reset link was sent to you Registered Mail Id.<br>You will be redirected to the Home page in few seconds.";
echo('
            <div class="modal fade" id="redirect" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
    
             <!-- Modal content-->
             <div class="modal-content">

             <div class="modal-body">
             <p>'.$response.'</p>
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
else if($found=="no"){
    $response="Mail Id isn't found in our Database.";
    echo('
            <div class="modal fade" id="redirect" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
    
             <!-- Modal content-->
             <div class="modal-content">

             <div class="modal-body">
             <p>'.$response.'</p>
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
else{
    $response="Some Error occured, Try after some time.";

         echo('
            <div class="modal fade" id="redirect" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
    
             <!-- Modal content-->
             <div class="modal-content">

             <div class="modal-body">
             <p>'.$response.'</p>
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
?>
</body>
</html>