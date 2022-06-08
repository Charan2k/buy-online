<?php
session_start();
$user_id = $_SESSION["userid"];
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

$sql = "SELECT * FROM store_info where owner_id = $user_id";
$result = mysqli_query($conn, $sql);
$i=0;
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $id[$i]=$row["store_id"];
    $store_name[$i]=$row["store_name"];
    $store_address[$i]=$row["store_address"];
    $i++;
  }
} else {
  echo "0 results";
}
// close database connection
mysqli_close($conn);
?>
<br>
<!--student info is shown in table-->
<div class="container col-sm-10 col-md-6 mt-5 pt-5">
<div class="card mt-2">
  <div class="card-header text-center"><h4>Update Store Info</h4></div>
  <div class="card-body">
        <table class="table table-borderless table-responsive-sm table-hover">
    <thead>
      <tr>
        <th>No.</th>
        <th>Store Name</th>
        <th>Store Address</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php
      for($i=0;$i<count($store_name);$i++)
      {
      ?>
          <tr>
        <td><?php echo $i+1;?></td>
        <td><?php echo $store_name[$i];?></td>
        <td><?php echo $store_address[$i];?></td>
        <td><a href="edit_store.php?action=edit&id=<?php echo $id[$i];?>"><i class="fas fa-user-edit"></i></a></td>
        <td><a href="edit_store.php?action=remove&id=<?php echo $id[$i];?>"><i style="color:red;" class="fas fa-trash"></i></a></td>
      </tr> <?php
      }
      ?>
      </tbody>
      </table>
  </div>

</div>
</div>
</body>
</html>
