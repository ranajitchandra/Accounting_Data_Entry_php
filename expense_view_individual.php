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
					<div class="col-lg-9 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">
									<?php
										include_once 'db/db.php';

										// Delete Data
										if(isset($_GET["expense_delete_id"])){
											$get_expense_id = $_GET["expense_delete_id"];
											$delete_expense_row = "DELETE FROM costing WHERE id=$get_expense_id";
											$delete_expense_query = mysqli_query($conn, $delete_expense_row);
											if($delete_expense_query==true){
												echo "<script>window.location.replace('project_view.php?error=Expense Deleted Successfull');</script>";
											}else{
												echo "<script>window.location.replace('project_view.php?error=Someething Wrong');</script>";
											}
										}
										// expense edit Data Update
										if(isset($_POST["update_expense_submit"])){
											$update_vandor_sql ="UPDATE costing SET details='".$_POST['update_expense_details']."', costing_amount='".$_POST['update_expense_amount']."', costing_date='".$_POST['update_expense_date']."' WHERE id='".$_POST['update_vandor_id']."'";
											$update_vandor_query = mysqli_query($conn, $update_vandor_sql);
											if($update_vandor_query==true){
												
												echo "<script>window.location.replace('project_view.php?error=Expense Updated');</script>";
											}else{
												echo "What2";
												echo "<script>window.location.replace('project_view.php?error=Expense Not Updated');</script>";
											}
										}
										// Tile set
										if(isset($_GET["vandor_id"])){
											$page_data = $_GET["vandor_id"];
													
											$view_expense_sql = "SELECT project_name, vandor_name, SUM(costing_amount) AS single_amount FROM vandor INNER JOIN project ON project.id = vandor.project_id INNER JOIN costing ON vandor.id = costing.vandor_id WHERE costing.vandor_id = '$page_data';";
											$view_expense_query= mysqli_query($conn, $view_expense_sql);
											$row = mysqli_fetch_assoc($view_expense_query);
											if(mysqli_num_rows($view_expense_query)==0){
													
												echo "Please Input Data in This vandor";
											}else{
													
												echo $row["project_name"] ." > " .$row["vandor_name"];
											}
												
										}
									?>

								</h4>
							
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th> Deadline </th>
												<th> Details </th>
												<th> Amount </th>
												<th> Edit </th>
												<th> Delete </th>
											</tr>
										</thead>
										<tbody>
											<?php 
												include_once 'db/db.php';
												if(isset($_GET["expense_edit_id"])){

													$one_row_sql ="SELECT * FROM costing WHERE id='".$_GET["expense_edit_id"]."'";
													$one_row_query = mysqli_query($conn, $one_row_sql);
													$one_row_fetch = mysqli_fetch_assoc($one_row_query);

													echo "<div class='table-responsive'>
															<table class='table table-bordered'>
																<thead>
																	<tr>
																	<form action='expense_view_individual.php' method='POST'>
																	<input type='hidden' name='update_vandor_id' style='color:red;' value='".$one_row_fetch['id']."'>
																	<th><input type='text' class='form-control' name='update_expense_details' style='color:white;' value='".$one_row_fetch['details']."'></th>
																	<th><input type='text' class='form-control' name='update_expense_amount' style='color:white;' value='".$one_row_fetch['costing_amount']."'></th>
																	<th><input type='date' class='form-control' name='update_expense_date' style='color:white;'></th>
																	<th><input type='submit' class='form-control btn btn-dark' name='update_expense_submit' style='color:white;' value='Update'></th>
																	</form>
																	</tr>
																</thead>
															</table>
														</div>";
												}

												if(isset($_GET["vandor_id"])){
													$page_data = $_GET["vandor_id"];
												
												$view_expense_sql = "SELECT project_name, vandor_name, details, costing_amount, costing.id, DATE_FORMAT(costing.costing_date, '%d - %m - %Y') AS expense_date  FROM vandor INNER JOIN project ON project.id = vandor.project_id INNER JOIN costing ON vandor.id = costing.vandor_id WHERE vandor.id = '$page_data';";
												$view_expense_query= mysqli_query($conn, $view_expense_sql);
												if(mysqli_num_rows($view_expense_query)==false){
													echo "There is no Data of This vandor";
												}else{
												while($row = mysqli_fetch_assoc($view_expense_query)){
											?>
											<tr>
												<td style="color:#0094BC;"><?php echo $row["expense_date"]; ?></td>
												<td style="color:#0094BC;"> <?php echo $row["details"]; ?></td>
												<td style="color:#0094BC;"> <?php echo $row["costing_amount"] ."<i class='mdi mdi-currency-bdt'></i>";  ?></td>
												<td> <a class='text-decoration-none text-success' href="expense_view_individual.php?expense_edit_id=<?php echo $row['id']; ?>"> Edit </a> </td>
												<td><a href="javascript:void()" onClick="checkalert(<?php echo $row['id'];?>)" class='text-decoration-none text-danger'> Delete </a></td>
											</tr>
											<?php	}
												}
											}
											?>
											<script type="text/javascript">
												function checkalert(id){
													
													msg =confirm("Are you sure Delete the Data?");
													if(msg){
														document.location.href="expense_view_individual.php?expense_delete_id="+id;
													}
												}
											</script>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 grid-margin stretch-card">
					<div class="card">
							<div class="card-body">
								<h4 class="card-title">Expense</h4>
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th> Target </th>
												<th> Amounts </th>
											</tr>
										</thead>
										<tbody>
											<?php 
												if(isset($_GET["vandor_id"])){
													$page_data = $_GET["vandor_id"];
															
													$view_expense_sql = "SELECT project_name, vandor_name, SUM(costing_amount) AS single_amount FROM vandor INNER JOIN project ON project.id = vandor.project_id INNER JOIN costing ON vandor.id = costing.vandor_id WHERE costing.vandor_id = '$page_data';";
													$view_expense_query= mysqli_query($conn, $view_expense_sql);
													$row = mysqli_fetch_assoc($view_expense_query);														
												}
												
											?>	
											<tr>
												<td> <?php echo $row["vandor_name"]; ?> </td>
												<td> <?php echo $row["single_amount"] ."<i class='mdi mdi-currency-bdt'></i>"; ?></td>
											</tr>
											
										</tbody>
									</table>
								</div>
							</div>
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