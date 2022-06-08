<?php
   session_start();
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Edit Store Info</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
   </head>
   <?php
//   include navigation bar and check whther user is admin or not
      include 'nav.php';
      include 'dbconnect.php';
      // Check connection
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }
      
      $id = $_GET["id"];
    //   get info of student whose id macthes with requested id
      $sql = "SELECT * FROM store_info where store_id=$id";
      $result = mysqli_query($conn, $sql);
      
      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          $store_name = $row["store_name"];
          $store_address = $row["store_address"];
        }
      } else {
        echo "0 results";
      }
      mysqli_close($conn);
    //   if action is edit give access to form to edit student records
      if($_GET["action"]=="edit")
      {
      ?>
      <br>
   <div class="container col-sm-8 mt-5 pt-5">
      <div class="card">
         <div class="card-header text-center">
            <h4 class="text-info">Update Store Information</h4>
         </div>
         <div class="card-body">
            <form action="updatestore.php" method="post">
               <div class="form-group">
                  <input type="text" class="form-control" id="storeid" name="storeid" value="<?php echo $id;?>" hidden >
               </div>
               <div class="form-group">
                  <label for="resetname">Name of the Store</label>
                  <input type="text" class="form-control" id="resetname" value="<?php echo $store_name;?>" required name="resetname">
               </div>
               <div class="form-group">
                  <label for="resetaddress">Address of the Store</label>
                  <input type="text" class="form-control" id="resetaddress" value="<?php echo $store_address;?>" required name="resetaddress">
               </div>
         </div>
         <div class="card-footer text-center">
         <input type="submit" class="btn btn-primary" value="Update">
         </form>
         </div>
      </div>
   </div>
   <?php
      }
    //   if action is remove then delete the student record from database directly using sql query
      else if($_GET["action"]=="remove")
      {
      include 'dbconnect.php';
      // Check connection
      if (!$conn) 
      {
          die("Connection failed: " . mysqli_connect_error());
      }
      else 
       {
      
          $i=0;
          $sql = "delete from store_info where store_id='$id'";
          $update = "Store Record Number $id was deleted";
      if (mysqli_query($conn, $sql)) {
        //   show the sql query response as modal and redirect to target page
          echo('
                  <div class="modal fade" id="redirect" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
          
                   <!-- Modal content-->
                   <div class="modal-content">
      
                   <div class="modal-body">
                   <p>'.$update.'<br>You will redirected to Home page in 2 seconds.</p>
                   </div>
      
                   </div>
            
                  </div>
                  </div>
                  <script>
                  $(document).ready(function(){
                  $("#redirect").modal();
                  });
                  setTimeout(function(){window.location.href = "show_stores.php"; }, 1800);
                  </script>
                  ');
          
      mysqli_close($conn);
      }
      }
      }
      
      ?>
   </body>
</html>