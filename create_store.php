<?php
   session_start();
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Create Store</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
   </head>
   <?php
      include 'nav.php';
      if($_SESSION["role"]=="owner"){
      ?>
   <br>
   <div class="container col-sm-6 mx-auto mt-5 pt-5">
      <div class="card">
         <form action="save_store_info.php" method="POST">
            <div class="card-header">
               <h4 class="text-center text-info">Enter Store Info Here</h4>
            </div>
            <div class="card-body">
               <div class="form-group">
                  <label for="storename">Enter Store Name</label>
                  <div class="input-group mb-3">
                     <div class="input-group-prepend"> <span class="input-group-text"><i class="fas fa-home" aria-hidden="true"></i></span> </div>
                     <input name="storename" class="form-control" placeholder="Enter Store Name Here" type="text" id="storename" required> 
                  </div>
               </div>
               <div class="form-group">
                  <label for="storeaddress">Enter Store Address</label>
                  <div class="input-group mb-3">
                     <div class="input-group-prepend"> <span class="input-group-text"><i class="fas fa-map-signs" aria-hidden="true"></i></span> </div>
                     <input name="storeaddress" class="form-control" placeholder="Enter Store Address Here" type="text" id="storeaddress" required>
                  </div>
               </div>
            </div>
            <!-- Modal footer -->
            <div class="card-footer">
               <div class="text-center">
                  <button type="submit" class="btn btn-success">Save Store Info</button>
               </div>
            </div>
      </div>
      </form>
   </div>
   </div>
   <?php } 
      else {
          echo('
               <div class="modal fade" id="redirect" role="dialog">
               <div class="modal-dialog modal-dialog-centered">
       
                <!-- Modal content-->
                <div class="modal-content">
      
                <div class="modal-body">
                <p>You are not authorized to create a Store.<br>You will be redirected to the Home page in few seconds.<br>Try with User Account.</p>
                </div>
      
                </div>
         
               </div>
               </div>
               <script>
               $(document).ready(function(){
               $("#redirect").modal();
               });
               setTimeout(function(){window.location.href = "index.php"; }, 1800);
               </script>
               ');
      }
      ?>
   </body>
</html>