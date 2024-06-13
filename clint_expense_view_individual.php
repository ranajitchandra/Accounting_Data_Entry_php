<?php
	session_start();
	if(isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 'general'){
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
											</tr>
										</thead>
										<tbody>
											<?php 
												include_once 'db/db.php';
												
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
											</tr>
											<?php	}
												}
											}
											?>
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