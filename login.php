<?php
// Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
$mail=test_input($_POST["usermail"]);
$pass=test_input($_POST["password"]);
$strpass="$pass";
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
     $hashpass=hash("sha256",$strpass);
     $sql = "SELECT * from lmsusers where mail='$mail' and password='$hashpass'";
            $result = mysqli_query($conn, $sql);
             if (mysqli_num_rows($result) == 1){
                  while($row = mysqli_fetch_assoc($result)) {
                      $isactive=$row["isactivated"];
                      $name=$row["name"];
                      if($isactive==1){
                      $_SESSION["islogin"]="yes";
                      $_SESSION["userid"]=$row["id"];
                      $_SESSION["role"]=$row["role"];
                      if($_SESSION["role"]==0)
                      $_SESSION["role"] = "owner";
                      else if($_SESSION["role"]==1)
                      $_SESSION["role"] = "customer";
                      }
                      else
                      $_SESSION["islogin"]="notactivated";
                  }
        }
        else
        {
            $_SESSION["islogin"] = "no";
        }
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
        if($_SESSION["islogin"]=="yes")
        {
         echo('
            <div class="modal fade" id="redirect" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
    
             <!-- Modal content-->
             <div class="modal-content">

             <div class="modal-body">
             <p>Login Success.<br>You will be redirected in few seconds.</p>
             </div>

             </div>
      
            </div>
            </div>
            <script>
            $(document).ready(function(){
            $("#redirect").modal();
            });
            setTimeout(function(){window.location.href = "dashboard.php"; }, 2500);
            </script>
            ');
    
        }
        else if($_SESSION["islogin"]=="no")
        {
         echo('
            <div class="modal fade" id="redirect" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
    
             <!-- Modal content-->
             <div class="modal-content">

             <div class="modal-body">
             <p>Invalid Credentials.<br>You will be redirected in few seconds, Try again :)</p>
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
        else if($_SESSION["islogin"]=="notactivated")
        {
         echo('
            <div class="modal fade" id="redirect" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
    
             <!-- Modal content-->
             <div class="modal-content">

             <div class="modal-body">
             <p>Account not activated yet.<br>Check your mail for activation link and activate first :)</p>
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
        
?>
</body>
</html>