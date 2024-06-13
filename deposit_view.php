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
								<div class="table-responsive">
									<table class="table table-bordered">
										<?php if(!isset($_GET["deposit_edit_id"])){ ?>
										<thead>
											<tr>
												<th> project name </th>
												<th> Deposit name </th>
												<th> Amounts </th>
												<th> Deadline </th>
												<th> Edit </th>
												<th> Delete </th>
											</tr>
										</thead>
										<?php	} ?>
										<tbody>
											<?php 
												include_once 'db/db.php';
												// Delete Data
												if(isset($_GET["deposit_delete_id"])){
													$get_deposit_id = $_GET["deposit_delete_id"];
													$delete_deposit_row = "DELETE FROM deposit WHERE id=$get_deposit_id";
													$delete_deposit_query = mysqli_query($conn, $delete_deposit_row);
													if($delete_deposit_query==true){
														echo "<script>alert('Deposit Deleted'); </script>";
													}
												}
												// Edit Data Update
												if(isset($_POST["update_deposit_submit"])){
													$update_sql ="UPDATE deposit SET deposit_name='".$_POST['update_deposit_name']."', amount='".$_POST['update_deposit_amount']."', deposit_date='".$_POST['update_deposit_date']."' WHERE id='".$_POST['update_deposit_id']."'";
													$update_query = mysqli_query($conn, $update_sql);
													if($update_query==true){
														echo "<script>alert('Deposit Updated'); </script>";
													}else{
														echo "<script>alert('Deposit not Updated'); </script>";
													}
												}

												// Fatch Data
												$view_deposit = "SELECT project.id AS pid, project.project_name, deposit.deposit_name, deposit.amount, deposit.id, DATE_FORMAT(deposit_date, '%d - %m - %Y') AS odate FROM deposit INNER JOIN project ON project.id = deposit.project_id ORDER BY id DESC";
												$view_deposit_query = mysqli_query($conn, $view_deposit);
												if(isset($_GET["deposit_edit_id"])){
													$one_row_sql ="SELECT * FROM deposit WHERE id='".$_GET["deposit_edit_id"]."'";
													$one_row_query = mysqli_query($conn, $one_row_sql);
													$one_row_fetch = mysqli_fetch_assoc($one_row_query);
		
													echo "<div class='table-responsive'>
															<table class='table table-bordered'>
																<thead>
																	<tr>
																	<form action='deposit_view.php' method='POST'>
																	<input type='hidden' name='update_deposit_id' style='color:red;' value='".$one_row_fetch['id']."'>
																	<th><input type='text' class='form-control' name='update_deposit_name' style='color:white;' value='".$one_row_fetch['deposit_name']."'></th>
																	<th><input type='text' class='form-control' name='update_deposit_amount' style='color:white;' value='".$one_row_fetch['amount']."'></th>
																	<th><input type='date' class='form-control' name='update_deposit_date' style='color:white;'></th>
																	<th><input type='submit' class='form-control btn btn-dark' name='update_deposit_submit' style='color:white;' value='Update'></th>
																	</form>
																	</tr>
																</thead>
															</table>
														</div>";
														
												}else{
												while($row = mysqli_fetch_assoc($view_deposit_query)){
											?>
											<tr>
												<td><a href="deposit_view_individual.php?deposit_project_id=<?php echo $row['pid']; ?>" class='text-decoration-none text-success'> <?php echo $row["project_name"]; ?> </a>  </td>
												<td> <?php echo $row["deposit_name"]; ?> </td>
												<td> <?php echo $row["amount"]; ?></td>
												<td> <?php echo $row["odate"]; ?> </td>
												<td><a href="deposit_view.php?deposit_edit_id=<?php echo $row['id']; ?>" class='text-decoration-none text-success'> Edit </a></td>
												<td><a href="javascript:void()" onClick="checkalert(<?php echo $row['id'];?>)" class='text-decoration-none text-danger'> Delete </a></td>
											</tr>
											<?php	}
												}
											?>
											<script type="text/javascript">
												function checkalert(id){
													msg =confirm("Are you sure Delete the Data?");
													if(msg){
														document.location.href="deposit_view.php?deposit_delete_id="+id;
													}
												}
											</script>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<?php 
						if(!isset($_GET["deposit_edit_id"])){ ?>
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
												include_once 'db/db.php';
												// costing Total Amount
												$expense_sql = "SELECT SUM(costing_amount) AS examt FROM `costing`";
												$expense_query = mysqli_query($conn, $expense_sql);
												$expense_result = mysqli_fetch_assoc($expense_query);
												// deposit Total Amount
												$deposit_sql = "SELECT SUM(amount) AS deposit_amount FROM `deposit`;";
												$deposit_query = mysqli_query($conn, $deposit_sql);
												$deposit_result = mysqli_fetch_assoc($deposit_query);
												// Office Total Amount
												$office_sql = "SELECT SUM(office_amount) AS office_amount FROM `office_cost`;";
												$office_query = mysqli_query($conn, $office_sql);
												$office_result = mysqli_fetch_assoc($office_query);
												// Available Total Amount
												$total = $deposit_result["deposit_amount"] - $expense_result["examt"] - $office_result["office_amount"];
											?>
											<tr>
												<td> Total Deposit </td>
												<td> <?php echo $deposit_result["deposit_amount"]; ?></td>
											</tr>
											<tr>
												<td> Total Expense </td>
												<td> <?php echo $expense_result["examt"]; ?></td>
											</tr>
											<tr>
												<td> Total Office </td>
												<td> <?php echo $office_result["office_amount"]; ?></td>
											</tr>
												<td class="font-weight-bold text-info"> Available </td>
												<td class="font-weight-bold text-info"> <?php echo $total; ?></td>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
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