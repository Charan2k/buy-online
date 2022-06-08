<?php
   session_start();
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Confirming Order</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
   </head>
   <?php
      // include 'nav.php';
      include 'dbconnect.php';
      // Check connection
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }
      $userid = $_SESSION['userid'];
      $sql = "SELECT * FROM cart inner join store_items on cart.item_id = store_items.item_id inner join store_info on store_items.store_id = store_info.store_id inner join lmsusers on cart.customer_id=lmsusers.id where customer_id=$userid";
      $result = mysqli_query($conn, $sql);
      $i = 0;
      $total_price =0;
      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            
            $quantity[$i] = $row["quantity"];
            $item_name[$i] = $row["item_name"];
            $item_price[$i] = $row["item_price"];
            $store_id[$i] = $row["store_id"];
            $store_name[$i] = $row["store_name"];
            $store_address[$i] = $row["store_address"];
            $customer_name[$i] = $row["name"];
            $customer_mail[$i] = $row["mail"];
            $i = $i + 1;
        }
      } else {
        echo "0 results";
      }
      
      for($i=0;$i<count($item_name);$i++)
      {
      $sql = "INSERT INTO orders (customer_id,store_id, item_name, item_price, quantity, store_name, store_address) VALUES ($userid,$store_id[$i], '$item_name[$i]',$item_price[$i],$quantity[$i],'$store_name[$i]','$store_address[$i]')";
      
      if (mysqli_query($conn, $sql)) {
        $result = "Order Placed successfully";
      } else {
        $result =  "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      }
      if($result == "Order Placed successfully"){
      $to = ''.$customer_mail[0];
      $subject = "Order Placed Successfully";
      $txt = "Dear $customer_name[0],\nYour Order has been placed successfully.\nYou can check your orders in My Orders page.\nThanks for Shopping with us,\nBuy Online";
      $headers = "From: admin@bo.tech";
      
      mail($to,$subject,$txt,$headers);
      
      $sql = "DELETE FROM cart WHERE customer_id=$userid";
      $result_cart = mysqli_query($conn, $sql);
      }
      mysqli_close($conn);
      ?>
   <br>
   <?php 
      // echo $result;
      echo('
                  <div class="modal fade" id="redirect" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
          
                   <!-- Modal content-->
                   <div class="modal-content">
      
                   <div class="modal-body">
                   <p>'.$result.'<br>You will be redirected to the Home page in few seconds.</p>
                   </div>
      
                   </div>
            
                  </div>
                  </div>
                  <script>
                  $(document).ready(function(){
                  $("#redirect").modal();
                  });
                  setTimeout(function(){window.location.href = "my_orders.php"; }, 1800);
                  </script>
                  ');
      ?>
   </body>
</html>