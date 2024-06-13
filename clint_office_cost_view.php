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
				<div class="col-lg-12 grid-margin stretch-card">
					<div class="card">
						<?php 
							if(isset($_GET["error"])){
								echo "<span class='text-info'>".$_GET["error"]."</span>";
							}
						?>
						<div class="card-body">
						<h4 class="card-title">Office</h4>
						
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<?php
										if(!isset($_GET["project_edit_id"])){ ?>
									<tr>
										<th> ID </th>
										<th> Project name </th>
										<th> Address </th>
										<th> Deadline </th>
									</tr>
									<?php } ?>
								</thead>
								<tbody>
									<?php 
										include_once 'db/db.php';
												//  Pagination logic
												if(isset($_GET["value"])){
													$a = $_GET["value"];
													$page_value = ($a - 1) * 10;
													$incri = $a+1;
													$decri = $a-1;
												}else{
													$page_value = 0;
													$incri = 2;
													$decri = 0;
												}
												// Show Count For Pagination Sql
												$count_sql = "SELECT * FROM office_cost";
												$count_query = mysqli_query($conn, $count_sql);
												$count_row = mysqli_num_rows($count_query);
												$res = ($count_row / 10)+1;
											// Fetch Data
											$view_project = "SELECT *, DATE_FORMAT(starting_date, '%d - %m - %Y') AS oroject_date FROM project ORDER BY id DESC LIMIT 10 OFFSET $page_value;";
											$view_project_query = mysqli_query($conn, $view_project);
										
											// if(isset($_GET["project_get"])){
											// 	echo "<script>window.location.href='costing_view.php'</script>";
											// }
											
											while($row = mysqli_fetch_assoc($view_project_query)){
									?>
									<tr>
										<td><?php echo $row["id"]; ?></td>
										
										<td><a class="text-decoration-none" style="color:#0094BC;" href="clint_office_cost_view_individual.php?project_id=<?php echo $row['id']; ?>"> <?php echo $row["project_name"]; ?> </a></td>
										<td> <span style="color:#0094BC;"> <?php echo $row["address"]; ?> </span></td>
										<td> <span style="color:#0094BC;"> <?php echo $row["oroject_date"]; ?></span> </td>
										
									</tr>
									<?php } ?>
								</tbody>
							</table>
							<div class="text-center pt-5">
								<?php
									if(!isset($_GET["office_edit"])){
										if($decri==0){
											echo "<span class='text-light m-2'>Pre</span>";
										}else{
											echo "<a href='project_view.php?value=$decri' class='text-decoration-none text-success m-2'> Pre </a>";
										}
										if($incri>$res){
											echo "<span class='text-light m-2'>Next</span>";
										}else{
												echo "<a href='project_view.php?value=$incri' class='text-decoration-none text-danger m-2'> Next </a>";
										}
									}
								?>
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