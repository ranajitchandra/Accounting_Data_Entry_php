<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SOUTH11 Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="mycustom.css">


    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Register</h3>
				<?php
					session_start();
					include_once "db/db.php";
					
					if(isset($_POST["register"])){
						$name = $_POST["username"];
						$email = $_POST["email"];
						$password = $_POST["password"];
						$password = md5($password);
						if($name){
							$msg_sql = "SELECT * FROM user WHERE user_name = '$name';";
							$msg_query = mysqli_query($conn, $msg_sql);
							if(mysqli_num_rows($msg_query) > 0){
								$error_name = "User Name already taken <br>";
							} 
						}
						if($email){
							
							$msg_sql2 = "SELECT * FROM user WHERE email = '$email';";
							$msg_query2 = mysqli_query($conn, $msg_sql2);
							if(mysqli_num_rows($msg_query2) > 0){
								$error_email = "Email already taken";
							} 
						}
						$verify_sql ="SELECT * FROM user WHERE user_name = '$name' or email = '$email' or user_name = '$name' and email = '$email';";
						$verify_query = mysqli_query($conn, $verify_sql);
						$verify_count = mysqli_num_rows($verify_query);

						if($verify_count == 0){
							$insert = "INSERT INTO `user` (`user_name`, `email`, `password`) VALUES ('$name', '$email', '$password'); ";
							$query = mysqli_query($conn, $insert);
							if($query == true){
								header('Location: index.php?page_data='.$name.'');
							}else{
								echo "<h3>Something Wrong</h3>";
							}
						}
					}	
				?>
                <form action="signup.php" method="post">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control custom-input-color" Required>
						<?php if(isset($error_name)){ echo "<span style='color: red;'>".$error_name."</span>"; }  ?>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control p_input" Required>
						<?php if(isset($error_email)){ echo "<span style='color: red;'>".$error_email."</span>"; }  ?>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control p_input" Required>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="register" class="btn btn-primary btn-block enter-btn w-100">Sign Up</button>
                    </div>
                </form>
              </div>
            </div>  
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <!-- endinject -->
  </body>
</html>
