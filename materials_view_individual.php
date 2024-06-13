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
												<th> Action </th>
												
											</tr>
											<?php } ?>
											<?php 
												// material edit Data Update
												if(isset($_POST["update_material_submit"])){
													$update_material_sql ="UPDATE materials SET material_name='".$_POST['update_material_name']."', type='".$_POST['update_material_type']."', description='".$_POST['update_material_des']."', m_amount='".$_POST['update_material_amount']."', m_date='".$_POST['update_material_date']."' WHERE id='".$_POST['update_material_id']."'";
													$update_material_query = mysqli_query($conn, $update_material_sql);
													if($update_material_query==true){
														
														echo "<script>window.location.replace('materials_view.php?error=Updated');</script>";
													}else{
														echo "<script>window.location.replace('materials_view.php?error=Not Updated');</script>";
													}
												}

												// material Delete Data
												if(isset($_GET["material_delete"])){
													$get_material_id = $_GET["material_delete"];
													$delete_materia_row = "DELETE FROM materials WHERE id=$get_material_id";
													$delete_materia_query = mysqli_query($conn, $delete_materia_row);
													if($delete_materia_query==true){
														echo "<script>window.location.replace('materials_view.php?error=Delete');</script>";
													}else{
														echo "<script>window.location.replace('materials_view.php?error=Not Delete');</script>";
													}
												}
												// input click Edit
												if(isset($_GET["material_id"])){

													$one_row_sql ="SELECT * FROM materials WHERE id='".$_GET["material_id"]."'";
													$one_row_query = mysqli_query($conn, $one_row_sql);
													$one_row_fetch = mysqli_fetch_assoc($one_row_query);

													echo "<div class='table-responsive'>
															<table class='table table-bordered'>
																<thead>
																	<tr>
																	<form action='materials_view_individual.php' method='POST'>
																	<input type='hidden' name='update_material_id' style='color:red;' value='".$one_row_fetch['id']."'>
																	<th><input type='text' class='form-control' name='update_material_name' style='color:white;' value='".$one_row_fetch['material_name']."'></th>
																	<th><input type='text' class='form-control' name='update_material_type' style='color:white;' value='".$one_row_fetch['type']."'></th>
																	<th><input type='text' class='form-control' name='update_material_des' style='color:white;' value='".$one_row_fetch['description']."'></th>
																	<th><input type='text' class='form-control' name='update_material_amount' style='color:white;' value='".$one_row_fetch['m_amount']."'></th>
																	<th><input type='date' class='form-control' name='update_material_date' style='color:white;'></th>
																	<th><input type='submit' class='form-control btn btn-dark' name='update_material_submit' style='color:white;' value='Update'></th>
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
												<td>
													<a class='text-decoration-none text-success' href="materials_view_individual.php?material_id=<?php echo $row['id']; ?>"> Edit </a>|
													<a href="javascript:void()" onClick="checkalert(<?php echo $row['id'];?>)" class='text-decoration-none text-danger'> Delete </a>
												</td>
												
											</tr>
											<?php 
													} 
												} 
											?>
											<script type="text/javascript">
												function checkalert(id){
													
													msg =confirm("Are you sure Delete the Data?");
													if(msg){
														document.location.href="materials_view_individual.php?material_delete="+id;
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