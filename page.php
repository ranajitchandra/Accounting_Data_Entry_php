<?php 
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
                  	<div class="card-body">
                    <h4 class="card-title">Expense List</h4>
                    
                    <div class="table-responsive">
                      	<table class="table table-bordered">
							
							<thead>
								<tr>
									<th> ID </th>
									<th> Projeect Namme </th>
									<th> Vandor Name </th>
									<th> Details</th>
								</tr>
							</thead>
									<tbody>
										<?php 
											include_once 'db/db.php';
											if(isset($_GET["value"])){
												$a = $_GET["value"];
												$b = ($a - 1) * 3;
												$incri = $a+1;
												$decri = $a-1;
											}else{
												$b = 0;
												$incri = 2;
												$decri = 0;
											}

											$count_sql = "SELECT * FROM costing";
											$count_query = mysqli_query($conn, $count_sql);
											$count_row = mysqli_num_rows($count_query);
											$res = ($count_row / 3)+1;
											
											$view_expense_sql = "SELECT * FROM costing LIMIT 3 OFFSET $b;";
											$view_expense_query= mysqli_query($conn, $view_expense_sql);
											while($row = mysqli_fetch_assoc($view_expense_query)){ ?>
										<tr>
											<td> <?php echo $row["id"]; ?> </td>
											<td> <?php echo $row["details"]; ?> </td>
											<td> <?php echo $row["costing_amount"]; ?> </td>
											<td> <?php echo $row["costing_date"]; ?> </td>
											
										</tr>
										<?php 
												} 
										?>
							</tbody>
                      </table>
						<div class="text-center pt-5">
							<?php 
								if($decri==0){
									echo "Pre";
								}else{
									echo "<a href='page.php?value=$decri' class='text-decoration-none text-success m-2'> Pre </a>";
								}

								if($incri>$res){
									echo "Pre";
								}else{
									echo "<a href='page.php?value=$incri' class='text-decoration-none text-danger m-2'> Next </a>";
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
    ?>