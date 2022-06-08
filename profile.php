<?php
   session_start();
   $userid=$_SESSION["userid"];
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <title>Profile Page</title>
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
   </head>
   <body>
      <?php
         include 'dbconnect.php';

         if (!$conn) 
         {
             die("Connection failed: " . mysqli_connect_error());
         }
         else 
         {
            //  based on logged in user session info all profile related info is fecthed to show in form
             $sql ="select * from lmsusers where id=$userid";
             $result = mysqli_query($conn, $sql);
             if (mysqli_num_rows($result) == 1){
                 while($row = mysqli_fetch_assoc($result)) {
                     $name = $row["name"];
                     $mobile = $row["mobile"];
                     $mail = $row["mail"];
                     $gender = $row["gender"];
                 }
             }
         }
         
             include 'nav.php';
            ?>
      <br>
      
      <!--container to hold the profile info form--> 
      <!--based on user interaction with edit symbol this form can be edited using javascript functions-->
      
      <div class="container pt-5 mt-5 mb-5 mx-auto">
         <div class="card">
            <div class="card-body">
               <p class="text-center">
                  <a href="#!">
                  <img src="icons8user.png" class="rounded-circle border"  alt="profilepic" width="100px" height="100px" id="profilepic" class="card-title"></a>
               </p>
               <form action="updateinfo.php" method="post">
                  <div class="form-group">
                     <label for="profilename">Your Name</label>
                     <div class="input-group mb-3">
                        <div class="input-group-prepend"> <span class="input-group-text"><i class="fas fa-user" aria-hidden="true"></i></span> </div>
                        <input name="profilename" class="form-control" value="<?php echo $name;?>" type="text" id="profilename" readonly required>
                        <div class="input-group-append">
                           <button type="button" onclick="enable('name')" onfocus="this.value = this.value;" class="btn btn-primary" ><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="profilemail">Your Email Address</label>
                     <div class="input-group mb-3">
                        <div class="input-group-prepend"> <span class="input-group-text"><i class="fas fa-at" aria-hidden="true"></i></span> </div>
                        <input name="profilemail" class="form-control" value="<?php echo $mail;?>"placeholder="username@gmail.com" type="email" id="profilemail" readonly required> 
                        <div class="input-group-append">
                           <button type="button" onclick="enable('mail')" onfocus="this.value = this.value;" class="btn btn-primary" ><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="profilemobile">Your Mobile Number</label>
                     <div class="input-group mb-3">
                        <div class="input-group-prepend"> <span class="input-group-text"><i class="fas fa-mobile-alt" aria-hidden="true"></i></span> </div>
                        <input name="profilemobile" class="form-control" value="<?php echo $mobile;?>" placeholder="9999999999" pattern="[0-9]{10}" maxlength="10" type="tel" id="profilemobile" readonly required>
                        <div class="input-group-append">
                           <button type="button" onclick="enable('mobile')" class="btn btn-primary"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
                        </div>
                     </div>
                  </div>
                  <button type="submit" class="btn btn-success mr-2">Update</button>
               </form>
            </div>
         </div>
      </div>
      <?php 
         
         include 'footer.php';
         ?>
   </body>
</html>
<script>
// function to enable the input filed based on the user click on respective edit symbol on input field
   function enable(target)
   {
       if(target=="name")
       {
           document.getElementById("profilename").readOnly = false;
           document.getElementById("profilename").focus();
       }
       else if(target=="mobile")
       {
           document.getElementById("profilemobile").readOnly = false;
           document.getElementById("profilemobile").focus();
       }
       else if(target=="mail")
       {
           document.getElementById("profilemail").readOnly = false;
           document.getElementById("profilemail").focus();
       }
   }
   
//   javascript fcunction to place marker at end of the input field info
   
   $('#profilename').focus(function(){
   var that = this;
   setTimeout(function(){ that.selectionStart = that.selectionEnd = 10000; }, 0);
   });
   $('#profilemobile').focus(function(){
   var that = this;
   setTimeout(function(){ that.selectionStart = that.selectionEnd = 10000; }, 0);
   });
   $('#profilemail').focus(function(){
   var that = this;
  setTimeout(function(){ that.selectionStart = that.selectionEnd = 10000; }, 0);
   });
</script>