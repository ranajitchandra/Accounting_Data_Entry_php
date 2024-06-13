<?php
	session_start();
	if(isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 'root_admin'){
	include_once 'db/db.php';
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
								<h4 class="card-title">Materrial Form</h4>
								<?php if(isset($_GET["page_data"])){echo "<span class='text-info'>".$_GET["page_data"]."</span>";}else{ echo "<p class='card-description'>Create Metarial</p>";} ?>
								<form action="controller/logic.php" method="POST" class="forms-sample">
									<div class="form-group row">
										<label for="exampleInputUsername2" class="col-sm-3 col-form-label">Project Select</label>
										<div class="col-sm-9">
											<div class="form-group">
												<select name="project_id" class="form-control" id="exampleFormControlSelect1">
													<option>Project Select</option>
														<?php
															$view_project_sql = "SELECT * FROM project";
															$query = mysqli_query($conn, $view_project_sql);
															while($row = mysqli_fetch_assoc($query)){
														?>
													<option class="text-white" value="<?php echo $row["id"]; ?>"><?php echo $row["project_name"]; ?></option>
														<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label for="exampleInputUsername2" class="col-sm-3 col-form-label">Material name </label>
										<div class="col-sm-9">
										<input type="text" name="material_name" class="form-control" id="exampleInputUsername2" placeholder="Material Name" required>
										</div>
									</div>
									<div class="form-group row">
										<label for="exampleInputUsername2" class="col-sm-3 col-form-label">Material Type</label>
										<div class="col-sm-9">
										<input type="text" name="material_Type" class="form-control" id="exampleInputUsername2" placeholder="Material Type" required>
										</div>
									</div>
									<div class="form-group row">
										<label for="exampleInputUsername2" class="col-sm-3 col-form-label">About Material</label>
										<div class="col-sm-9">
										<input type="text" name="material_des" class="form-control" id="exampleInputUsername2" placeholder="Material Description" required>
										</div>
									</div>
									<div class="form-group row">
										<label for="exampleInputUsername2" class="col-sm-3 col-form-label">Amount</label>
										<div class="col-sm-9">
										<input type="text" name="material_amount" class="form-control" id="exampleInputUsername2" placeholder="Amount" required>
										</div>
									</div>
									<div class="form-group row">
										<label for="exampleInputUsername2" class="col-sm-3 col-form-label">purchase Date</label>
										<div class="col-sm-9">
										<input type="date" name="purchase_date" class="form-control" id="exampleInputUsername2" required>
										</div>
									</div>
									<button type="submit" name="material_submit" class="btn btn-primary me-2">Submit</button>
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