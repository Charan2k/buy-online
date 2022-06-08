<?php
   // Start the session
   session_start();
   
   $target_dir = "uploads/";
   $target_file = $target_dir . $_POST["store_id"].  basename($_FILES["fileToUpload"]["name"]);
   $uploadOk = 1;
   $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   
   // Check if image file is a actual image or fake image
   if(isset($_POST["submit"])) {
   $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
   if($check !== false) {
    $err = "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
   } else {
    $err = "File is not an image.";
    $uploadOk = 0;
   }
   }
   
   // Check if file already exists
   if (file_exists($target_file)) {
   $err = "Sorry, file already exists.";
   $uploadOk = 0;
   }
   
   // Check file size
   if ($_FILES["fileToUpload"]["size"] > 5000000) {
   $err = "Sorry, your file is too large.";
   $uploadOk = 0;
   }
   
   // Allow certain file formats
   if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
   && $imageFileType != "gif" ) {
   $err = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
   $uploadOk = 0;
   }
   
   // Check if $uploadOk is set to 0 by an error
   if ($uploadOk == 0) {
   $err = "Sorry, your file was not uploaded.";
   // if everything is ok, try to upload file
   } else {
   if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $item_img = $_POST["store_id"].  basename($_FILES["fileToUpload"]["name"]);
   } else {
    $err = "Sorry, there was an error uploading your file.";
   }
   }
   
   $runquery="yes";
   if ($_SERVER["REQUEST_METHOD"] == "POST") 
   {
       $store_id=test_input($_POST["store_id"]);
   $itemname=test_input($_POST["itemname"]);
   $itemprice=test_input($_POST["itemprice"]);
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
       if($uploadOk == 1){
       $sql = "INSERT into store_items (store_id,item_name,item_price,item_img) values ($store_id,'$itemname',$itemprice,'$item_img')";
           if(mysqli_query($conn, $sql))
               {
                $notify = "New Item with name $itemname has been added to Store.";
               }
           }
   }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Saving Item Info</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
   </head>
   <body><?php
      //   echo $sql;
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
                  <p>Error occurred: '.$err.'<br>You will be redirected to the Dashboard page in few seconds.</p>
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