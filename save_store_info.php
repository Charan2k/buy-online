<?php
   // Start the session
   session_start();
   $user_id = $_SESSION["userid"];
   $runquery="yes";
   if ($_SERVER["REQUEST_METHOD"] == "POST") 
   {
   $store_name=test_input($_POST["storename"]);
   $store_address=test_input($_POST["storeaddress"]);
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
       $sql = "INSERT into store_info (store_name,store_address,owner_id) values ('$store_name','$store_address',$user_id)";
           if(mysqli_query($conn, $sql))
               {
                $notify = "New Store with name $store_name has been created.";
           }
   }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Saving Store Info</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
   </head>
   <body><?php
//   echo $txt;
      if($notify)
      {
      echo('
          <div class="modal fade" id="redirect" role="dialog">
          <div class="modal-dialog modal-dialog-centered">
      
          <!-- Modal content-->
          <div class="modal-content">
      
          <div class="modal-body">
          <p>'. $notify.'<br>You will be redirected to the Dashboard page in few seconds.</p>
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
      else
      {
      echo('
          <div class="modal fade" id="redirect" role="dialog">
          <div class="modal-dialog modal-dialog-centered">
      
          <!-- Modal content-->
          <div class="modal-content">
      
          <div class="modal-body">
          <p>Error occurred.<br>You will be redirected to the Dashboard page in few seconds.</p>
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
      
      
      ?></body>
</html>