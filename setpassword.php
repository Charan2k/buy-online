<?php

// Start the session
session_start();


$code=$_GET["code"];
$key=$_GET["key"];

header('Expires: Sun, 01 Jan 2000 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

include 'dbconnect.php';

// Check connection
if (!$conn) 
{
    die("Connection failed: " . mysqli_connect_error());
}
else
{
    $sql="select * from lmsusers where id=$key";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
           $mail=$row["mail"];
           $resetpassword = $row["resetpassword"];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <title>Set Password</title>
      <!-- Favicon-->
      <link rel="icon" type="image/png" href="icon.png">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <!-- Font Awesome icons (free version)-->
      <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
      <!-- Google fonts-->
      <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
      <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
      <!-- Third party plugin CSS-->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
      
      <!-- Core theme CSS (includes Bootstrap)-->
      <link href="css/styles.css?time=<?php echo time();?>" type="text/css" rel="stylesheet" />
   </head>
   <body>
       <?php include 'nav.php';?><br>

<?php
if($resetpassword==1){
?>
<div class="container col-sm-6 pb-5 mb-5 mt-5 pt-5">
    
  <form action="newpassreset.php" method="post">
    
    <div class="form-group">
      <label for="mailid" class="d-inline">Registered Mail Id</label>
      <input type="text" class="form-control" id="mailid" name="mailid" value="<?php echo $mail;?>" readonly>
    </div>

    <div class="form-group">
      <label for="newpass" class="d-inline">Enter New Password</label>
      <input type="password" class="form-control" id="newpass" name="newpass" onkeyup="matching()" required>
    </div>
    
    <div class="form-group">
      <label for="reenternewpass" class="d-inline">Re-Enter New Password</label>  <img src="https://img.icons8.com/color/24/000000/verified-account.png" class="invisible" id="greenicon">
      <input type="password" class="form-control" id="resetpass" name="resetpass"  onkeyup="matching()" required>
    </div>
    
    <button type="submit" id="submit" class="border btn btn-secondary" disabled>Submit</button>
    
  </form>
  
</div>

</body>
<script>
    function matching()
    {
        var x = document.getElementById("newpass").value;
        var y = document.getElementById("resetpass").value;
        var z = document.getElementById("greenicon");
        var submit = document.getElementById("submit");
        if(x==y)
        {
            document.getElementById("greenicon").className = "visible";
            document.getElementById("submit").disabled=false;
            document.getElementById("submit").className = "btn btn-primary";
        } 
        else
        {
            document.getElementById("greenicon").className = "invisible";
            document.getElementById("submit").disabled=true;
            document.getElementById("submit").className = "btn btn-secondary";
        }
    }
</script>
<?php
}
else
{
    echo('
            <div class="modal fade" id="redirect" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
    
             <!-- Modal content-->
             <div class="modal-content">

             <div class="modal-body">
             <p>This link already expired.<br>Get a new link at Forgotpassword page.<br>You will be redirected to the Forgot Password page in few seconds.</p>
             </div>

             </div>
      
            </div>
            </div>
            <script>
            $(document).ready(function(){
            $("#redirect").modal();
            });
            setTimeout(function(){window.location.href = "forgotpassword.php"; }, 2500);
            </script>
            ');
}
include 'footer.php';
?>
</body>
</html>
