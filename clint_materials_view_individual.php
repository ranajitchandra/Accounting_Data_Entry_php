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
					<div class="col-lg-8 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">
									<?php
										include_once 'db/db.php';
										// title 
										if(isset($_GET["project_id"])){
											$page_data = $_GET["project_id"];
												
											$view_materials_sql = "SELECT * FROM materials INNER JOIN project ON project.id = materials.project_id WHERE materials.project_id = '$page_data';";
											$view_materials_query= mysqli_query($conn, $view_materials_sql);
											if(mysqli_num_rows($view_materials_query) > 0){
												$row = mysqli_fetch_assoc($view_materials_query);
												echo $row["project_name"] ." Materials";
											}else{
												echo "Materials";
											}
											
										}
									?>
								</h4>
							
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<?php if(!isset($_GET["material_id"])){ ?>
											<tr>
												
												<th> Material Name </th>
												<th> Type </th>
												<th> Description </th>
												<th> Amount </th>
												<th> Date </th>
											</tr>
											<?php } ?>
										</thead>
										<tbody>
											<?php 
												include_once 'db/db.php';
												// fatch data
												if(isset($_GET["project_id"])){
												$page_data = $_GET["project_id"];
													
												$view_materials_sql = "SELECT *, materials.id, DATE_FORMAT(materials.m_date, '%d - %m - %Y') AS m_date FROM materials INNER JOIN project ON project.id = materials.project_id WHERE materials.project_id = '$page_data';";
												$view_materials_query= mysqli_query($conn, $view_materials_sql);
												while($row = mysqli_fetch_assoc($view_materials_query)){
											?>
											<tr>
												<td class='text-decoration-none' style="color:#0094BC;"> <?php echo $row["material_name"]; ?> </td>
												<td class='text-decoration-none' style="color:#0094BC;"> <?php echo $row["type"]; ?> </td>
												<td class='text-decoration-none' style="color:#0094BC;"> <?php echo $row["description"]; ?> </td>
												<td class='text-decoration-none' style="color:#0094BC;"> <?php echo $row["m_amount"]; ?> </td>
												<td style="color:#0094BC;"> <?php echo $row["m_date"]; ?> </td>
											</tr>
											<?php 
													} 
												} 
											?>
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
													$view_material_sql = "SELECT project_name, SUM(m_amount) AS single_amount FROM materials INNER JOIN project ON project.id = materials.project_id WHERE materials.project_id = '$page_data';";
													$view_material_query= mysqli_query($conn, $view_material_sql);
													$row = mysqli_fetch_assoc($view_material_query);

													$a = "SELECT project.project_name, SUM(deposit.amount) AS amount FROM `deposit` INNER JOIN project ON project.id = deposit.project_id WHERE deposit.project_id = '$page_data';";
													$b= mysqli_query($conn, $a);
													$c = mysqli_fetch_assoc($b);
													$count = mysqli_num_rows($b);													
												}
											?>	
											<tr>
												<td> <?php echo $row["project_name"]; ?> </td>
												<td> <?php echo $row["single_amount"] ."<i class='mdi mdi-currency-bdt'></i>"; ?></td>
											</tr>
											<?php  if($count > 0){ ?>
												<tr>
													<td> <?php echo "Deposit " .$c["project_name"];?></td>
													<td> <?php echo $c["amount"]; ?></td>
												</tr>
													<td class="font-weight-bold text-info"> Available </td>
													<td> <?php echo $c["amount"] - $row["single_amount"]; ?></td>
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