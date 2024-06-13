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
					<div class="col-lg-6 grid-margin stretch-card">
					<div class="card">
							<div class="card-body">
								<h4 class="card-title">
								<?php
										
										// title 
										if(isset($_GET["deposit_project_id"])){
											$page_data = $_GET["deposit_project_id"];
											$view_expense_sql = "SELECT * FROM project INNER JOIN deposit ON project.id = deposit.project_id WHERE deposit.project_id = '$page_data';";
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
									<table class="table">
										<thead>
											<tr>
												<th> Deposit name </th>
												<th> Amounts </th>
												<th> Date </th>
											</tr>
										</thead>
										<tbody>
											<?php
												
												if(isset($_GET["deposit_project_id"])){
													$p_d_id = $_GET["deposit_project_id"];
													$view_d_deposit = "SELECT *, DATE_FORMAT(deposit_date, '%d - %m - %Y') AS deposit_date FROM deposit INNER JOIN project ON project.id = deposit.project_id WHERE deposit.project_id='$p_d_id' ORDER BY deposit.id DESC";
													$view_d_deposit_query = mysqli_query($conn, $view_d_deposit);
													
													if(mysqli_num_rows($view_d_deposit_query) > 0){
														while($show_deposit = mysqli_fetch_assoc($view_d_deposit_query)){
															
											?>
															
											<tr>
												<td> <?php echo $show_deposit["deposit_name"]; ?> </td>
												<td> <?php echo $show_deposit["amount"]; ?> </td>
												<td> <?php echo $show_deposit["deposit_date"]; ?> </td>
											</tr>
											<?php
														}
													}
												}	
											?>
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Balance</h4>
								<div class="table-responsive">
									<table class="table">
										<thead>
										<?php
												include_once 'db/db.php';
												if(isset($_GET["deposit_project_id"])){
												$p_id = $_GET["deposit_project_id"];

												// Costing Total Amount
												$vandor_sql = "SELECT *, project.project_name, SUM(costing_amount) AS p_v_amount FROM `project` INNER JOIN vandor ON vandor.project_id = project.id INNER JOIN costing ON vandor.id = costing.vandor_id WHERE vandor.project_id = $p_id;";
												$vandor_query = mysqli_query($conn, $vandor_sql);
												$vandor_result = mysqli_fetch_assoc($vandor_query);

												// Material Total Amount
												$materials_sql = "SELECT *, project.project_name, SUM(m_amount) AS materials_amoount FROM `project` INNER JOIN materials ON project.id = materials.project_id WHERE materials.project_id = $p_id;";
												$materials_query = mysqli_query($conn, $materials_sql);
												$materials_result = mysqli_fetch_assoc($materials_query);
												
												// Office Total Amount
												$office_sql = "SELECT project.project_name, SUM(office_amount) AS office_amount FROM `office_cost` INNER JOIN project ON project.id = office_cost.project_id WHERE office_cost.project_id = $p_id;";
												$office_query = mysqli_query($conn, $office_sql);
												$office_result = mysqli_fetch_assoc($office_query);

												// deposit Total Amount
												$deposit_sql = "SELECT project.project_name, SUM(amount) AS deposit_amount FROM `deposit` INNER JOIN project ON project.id = deposit.project_id WHERE deposit.project_id = $p_id;";
												$deposit_query = mysqli_query($conn, $deposit_sql);
												$deposit_result = mysqli_fetch_assoc($deposit_query);



												// Available Total Amount
												$total = $deposit_result["deposit_amount"] - ($vandor_result["p_v_amount"] + $materials_result["materials_amoount"] + $office_result["office_amount"]);

												}
											?>
											<tr>
												<th> <?php echo $vandor_result["project_name"]; ?> </th>
												<th> Amounts </th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td> Total Vandor </td>
												<td> <?php echo $vandor_result["p_v_amount"]; ?> </td>
											</tr>
											<tr>
												<td> Total Materials </td>
												<td><?php echo $materials_result["materials_amoount"]; ?> </td>
											</tr>
											<tr>
												<td> Total Office </td>
												<td> <?php echo $office_result["office_amount"]; ?></td>
											</tr>
											<tr>
												<td> Total Deposit </td>
												<td><?php echo $deposit_result["deposit_amount"]; ?> </td>
											</tr>
												<td class="font-weight-bold text-info"> Available </td>
												<td class="font-weight-bold text-info"> <?php echo $total; ?></td>
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