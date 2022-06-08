<?php
   session_start();
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Dashboard Page</title>
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
   <div class="container mt-5 pt-5">
      <div class="card-columns">
         <div class="card bg-info">
            <div class="card-body text-center">
               <a href="create_store.php" class="card-link stretched-link text-white">Create a Store</a>
            </div>
         </div>
         <div class="card bg-info">
            <div class="card-body text-center">
               <a href="show_stores.php" class="card-link stretched-link text-white">Edit/Delete the Store Info</a>
            </div>
         </div>
         <div class="card bg-info">
            <div class="card-body text-center">
               <a href="add_items.php" class="card-link stretched-link text-white">Add Items to Store</a>
            </div>
         </div>
         <div class="card bg-info">
            <div class="card-body text-center">
               <a href="show_items.php" class="card-link stretched-link text-white">Edit/Delete the Products from Store</a>
            </div>
         </div>
         <div class="card bg-info">
            <div class="card-body text-center">
               <a href="store_orders.php" class="card-link stretched-link text-white">View Orders Received</a>
            </div>
         </div>
      </div>
   </div>
   <?php } 
      else if($_SESSION["role"]=="customer"){ ?>
   <br>
   <div class="container col-sm-10 mt-5 pt-5">
      <div class="container">
         <input class="form-control" id="myInput" type="search" placeholder="Search for Items using Store Name, Item Name, Item Price">
      </div>
      <div class="container mt-2 pt-2" id="product_cards">
         <div class="card-columns">
            <?php
               include 'dbconnect.php';
               // Check connection
               if (!$conn) {
                 die("Connection failed: " . mysqli_connect_error());
               }
               
               $sql = "SELECT * FROM store_items inner join store_info where store_items.store_id = store_info.store_id";
               $result = mysqli_query($conn, $sql);
               $i = 0;
               if (mysqli_num_rows($result) > 0) {
                 // output data of each row
                 while($row = mysqli_fetch_assoc($result)) {
                     $item_id[$i] = $row["item_id"];
                   $item_name[$i] = $row["item_name"];
                   $item_price[$i] = $row["item_price"];
                   $item_img[$i] = $row["item_img"];
                   $store_name[$i] = $row["store_name"];
                   $store_address[$i] = $row["store_address"];
                   $i = $i + 1;
                 }
               } else {
                 echo "0 results";
               }
               mysqli_close($conn);
               for($i=0;$i<count($item_name);$i++)
               {
               ?>
            <div class="card" style="width:280px">
               <img class="card-img-top" class="img-thumbnail" height="180" src="uploads/<?php echo $item_img[$i];?>" alt="<?php echo $item_name[$i];?> Image">
               <div class="card-body">
                  <h4 class="card-title"><?php echo $item_name[$i];?></h4>
                  <p class="card-text">
                     Price: £ <?php echo $item_price[$i];?><br>Store Name: <?php echo $store_name[$i];?><br>Store Address: <?php echo $store_address[$i];?>
                  </p>
                  <p class="text-center"><a href="addtocart.php?itemid=<?php echo $item_id[$i];?>" class="btn btn-success">Add to Cart</a></p>
               </div>
            </div>
            <?php
               }
               ?>
         </div>
      </div>
   </div>
   <script>
      $(document).ready(function(){
        $("#myInput").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#product_cards .card").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });
      });
   </script>
   <?php   
      }
      ?>
   </body>
</html>