<?php
   session_start();
   $userid = $_SESSION["userid"];
   include 'dbconnect.php';
   // Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM store_info where owner_id = $userid";
$result = mysqli_query($conn, $sql);
$i = 0;
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $store_id[$i] = $row["store_id"];
    $store_name[$i] = $row["store_name"];
    $i = $i + 1;
  }
} else {
  echo "0 results";
}

mysqli_close($conn);
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Add Items to Store</title>
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
   <div class="container col-sm-6 mx-auto mt-5 pt-5 mb-3 pb-3">
      <div class="card">
         <form action="save_item_info.php" method="POST" enctype="multipart/form-data">
            <div class="card-header">
               <h4 class="text-center text-info">Enter Items to Store</h4>
            </div>
            <div class="card-body">
               <div class="form-group">
                  <div class="form-group">
                     <label for="store_id">Select Store:</label>
                     <select class="form-control" id="store_id" name="store_id">
                         <option value=""> --- Select a Store --- </option>
                         <?php for($i=0;$i<count($store_name);$i++){ ?>
                        <option value="<?php echo $store_id[$i]; ?>"><?php echo $store_name[$i]; ?></option>
                        <?php } ?>
                     </select>
                  </div>
                  <label for="itemname">Enter Item Name</label>
                  <div class="input-group mb-3">
                     <div class="input-group-prepend"> <span class="input-group-text"><i class="fas fa-file-signature" aria-hidden="true"></i></span> </div>
                     <input name="itemname" class="form-control" placeholder="Enter Item Name Here" type="text" id="itemname" required> 
                  </div>
               </div>
               <div class="form-group">
                  <label for="itemprice">Enter Item Price</label>
                  <div class="input-group mb-3">
                     <div class="input-group-prepend"> <span class="input-group-text"><i class="fas fa-rupee-sign" aria-hidden="true"></i></span> </div>
                     <input name="itemprice" step=".01" class="form-control" placeholder="Enter Price in £" type="number" id="itemprice" required>
                  </div>
               </div>
               <div class="form-group custom-file mt-2 pt-2">
    <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload">
    <label class="custom-file-label" for="fileToUpload">Choose file</label>
  </div>
            </div>
            <!-- Modal footer -->
            <div class="card-footer">
               <div class="text-center">
                  <button type="submit" class="btn btn-success">Save Item Info</button>
               </div>
            </div>
      </div>
      </form>
   </div>
   </div>
   
<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

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
               setTimeout(function(){window.location.href = "dashboard.php"; }, 1800);
               </script>
               ');
      }
      ?>
   </body>
</html>