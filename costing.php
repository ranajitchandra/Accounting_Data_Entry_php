<?php
	session_start();
	if(isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 'root_admin'){
	include_once "db/db.php";
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
								<h4 class="card-title">Expense Form</h4>
								<p class="card-description"><?php if(isset($_GET["page_data"])){ echo "<span class='text-info'>Expense 	Inserted</span>";}else{ echo "Create Expense";} ?></p>
								<form action="controller/logic.php" method="POST" class="forms-sample">
									<div class="form-group row">
										<label for="exampleInputUsername2" class="col-sm-3 col-form-label">Details </label>
										<div class="col-sm-9">
										<input type="text" name="details" class="form-control" id="exampleInputUsername2" placeholder="Details" required>
										</div>
									</div>
									<div class="form-group row">
										<label for="exampleInputUsername2" class="col-sm-3 col-form-label">Project Select</label>
										<div class="col-sm-9">
											<div class="form-group">
												<select class="form-control"  id="selectID">
													<option>Select Option</option>
													<?php
														
														$sql = "SELECT * FROM project";
														$result = mysqli_query($conn,$sql);
														while($row = mysqli_fetch_assoc($result)) {?>
														<option value="<?php echo $row['id'] ?>"><?php echo $row['project_name'] ?></option>
													<?php }?>
										
												</select>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label for="exampleInputUsername2" class="col-sm-3 col-form-label">Vandor Select</label>
										<div class="col-sm-9">
											<select  class="form-control"  name="vandor_id" id="show"></select>
										</div>
									</div>
									<script>
											$(document).ready(function(){
												$('#selectID').change(function(){
												var Stdid = $('#selectID').val(); 
											
												$.ajax({
													type: 'POST',
													url: 'fetch.php',
													data: {id:Stdid},  
													success: function(data)  
													{
														$('#show').html(data);
													}
													});
												});
											});
										</script>

									<div class="form-group row">
										<label for="exampleInputUsername2" class="col-sm-3 col-form-label">Amount </label>
										<div class="col-sm-9">
										<input type="text" name="costing_amount" class="form-control" id="exampleInputUsername2" placeholder="Amount" required>
										</div>
									</div>
									<div class="form-group row">
										<label for="exampleInputEmail2" class="col-sm-3 col-form-label">Date</label>
										<div class="col-sm-9">
										<input type="date" name="costing_date" class="form-control" id="exampleInputEmail2" placeholder="Date" required>
										</div>
									</div>
									<button type="submit" name="costing_submit" class="btn btn-primary me-2">Submit</button>
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