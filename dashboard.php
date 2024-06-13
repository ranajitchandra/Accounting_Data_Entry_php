<?php
	session_start();
	if(isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 'root_admin' or isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 'general'){
    include "inc/top.php";
?>
  </head>
  <body>
    <div class="container-scroller">
      <!-- sidebar -->
      <?php
        include "inc/sidebar.php";
      ?>
      <!-- sidebar -->
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- navbar -->
        <?php
            include "inc/navbar.php";
        ?>
        <!-- navbar -->

        <!-- content-wrapper start -->
        <div class="main-panel">
          	<div class="content-wrapper">

				<div class="row">
					<div class="col-lg-6 col-md-6 grid-margin stretch-card">
						<div class="carousel-item active">
							<img class="d-block w-100" src="assets/images/2.jpg" alt="First slide">
						</div>
					</div>
					<div class="col-lg-6 col-md-6 grid-margin stretch-card">
						<div class="carousel-item active">
							<img class="d-block w-100" src="assets/images/1.jpg" alt="First slide">
						</div>
					</div>
					
				</div>
        	</div>
          <!-- content-wrapper ends -->

            <?php
                include "inc/footer.php";
            ?>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    
    <?php
        include "inc/bottom.php";
	}else{
		header("location: index.php");
	}	
    ?>