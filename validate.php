<?php
// Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") 
{
$code=test_input($_GET["code"]);
$key=test_input($_GET["key"]);
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
     
    $sql = "SELECT mail from lmsusers where id= $key";
    $sqll = "Update lmsusers set isactivated=1 where id=$key";
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) > 0)
         {
            while($row = mysqli_fetch_assoc($result))
            {
            
            $value=hash("sha256",$row["mail"]);
            if ($value == $code)
            {
                 if (mysqli_query($conn, $sqll)) {
                    $_SESSION["notify"]= "Account activation successfull <img src='icons8-verified-account-24.png'><br>Welcome Aboard..";
                } else {
                   $_SESSION["notify"]="Error updating record: " . mysqli_error($conn);
                }
            }
            }
        }
        else
        {
            $_SESSION["notify"]="Invalid code";
        }
   }    
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Validation</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  
  
</head>
<body><?php
        if($_SESSION["notify"])
        {
         echo('
            <div class="modal fade" id="redirect" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
    
             <!-- Modal content-->
             <div class="modal-content">

             <div class="modal-body">
             <p>'. $_SESSION["notify"] .'<br>You will be redirected to the Home page in few seconds.</p>
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
             <p>Some Error Occurred.<br>You will be redirected to the Home page in few seconds.</p>
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
// remove all session variables
session_unset();

// destroy the session
session_destroy();

     
?>
</body>
</html>