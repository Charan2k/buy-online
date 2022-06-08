<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>My Orders</title>
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
$sql = "SELECT * FROM orders where customer_id=$userid";
$result = mysqli_query($conn, $sql);
$i = 0;
$total_price =0;
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
      $store_address[$i] = $row["store_address"];
      $quantity[$i] = $row["quantity"];
      $item_name[$i] = $row["item_name"];
      $item_price[$i] = $row["item_price"];
      $store_name[$i] = $row["store_name"];
      $created_on[$i] = $row["created_on"];
      $i = $i + 1;
  }
} else {
  echo "0 results";
}

mysqli_close($conn);
?>
<br>
<div class="container col-sm-10 mt-5 pt-5 table-responsive">
            <table class="table table-borderless table-hover table-striped">
               <thead>
                  <tr class="text-info">
                     <th>SI.No</th>
                     <th>Item Name</th>
                     <th>Item Price</th>
                     <th>Quantity</th>
                     <th>Net Cost</th>
                     <th>Ordered On</th>
                     <th>Bought From</th>
                     <th>Store Address</th>
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
                     <td><?php echo $created_on[$i]; ?></td>
                     <td><?php echo $store_name[$i]; ?></td>
                     <td><?php echo $store_address[$i]; ?></td>
                  </tr>
                  <?php  } ?>
                  <tr>
                      <td colspan="8" class="text-center text-success">Total Amount Spent on Orders : £ <?php echo $total_price;?> </td>
                  </tr>
               </tbody>
            </table>
</div>
</body>
</html>