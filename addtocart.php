<?php
   session_start();
   
   $item_id = $_GET["itemid"];
   $cus_id = $_SESSION["userid"];
   include 'dbconnect.php';
   
   // Check connection
   if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
   }
   
   $sql = "SELECT * FROM store_items where item_id=$item_id";
         $result = mysqli_query($conn, $sql);
         
         if (mysqli_num_rows($result) > 0) {
           // output data of each row
           while($row = mysqli_fetch_assoc($result)) {
             $item_name = $row["item_name"];
             $item_price = $row["item_price"];
             $item_img = $row["item_img"];
           }
         } else {
           echo "0 results";
         }
   
   $sql = "SELECT * FROM cart where customer_id=$cus_id and item_id=$item_id";
         $result = mysqli_query($conn, $sql);
         
         if (mysqli_num_rows($result) == 1) {
           // output data of each row
           while($row = mysqli_fetch_assoc($result)) {
             $quantity = $row["quantity"];
           }
           $quantity = $quantity + 1;
           $sql = "UPDATE cart SET quantity = $quantity where customer_id=$cus_id and item_id=$item_id";
   
   if (mysqli_query($conn, $sql)) {
     $result = "Cart updated Successfully";
   } else {
     $result = "Error updating record: " . mysqli_error($conn);
   }
         } else {
           $sql = "INSERT INTO cart (item_id, customer_id, quantity, item_price) VALUES ($item_id, $cus_id,1,$item_price)";
   
   if (mysqli_query($conn, $sql)) {
     $result = "Item Added into Cart Successfully";
   } else {
     $result = "Error: " . $sql . "<br>" . mysqli_error($conn);
   }
         }
         
   
   
   mysqli_close($conn);
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Adding to Cart</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
   </head>
   <body>
      <?php
         echo('
                     <div class="modal fade" id="redirect" role="dialog">
                     <div class="modal-dialog modal-dialog-centered">
             
                      <!-- Modal content-->
                      <div class="modal-content">
         
                      <div class="modal-body">
                      <p>'.$result.'<br>You will be redirected to the Cart page in few seconds.</p>
                      </div>
         
                      </div>
               
                     </div>
                     </div>
                     <script>
                     $(document).ready(function(){
                     $("#redirect").modal();
                     });
                     setTimeout(function(){window.location.href = "view_cart.php"; }, 1800);
                     </script>
                     ');
             
         
         
         ?>
   </body>
</html>