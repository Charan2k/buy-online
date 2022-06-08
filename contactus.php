<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Contact Us Page</title>
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
// to include the common navigation bar
?>
<!--an container to hold the contact us cards-->
<br>
<div class="container col-sm-6 mt-5 pt-5">
    <br>
  <h4 class="text-center">For project related doubts and queries contact: </h4>
  <br>
  <div class="card bg-primary text-white">
    <div class="card-body">
        Ur Name Here<br><a class="text-white" href="tel:+91 9999999999">+91 9999999999</a>
    </div>
  </div>
</div>
</body>
</html>


