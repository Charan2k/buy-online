<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>My Cart</title>
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
include 'dbconnect.php';
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$userid = $_SESSION['userid'];
$sql = "SELECT * FROM cart inner join store_items where cart.item_id = store_items.item_id and customer_id=$userid";
$result = mysqli_query($conn, $sql);
$i = 0;
$total_price =0;
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
      $cart_id[$i] = $row["cart_id"];
      $quantity[$i] = $row["quantity"];
      $item_name[$i] = $row["item_name"];
      $item_price[$i] = $row["item_price"];
      $store_id[$i] = $row["store_id"];
      $i = $i + 1;
  }
} else {
  echo "0 results";
}

mysqli_close($conn);
?>
<br>
<div class="container col-sm-6 mt-5 pt-5 table-responsive">
            <table class="table table-borderless table-hover table-striped">
               <thead>
                  <tr>
                     <th>SI.No</th>
                     <th>Item Name</th>
                     <th>Item Price</th>
                     <th>Quantity</th>
                     <th>Net Cost</th>
                  </tr>
               </thead>
               <tbody id="myTable">
                  <?php 
                     for($i=0;$i<count($item_name);$i++)
                     { ?>
                  <tr>
                     <td><?php echo $i+1; ?></td>
                     <td><?php echo $item_name[$i]; ?></td>
                     <td><?php echo $item_price[$i]; ?></td>
                     <td><?php echo $quantity[$i]; ?></td>
                     <?php $net_price[$i] = $quantity[$i]*$item_price[$i]; 
                     $total_price = $total_price + $net_price[$i];
                     ?>
                     <td>£ <?php echo $net_price[$i];?></td>
                  </tr>
                  <?php  } ?>
                  <tr>
                      <td colspan="5" class="text-center text-danger">Total Price: £ <?php echo $total_price;?> </td>
                  </tr>
               </tbody>
            </table>
            <div class="text-center">
                <a href="dashboard.php" class="btn btn-success" role="button">Add More Items</a>
                <a href="place_order.php" class="btn btn-success" role="button">Place Order</a>
            </div>
</div>
</body>
</html>