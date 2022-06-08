<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>About Us Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
</head>

<?php

// To include navaigation bar
include 'nav.php';

?>
<!--container to hold all the cards-->
<div class="container mt-5 pt-5">
  <h2 class="mt-3 text-center">About the Project</h2>
  <br>
  <div class="card-columns">
    <div class="card bg-light">
      <div class="card-body text-center">
        <p class="card-text">This Project uses Html, Javascript, Php and Mysql.</p>
      </div>
    </div>
    <div class="card bg-info">
      <div class="card-body text-center">
        <p class="card-text text-white">Owner Dashboard is kept minimal for performing quick actions.</p>
      </div>
    </div>
    <div class="card bg-info">
      <div class="card-body text-center">
        <p class="card-text text-white">Usage of Html with Bootstrap4 gives website good look and feel.</p>
      </div>
    </div>
    <div class="card bg-light">
      <div class="card-body text-center">
        <p class="card-text">Adding Stores and Items can be done easily.</p>
      </div>
    </div>
    <div class="card bg-light">
      <div class="card-body text-center">
        <p class="card-text">Website is both Desktop and Mobile friendly,resize window to see the effect.</p>
      </div>
    </div>
    <div class="card bg-info">
      <div class="card-body text-center">
        <p class="card-text text-white">Delete,Edit for Stores & Items are emebedded in same page for Quick actions.</p>
      </div>
    </div>
  </div>
</div>
<!--another container to hold a row with two columns side by side with two images, desktop and mobile view images-->
<div class="container mt-4">
    <div class="row">
        <div class="col">
            <div class="card">
  <div class="card-header text-center"><b>Desktop View</b></div>
  <div class="card-body"><img class="img-fluid" src="Desktop.png" class="rounded" alt="Desktop View Screenshot"></div>
</div>
        </div>
        <div class="col">
            <div class="card">
  <div class="card-header text-center"><b>Mobile View</b></div>
  <div class="card-body text-center"><img class="img-fluid" src="Mobile.png" class="rounded" alt="Mobile View Screenshot"></div>

</div>
        </div>
    </div>
</div>
</body>
</html>