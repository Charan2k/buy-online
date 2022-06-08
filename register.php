<?php
   // Start the session
   session_start();
   $runquery="yes";
   if ($_SERVER["REQUEST_METHOD"] == "POST") 
   {
   $name=test_input($_POST["username"]);
   $password=test_input($_POST["userpassword"]);
   $mail=test_input($_POST["signmail"]);
   $mobile=test_input($_POST["mobile"]);
   $gender=test_input($_POST["gender"]);
   $role=test_input($_POST["myrole"]);
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
       $hash=hash("sha256",$password);
       $code=hash("sha256",$mail);
       
       $sql = "INSERT into lmsusers (mail,password,mobile,name,gender,role,isactivated) values ('$mail','$hash',$mobile,'$name','$gender',$role,1)";
       $sqll = "select * from lmsusers";
       $result = mysqli_query($conn, $sqll);
       if(mysqli_num_rows($result) > 0)
        {
          while($row = mysqli_fetch_assoc($result))
           {
            if($mail==$row["mail"])
             {
               $_SESSION["notify"] = "Mail Id aready exits";
               $runquery=$_SESSION["notify"];
             }
           }
        }
       if($runquery=="yes")
        {
           if(mysqli_query($conn, $sql))
               {
                $_SESSION["notify"] = "Registration suceess.<br>You can Login Now.";
               }
               else{
               $_SESSION["notify"] = "Connection failed"; 
               }
           }
   }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Registration Page</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
   </head>
   <body><?php
//   echo $txt;
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
          <p>Error occurred.<br>You will be redirected to the Home page in few seconds.</p>
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
      
      
      ?></body>
</html>