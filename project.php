<?php
	session_start();
	if(isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 'root_admin'){
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
					<div class="col-md-3 grid-margin stretch-card">
					</div>
					<div class="col-md-6 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Project Form</h4>
								<?php if(isset($_GET["page_data"])){echo "<span class='text-info'>".$_GET["page_data"]."</span>";}else{ echo "Create Project";} ?>
								<form action="controller/logic.php" method="POST" class="forms-sample">
									<div class="form-group row">
										<label for="exampleInputUsername2" class="col-sm-3 col-form-label">Project Name</label>
										<div class="col-sm-9">
										<input type="text" name="project_name" class="form-control" id="exampleInputUsername2" placeholder="Project Name" required>
										</div>
									</div>
									<div class="form-group row">
										<label for="exampleInputEmail2" class="col-sm-3 col-form-label">Address</label>
										<div class="col-sm-9">
										<input type="test" name="project_address" class="form-control" id="exampleInputEmail2" placeholder="Address" required>
										</div>
									</div>
									<div class="form-group row">
										<label for="exampleInputEmail2" class="col-sm-3 col-form-label"> Starting Date</label>
										<div class="col-sm-9">
										<input type="date" name="starting_date" class="form-control" id="exampleInputEmail2" placeholder="Date" required>
										</div>
									</div>
									<button type="submit" name="project_submit" class="btn btn-primary me-2">Submit</button>
								</form>
							</div>
						</div>
					</div>

					<div class="col-md-3 grid-margin stretch-card">
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