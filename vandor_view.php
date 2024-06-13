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
					<div class="col-lg-8 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">
									<?php
										include_once 'db/db.php';
										// title 
										if(isset($_GET["project_id"])){
											$page_data = $_GET["project_id"];
											$view_expense_sql = "SELECT * FROM project INNER JOIN vandor ON project.id = vandor.project_id WHERE vandor.project_id = '$page_data';";
											$view_expense_query= mysqli_query($conn, $view_expense_sql);
											$count = mysqli_num_rows($view_expense_query);
											if($count > 0){
												$row = mysqli_fetch_assoc($view_expense_query);
												echo $row["project_name"];
											}else{
												echo "There is no Data";
											}
										}
									?>
								</h4>
							
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<?php if(!isset($_GET["vandor_edit_id"])){ ?>
											<tr>
												<th> Vandor Name </th>
												<th> Joining Date </th>
												<th> Edit </th>
												<th> Delete </th>
											</tr>
											<?php } ?>
											<?php 
												// vandor edit Data Update
												if(isset($_POST["update_vandor_submit"])){
													$update_vandor_sql ="UPDATE vandor SET vandor_name='".$_POST['update_vaandor_name']."', joining_date='".$_POST['update_vandor_date']."' WHERE id='".$_POST['update_vandor_id']."'";
													$update_vandor_query = mysqli_query($conn, $update_vandor_sql);
													if($update_vandor_query==true){

														echo "<script>window.location.href('project_view.php?error=Vandor Updated');</script>";
													}else{
														echo "<script>window.location.href('project_view.php?error=Not Updated');</script>";
													}
												}

												if(isset($_GET["vandor_edit_id"])){

													$one_row_sql ="SELECT * FROM vandor WHERE id='".$_GET["vandor_edit_id"]."'";
													$one_row_query = mysqli_query($conn, $one_row_sql);
													$one_row_fetch = mysqli_fetch_assoc($one_row_query);

													echo "<div class='table-responsive'>
															<table class='table table-bordered'>
																<thead>
																	<tr>
																	<form action='vandor_view.php' method='POST'>
																	<input type='hidden' name='update_vandor_id' style='color:red;' value='".$one_row_fetch['id']."'>
																	<th><input type='text' class='form-control' name='update_vaandor_name' style='color:white;' value='".$one_row_fetch['vandor_name']."'></th>
																	<th><input type='date' class='form-control' name='update_vandor_date' style='color:white;'></th>
																	<th><input type='submit' class='form-control btn btn-dark' name='update_vandor_submit' style='color:white;' value='Update'></th>
																	</form>
																	</tr>
																</thead>
															</table>
														</div>";
												}
											
											?>
										</thead>
										<tbody>
											<?php 
												include_once 'db/db.php';
												
												// Delete Data
												if(isset($_GET["vandor_delete"])){
													$get_vandor_id = $_GET["vandor_delete"];
													$delete_vandor_row = "DELETE FROM vandor WHERE id=$get_vandor_id";
													$delete_vandor_query = mysqli_query($conn, $delete_vandor_row);
													if($delete_vandor_query==true){
														echo "<script>window.location.replace('project_view.php?error=Vandor Deleted Successfull');</script>";
													}else{
														echo "<script>window.location.replace('project_view.php?error=You have to remove child of vandor');</script>";
													}
												}
												
												// fatch data
												if(isset($_GET["project_id"])){
												$page_data = $_GET["project_id"];
													
												$view_expense_sql = "SELECT vandor.vandor_name, vandor.id, DATE_FORMAT(vandor.joining_date, '%d - %m - %Y') AS vandor_date FROM project INNER JOIN vandor ON project.id = vandor.project_id  WHERE vandor.project_id= '$page_data';";
												$view_expense_query= mysqli_query($conn, $view_expense_sql);
												while($row = mysqli_fetch_assoc($view_expense_query)){
											?>
											<tr>
												
												<td> <a class='text-decoration-none' style="color:#0094BC;" href="expense_view_individual.php?vandor_id=<?php echo $row['id']; ?>"> <?php echo $row["vandor_name"]; ?> </a> </td>
												<td style="color:#0094BC;"> <?php echo $row["vandor_date"]; ?> </td>
												<td> <a class='text-decoration-none text-success' href="vandor_view.php?vandor_edit_id=<?php echo $row['id']; ?>"> Edit </a> </td>
												<td><a href="javascript:void()" onClick="checkalert(<?php echo $row['id'];?>)" class='text-decoration-none text-danger'> Delete </a></td>
											</tr>
											<?php 
													} 
												} 
											?>
											<script type="text/javascript">
												function checkalert(id){
													
													msg =confirm("Are you sure Delete the Data?");
													if(msg){
														document.location.href="vandor_view.php?vandor_delete="+id;
													}
												}
											</script>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Balance</h4>
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
												if(isset($_GET["project_id"])){
													$page_data = $_GET["project_id"];
														
													$view_expense_sql = "SELECT project_name, SUM(costing_amount) AS project_amount FROM vandor INNER JOIN project ON project.id = vandor.project_id INNER JOIN costing ON vandor.id = costing.vandor_id WHERE vandor.project_id = '$page_data';";
													$view_expense_query = mysqli_query($conn, $view_expense_sql);
													$row = mysqli_fetch_assoc($view_expense_query);
													$v_count  = mysqli_num_rows($view_expense_query);

													$a = "SELECT project.project_name, SUM(deposit.amount) AS amount FROM `deposit` INNER JOIN project ON project.id = deposit.project_id WHERE deposit.project_id = '$page_data';";
													$b= mysqli_query($conn, $a);
													$c = mysqli_fetch_assoc($b);
													$count = mysqli_num_rows($b);
												}
												
											?>	
											<tr>
												<td> <?php echo "Spend " .$row["project_name"]; ?> </td>
												<td> <?php echo $row["project_amount"]; ?></td>
											</tr>
											<?php  if($count > 0){ ?>
												<tr>
													<td> <?php echo "Deposit " .$c["project_name"];?></td>
													<td> <?php echo $c["amount"]; ?></td>
												</tr>
													<td class="font-weight-bold text-info"> Available </td>
													<td> <?php echo $c["amount"] - $row["project_amount"]; ?></td>
											<?php }else{ echo "<td> Deposit</td><td> Empty</td>"; } ?>
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