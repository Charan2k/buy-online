<?php
session_start();
$userid = $_SESSION["userid"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Update Student Records</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
</head>

<?php
// to include navigation bar and database connection
include 'nav.php';
include 'dbconnect.php';
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$store_id = $_GET["storeid"];
$sql = "SELECT * FROM store_items inner join store_info on store_items.store_id = store_info.store_id where store_items.store_id=$store_id and owner_id = $userid";
$result = mysqli_query($conn, $sql);
$i=0;
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $item_id[$i]=$row["item_id"];
    $item_name[$i]=$row["item_name"];
    $item_price[$i]=$row["item_price"];
    $i++;
  }
} else {
  echo "0 results";
}
// close database connection
mysqli_close($conn);
?>
<table class="table table-borderless table-responsive-sm table-hover">
    <thead>
      <tr>
        <th>No.</th>
        <th>Item Name</th>
        <th>Item Price</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php
      for($i=0;$i<count($item_name);$i++)
      {
      ?>
          <tr>
        <td><?php echo $i+1;?></td>
        <td><?php echo $item_name[$i];?></td>
        <td>£ <?php echo $item_price[$i];?></td>
        <td><a href="edit_item.php?action=edit&item_id=<?php echo $item_id[$i];?>"><i class="fas fa-user-edit"></i></a></td>
        <td><a href="edit_item.php?action=remove&item_id=<?php echo $item_id[$i];?>"><i style="color:red;" class="fas fa-trash"></i></a></td>
      </tr> <?php
      }
      ?>
      </tbody>
      </table>
</body>
</html>
