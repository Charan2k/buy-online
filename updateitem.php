<!DOCTYPE html>
<html lang="en">
<head>
  <title>Updating Store</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  
  
</head>
<body>
<?php
session_start();

include 'dbconnect.php';

$id = $_POST["itemid"];
$name = $_POST["resetname"];
$price = $_POST["resetprice"];


// Check connection
if (!$conn) 
{
    die("Connection failed: " . mysqli_connect_error());
}
else 
 {
// update the users info using the sql query and data from post variables
    $i=0;
    $sql = "UPDATE store_items set item_name='$name',item_price='$price' where item_id=$id";

if (mysqli_query($conn, $sql)) {
  $update="Item updated successfully";
} else {
  $update="Error updating record: " . mysqli_error($conn);
}


    
 }
//  show the response in an modal form and redirect to the edit student info page
echo('
            <div class="modal fade" id="redirect" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
    
             <!-- Modal content-->
             <div class="modal-content">

             <div class="modal-body">
             <p>'.$update.'<br>You will be redirected in 2 seconds.</p>
             </div>

             </div>
      
            </div>
            </div>
            <script>
            $(document).ready(function(){
            $("#redirect").modal();
            });
            setTimeout(function(){window.location.href = "show_items.php"; }, 1800);
            </script>
            ');
    
mysqli_close($conn);

?>

</body>
</html>
