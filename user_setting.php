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
					<div class="col-lg-4 grid-margin stretch-card">
					<div class="card">
							<div class="card-body">
								<?php
									// update
									if(isset($_POST["dev_submit"])){
										$id = $_POST["dev_id"];
										$big_title = $_POST["big_title"];
										$dev_up_sql ="UPDATE dev_tool SET big_title ='$big_title' WHERE id = '$id';";
										$dev_up_sql_query = mysqli_query($conn, $dev_up_sql);
										if($dev_up_sql_query == true){
											echo "<script>window.location.href = 'user_setting.php';</script>";
										}else{
											echo "<script>window.alert('Something Wrong');</script>";
										}
										
									}	

									$dev_sql ="SELECT * FROM dev_tool;";
									$dev_sql_query = mysqli_query($conn, $dev_sql);
									$dev_row = mysqli_fetch_assoc($dev_sql_query);
									
									if(!isset($_GET["dev_id"])){
									if(mysqli_num_rows($dev_sql_query) == 1	){
										echo "<div class='table-responsive'>
											<table class='table table-bordered'>
												<thead>
													<tr>
														<th><a class='text-decoration-none fs-5 text-white' href='user_setting.php?dev_id=" .$dev_row["id"]."'>".$dev_row["big_title"]."</a></th>
													</tr>
												</thead>
											</table>
										</div>";
									}
								}
									if(isset($_GET["dev_id"])){
										echo "<table class='table table-bordered'>
											<thead>
												<tr>
													<form action='' method='POST'>
														<div class='form-group row'>
															<div class='col-sm-12'>
																<input type='hidden' name='dev_id' class='form-control' id='exampleInputUsername2' value='".$_GET["dev_id"]."' required>
																<input type='text' name='big_title' class='form-control' id='exampleInputUsername2' value='".$dev_row["big_title"]."' required>
															</div>
														</div>
														<button type='submit' name='dev_submit' class='btn btn-primary w-100'>Submit</button>
													</form>
												</tr>
											</thead>
										</table>";
									}
								?>
							</div>
						</div>
					</div>
					<div class="col-lg-8 grid-margin stretch-card">
						<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<th> Role </th>
													<th> User Name </th>
													<th> Email </th>
													
													<th> Modify </th>
												</tr>
											</thead>
											<tbody>
												<?php
													// user_roll-update
													if(isset($_POST["confirm"])){
														$u_id = $_POST["u_id"];
														$u_role = $_POST["role_value"];
														$user_upd_sql = "UPDATE user SET user_role='$u_role' WHERE id  = '$u_id';";
														$user_upd_query = mysqli_query($conn, $user_upd_sql);
														if($user_upd_query == true){
															echo "<script>window.alert('Access set done');</script>";
														}else{
															echo "<script>window.alert('Something Wrong');</script>";
														}

													} 
													if(isset($_GET["user_id"])){
															
														echo "<form action='user_setting.php' method='POST'>
																<input type='hidden' name='u_id' value='".$_GET["user_id"]."'>
																<th><select name='role_value' class='form-control'>
																		<option value='general'>General</option>
																		<option value='root_admin'>Root Admin</option>
																	</select>
																</th>
																<th><button type='submit' name='confirm' class='btn'>
																	<i class='mdi mdi-checkbox-marked text-warning fs-1'></i>
																	</button>
																</th>
																</form>";
														}
													
													//  Fatch Data
													$user_sql = "SELECT * FROM user LIMIT 20 OFFSET 2";
													$user_sql_query = mysqli_query($conn, $user_sql);
														
													if(mysqli_num_rows($user_sql_query) > 0){
														while($show_user = mysqli_fetch_assoc($user_sql_query)){
																
												?>
																
												<tr>
													<td> <?php echo $show_user["user_role"]; ?> </td>
													<td> <?php echo $show_user["user_name"]; ?> </td>
													<td> <?php echo $show_user["email"]; ?> </td>
													
													<td> <a class="text-decoration-none" style="color: #9da06b;" href="user_setting.php?user_id=<?php echo $show_user["id"]; ?>">Edit_Role</a> </td>
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