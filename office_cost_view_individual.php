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
		<?php
			include_once 'db/db.php';
			// Delete Data
			if(isset($_GET["office_delete"])){
				$get_office_id = $_GET["office_delete"];
				$delete_office_row = "DELETE FROM office_cost WHERE id=$get_office_id";
				$delete_office__query = mysqli_query($conn, $delete_office_row);
				if($delete_office__query==true){
					echo "<script>window.location.replace('office_cost_view.php?error=Office Item Deleted');</script>";
				}else{
					echo "<script>window.location.replace('office_cost_view.php?error=Office Item not Deleted');</script>";
				}
			}
			// Edit Data Update

				if(isset($_POST["update_submit"])){
					$update_sql ="UPDATE office_cost SET details='".$_POST['update_details']."', office_amount='".$_POST['update_amount']."', office_date='".$_POST['update_date']."' WHERE id='".$_POST['update_id']."'";
					$update_query = mysqli_query($conn, $update_sql);
					if($update_query==true){
						echo "<script>window.location.replace('office_cost_view.php?error=Office Item Updated');</script>";
					}else{
						echo "<script>window.location.replace('office_cost_view.php?error=Office Item not Updated');</script>";
					}
				}
		?>
			<div class="content-wrapper">
				<div class="row">
					<div class="col-lg-8 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">
									<?php
										include_once 'db/db.php';
										if(isset($_GET["project_id"])){
											$p_id = $_GET["project_id"];
											$oc_sql = "SELECT * FROM office_cost INNER JOIN project ON project.id = office_cost.project_id WHERE office_cost.project_id=$p_id";
											$oc_sql_query = mysqli_query($conn, $oc_sql);
											$oc_sql_result = mysqli_fetch_assoc($oc_sql_query);
											$count = mysqli_num_rows($oc_sql_query);
											if($count > 0){
												echo $oc_sql_result["project_name"];
											}else{
												echo "There is no Data";
											}
											
										
										}
									?>

								</h4>
							
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<?php
												if(!isset($_GET["office_edit"])){
											?>
											<tr>
												<th> Details </th>
												<th> Amount </th>
												<th> Deadline </th>
												<th> Edit </th>
												<th> Delete </th>
											</tr>
											<?php } ?>
										</thead>
										<tbody>
											<?php 
												
												// Fatch Limit Data
												if(isset($_GET["project_id"])){
													$p_id = $_GET["project_id"];
													$view_office_sql = "SELECT *, office_cost.id, DATE_FORMAT(office_date, '%d - %m - %Y') AS officeDate FROM office_cost INNER JOIN project ON project.id = office_cost.project_id WHERE office_cost.project_id = $p_id;";
													$view_office_query= mysqli_query($conn, $view_office_sql);
												
												
												if(isset($_GET["office_edit"])){
													$one_row_sql ="SELECT * FROM office_cost WHERE id='".$_GET["office_edit"]."'";
													$one_row_query = mysqli_query($conn, $one_row_sql);
													$one_row_fetch = mysqli_fetch_assoc($one_row_query);

													echo "<div class='table-responsive'>
															<table class='table table-bordered'>
																<thead>
																	<tr>
																	<form action='office_cost_view.php' method='POST'>
																	<input type='hidden' name='update_id' style='color:red;' value='".$one_row_fetch['id']."'>
																	<th><input type='text' class='form-control' name='update_details' style='color:white;' value='".$one_row_fetch['details']."'></th>
																	<th><input type='text' class='form-control' name='update_amount' style='color:white;' value='".$one_row_fetch['office_amount']."'></th>
																	<th><input type='date' class='form-control' name='update_date' style='color:white;'></th>
																	<th><input type='submit' class='form-control btn btn-dark' name='update_submit' style='color:white;' value='Update'></th>
																	</form>
																	</tr>
																</thead>
															</table>
														</div>";
														
												}else{
													while($row = mysqli_fetch_assoc($view_office_query)){
											?>
											<tr>
												<form action="controller/logic.php" methos="POST">
													<td> <?php echo $row["details"];?> </td>
													<td> <?php echo $row["office_amount"];?> </td>
													<td> <?php echo $row["officeDate"];?> </td>
													<td><a href="office_cost_view_individual.php?office_edit=<?php echo $row['id']; ?>" class='text-decoration-none text-success'> Edit </a></td>
													<td><a href="javascript:void()" onClick="checkalert(<?php echo $row['id'];?>)" class='text-decoration-none text-danger'> Delete </a></td>
												</form>
											</tr>
											<?php
													}
												}
											}
											?>
											<script type="text/javascript">
												function checkalert(id){
													
													msg =confirm("Are you sure Delete the Data?");
													if(msg){
														document.location.href="office_cost_view_individual.php?office_delete="+id;
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
														
													$view_expense_sql = "SELECT project_name, SUM(office_amount) AS office_amount FROM office_cost INNER JOIN project ON project.id = office_cost.project_id WHERE office_cost.project_id = '$page_data';";
													$view_expense_query = mysqli_query($conn, $view_expense_sql);
													$row = mysqli_fetch_assoc($view_expense_query);
													$v_count  = mysqli_num_rows($view_expense_query);

													$a = "SELECT project.project_name, deposit.amount, SUM(deposit.amount) AS amount FROM `deposit` INNER JOIN project ON project.id = deposit.project_id WHERE deposit.project_id = '$page_data';";
													$b= mysqli_query($conn, $a);
													$c = mysqli_fetch_assoc($b);
													$count = mysqli_num_rows($b);
												}
												
											?>	
											<tr>
												<td> <?php echo "Spend " .$row["project_name"]; ?> </td>
												<td> <?php echo $row["office_amount"]; ?></td>
											</tr>
											<?php  if($count > 0){ ?>
												<tr>
													<td> <?php echo "Deposit " .$c["project_name"];?></td>
													<td> <?php echo $c["amount"]; ?></td>
												</tr>
													<td class="font-weight-bold text-info"> Available </td>
													<td> <?php echo $c["amount"] - $row["office_amount"]; ?></td>
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