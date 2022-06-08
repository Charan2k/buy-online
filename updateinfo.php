<?php
// Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $name=test_input($_POST["profilename"]);
    $mail=test_input($_POST["profilemail"]);
    $mobile=test_input($_POST["profilemobile"]);
    $id = $_SESSION["userid"];
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
    //  update the users info from the post variables got from profile page using sql query
    
     $sql = "UPDATE lmsusers set name='$name',mail='$mail',mobile='$mobile' where id=$id";
    if (mysqli_query($conn, $sql)) {
  $updated="yes";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  $updated="no";
}

mysqli_close($conn);
 }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    
  <title>Login Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  
  
</head>
<body><?php
// if update is success show response and redirect to the Profile page
    if($updated=="yes")
        {
         echo('
            <div class="modal fade" id="redirect" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
    
             <!-- Modal content-->
             <div class="modal-content">

             <div class="modal-body">
             <p>Profile Updated 😉 <br>You will be redirected to the Profile page in few seconds.</p>
             </div>

             </div>
      
            </div>
            </div>
            <script>
            $(document).ready(function(){
            $("#redirect").modal();
            });
            setTimeout(function(){window.location.href = "profile.php"; }, 2500);
            </script>
            ');
    
        }
        // if profile update fails redirect to profile page to try again
        else if($updated=="no")
        {
         echo('
            <div class="modal fade" id="redirect" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
    
             <!-- Modal content-->
             <div class="modal-content">

             <div class="modal-body">
             <p>Some Error occured 😢 <br>You will be redirected to the Profile page in few seconds. Try again :)</p>
             </div>

             </div>
      
            </div>
            </div>
            <script>
            $(document).ready(function(){
            $("#redirect").modal();
            });
            setTimeout(function(){window.location.href = "profile.php"; }, 2500);
            </script>
            ');
    
        } ?>
</body>
</html>