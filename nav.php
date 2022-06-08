
<body id="page-top">
      <!-- Navigation-->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top py-3" id="mainNav1">
         <div class="container">
            <a class="navbar-brand" href="index.php"><h4>Buy Online</h4></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
               <ul class="navbar-nav ml-auto my-2 my-lg-0">
                  <?php
                  if (!$_SESSION["islogin"] or $_SESSION["islogin"] == "no" or $_SESSION["islogin"] == "notactivated")
                  {
                  ?>
                  <li class="nav-item"><a class="nav-link " href="#!" data-backdrop="static" data-toggle="modal" data-target="#loginmodal">Login</a></li>
                  <li class="nav-item"><a class="nav-link " href="#!" data-backdrop="static" data-toggle="modal" data-target="#registermodal">Register</a></li>
                  <?php
                  }
                  else if ($_SESSION["islogin"] == "yes" and $_SESSION["role"]=="owner")
                  {
                ?>
                <li class="nav-item"><a class="nav-link " href="dashboard.php">Dashboard</a></li>
               <li class="nav-item dropdown pr-4">
                  <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                  <img src="icons8user.png" width="30px" height="30px" id="navbarprofile"  class="avatar rounded-circle z-depth-0" alt="Default">
                  </a>
                  <div class="dropdown-menu">
                      <a class="dropdown-item" href="profile.php">Profile</a>
                      <a class="dropdown-item" href="logout.php">Logout</a> </div>
               </li>
               <?php
                  }
                  else if ($_SESSION["islogin"] == "yes" and $_SESSION["role"]=="customer")
                  {
                ?>
                <li class="nav-item"><a class="nav-link " href="dashboard.php">Search</a></li>
               <li class="nav-item dropdown pr-4">
                  <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                  <img src="icons8user.png" width="30px" height="30px" id="navbarprofile"  class="avatar rounded-circle z-depth-0" alt="Default">
                  </a>
                  <div class="dropdown-menu">
                      <a class="dropdown-item" href="view_cart.php">My Cart</a>
                      <a class="dropdown-item" href="my_orders.php">My Orders</a>
                      <a class="dropdown-item" href="profile.php">Profile</a>
                      <a class="dropdown-item" href="logout.php">Logout</a> </div>
               </li>
               <?php
                  }
                  ?>
                  <li class="nav-item"><a class="nav-link" href="aboutus.php">About us</a></li>
                  <li class="nav-item"><a class="nav-link " href="contactus.php">Contact us</a></li>
               </ul>
            </div>
         </div>
      </nav>
      <!-- The Modal -->
      <div class="modal fade" id="loginmodal">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <!-- Modal Header -->
               <div class="modal-header">
                  <h4 class="modal-title">Login Form</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <!-- Modal body -->
               <div class="modal-body">
                  <form action="login.php" method="post">
                     <div class="form-group">
                        <label for="usermail">Enter Email Address</label>
                        <div class="input-group mb-3">
                           <div class="input-group-prepend"> <span class="input-group-text"><i class="fas fa-at" aria-hidden="true"></i></span> </div>
                           <input name="usermail" class="form-control" placeholder="username@gmail.com" type="email" id="usermail" required> 
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="password">Enter Password</label>
                        <div class="input-group mb-3">
                           <div class="input-group-prepend"> <span class="input-group-text"><i class="fas fa-key" aria-hidden="true"></i></span> </div>
                           <input name="password" class="form-control" type="password" id="password" required> 
                        </div>
                     </div>
                     <!--<button type="submit" class="btn btn-success mr-2">Login</button>-->
                     <!--<a href="forgotpassword.php">Forgot Password ?</a> -->
                  
               </div>
               <!-- Modal footer -->
               <div class="modal-footer">
                  <div class="mr-auto">
                     <!--<script async src="https://telegram.org/js/telegram-widget.js?11" data-telegram-login="buyprojects_bot" data-size="large" data-auth-url="http://www.buyprojects.tech/telegram.php" data-request-access="write"></script>-->
                     <button type="submit" class="btn btn-success mr-2">Login</button>
                     <!--<a href="forgotpassword.php">Forgot Password ?</a> -->
                  </div>
               </div>
               </form>
            </div>
         </div>
      </div>
      <!-- The Modal -->
      <div class="modal fade" id="registermodal">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <!-- Modal Header -->
               <div class="modal-header">
                  <h4 class="modal-title">Registration Form</h4>
                  <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
               </div>
               <!-- Modal body -->
               <div class="modal-body">
                  <form action="register.php" method="post">
                     
                     <div class="form-group">
                        <label for="signmail">Enter Email Address</label>
                        <div class="input-group mb-3">
                           <div class="input-group-prepend"> <span class="input-group-text"><i class="fas fa-at" aria-hidden="true"></i></span> </div>
                           <input name="signmail" class="form-control" placeholder="username@gmail.com" type="email" id="signmail" required> 
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="username">Enter Name</label>
                        <div class="input-group mb-3">
                           <div class="input-group-prepend"> <span class="input-group-text"><i class="fas fa-user" aria-hidden="true"></i></span> </div>
                           <input name="username" class="form-control" type="text" id="username" required> 
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="mobile">Enter Mobile Number</label>
                        <div class="input-group mb-3">
                           <div class="input-group-prepend"> <span class="input-group-text"><i class="fas fa-mobile-alt" aria-hidden="true"></i></span> </div>
                           <input name="mobile" class="form-control" placeholder="9999999999" pattern="[0-9]{10}" maxlength="10" type="tel" id="mobile" required> 
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="gender">I Identify My Gender As</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value=""> ---- </option>
                           <option value="male">Male</option>
                           <option value="female">Female</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="myrole">I am a</label>
                        <select class="form-control" id="myrole" name="myrole" required>
                            <option value=""> ---- </option>
                           <option value="0">Shop Seller</option>
                           <option value="1">Customer</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="userpassword">Enter Password</label>
                        <div class="input-group mb-3">
                           <div class="input-group-prepend"> <span class="input-group-text"><i class="fas fa-key" aria-hidden="true"></i></span> </div>
                           <input name="userpassword" class="form-control" type="password" id="userpassword" required> 
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="repassword">Re-Enter Password</label> <img src="icons8-verified-account-24.png" alt="match icon" class="d-inline invisible" id="matchicon">
                        <div class="input-group mb-3">
                           <div class="input-group-prepend"> <span class="input-group-text"><i class="fas fa-key" aria-hidden="true"></i></span> </div>
                           <input name="repassword" class="form-control" type="password" id="repassword" onkeyup="matching()" required> 
                        </div>
                     </div>
                     <button type="submit" class="btn btn-success">Register</button>
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
      <!-- Script for register password match -->
      <script>
    function matching()
    {
        var x = document.getElementById("userpassword").value;
        var y = document.getElementById("repassword").value;
        var z = document.getElementById("matchicon");
        if(x==y)
        {
            z.className = "visible";
        } 
        else
        {
            z.className = "invisible";
            
        }
    }

       
   </script>