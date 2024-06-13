<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          	<a class="sidebar-brand brand-logo" href="dashboard.php">
          	<h1 class="text-white">
				<?php
					$conn = mysqli_connect("localhost", "root", "", "banking");
					
					$u_sql = "SELECT * FROM dev_tool";
					$u_query = mysqli_query($conn, $u_sql);
					if($row=mysqli_fetch_assoc($u_query)){
						echo $row["big_title"];
					}
				?>
		  
			</h1>
          	</a>
          	<a class="sidebar-brand brand-logo-mini" href="Dashboard.php">
            
            <h1 class="text-white text-decoration-none">S</h1></a>

        </div>
		<?php
		// access general
		if(isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 'general'){
		?>
        <ul class="nav">
          
        	<li class="nav-item nav-category">
        		<span class="nav-link">Navigation</span>
        	</li>
        	<li class="nav-item menu-items">
				<a class="nav-link" href="dashboard.php">
					<span class="menu-icon">
						<i class="mdi mdi-speedometer"></i>
					</span>
					<span class="menu-title">Dashboard</span>
				</a>
        	</li>
         	<li class="nav-item menu-items">
				<a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
					<span class="menu-icon">
						<i class="mdi mdi-laptop"></i>
					</span>
					<span class="menu-title">Vandor</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="collapse" id="ui-basic">
					<ul class="nav flex-column sub-menu">
						<li class="nav-item"> <a class="nav-link" href="clint_project_view.php">View</a></li>
					</ul>
				</div>
          	</li>
			<li class="nav-item menu-items">
				<a class="nav-link" data-bs-toggle="collapse" href="#ui-vandor" aria-expanded="false" aria-controls="ui-vandor">
					<span class="menu-icon">
						<i class="mdi mdi-account-group"></i>
					</span>
					<span class="menu-title">Office</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="collapse" id="ui-vandor">
					<ul class="nav flex-column sub-menu">
						<li class="nav-item"> <a class="nav-link" href="clint_office_cost_view.php">View</a></li>
					</ul>
				</div>
          	</li>
			<li class="nav-item menu-items">
				<a class="nav-link" data-bs-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic2">
					<span class="menu-icon">
						<i class="mdi mdi-playlist-play"></i>
					</span>
					<span class="menu-title">Materials</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="collapse" id="ui-basic2">
					<ul class="nav flex-column sub-menu">
						<li class="nav-item"> <a class="nav-link" href="clint_materials_view.php">List</a></li>
					</ul>
				</div>
          	</li>

			  <li class="nav-item menu-items">
				<a class="nav-link" data-bs-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic3">
					<span class="menu-icon">
					<i class="mdi mdi-currency-usd-off"></i>
					</span>
					<span class="menu-title">Deposit</span>
					<i class="menu-arrow"></i>
					
				</a>
				<div class="collapse" id="ui-basic3">
					<ul class="nav flex-column sub-menu">
						<li class="nav-item"> <a class="nav-link" href="clint_deposit_view.php">View</a></li>
					</ul>
				</div>
          	</li>
        </ul>
		<?php
		}
		// access Root admin
		if(isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 'root_admin'){
    	?>

        <ul class="nav">
          
        	<li class="nav-item nav-category">
        		<span class="nav-link">Navigation</span>
        	</li>
        	<li class="nav-item menu-items">
				<a class="nav-link" href="dashboard.php">
					<span class="menu-icon">
						<i class="mdi mdi-speedometer"></i>
					</span>
					<span class="menu-title">Dashboard</span>
				</a>
        	</li>
         	<li class="nav-item menu-items">
				<a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
					<span class="menu-icon">
						<i class="mdi mdi-laptop"></i>
					</span>
					<span class="menu-title">Vandor</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="collapse" id="ui-basic">
					<ul class="nav flex-column sub-menu">
						<li class="nav-item"> <a class="nav-link" href="project_view.php">View</a></li>
					</ul>
				</div>
          	</li>
			<li class="nav-item menu-items">
				<a class="nav-link" data-bs-toggle="collapse" href="#ui-vandor" aria-expanded="false" aria-controls="ui-vandor">
					<span class="menu-icon">
						<i class="mdi mdi-account-group"></i>
					</span>
					<span class="menu-title">Office</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="collapse" id="ui-vandor">
					<ul class="nav flex-column sub-menu">
						<li class="nav-item"> <a class="nav-link" href="office_cost_view.php">View</a></li>
					</ul>
				</div>
          	</li>
			<li class="nav-item menu-items">
				<a class="nav-link" data-bs-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic2">
					<span class="menu-icon">
						<i class="mdi mdi-playlist-play"></i>
					</span>
					<span class="menu-title">Materials</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="collapse" id="ui-basic2">
					<ul class="nav flex-column sub-menu">
						<li class="nav-item"> <a class="nav-link" href="materials_view.php">List</a></li>
					</ul>
				</div>
          	</li>

			  <li class="nav-item menu-items">
				<a class="nav-link" data-bs-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic3">
					<span class="menu-icon">
					<i class="mdi mdi-currency-usd-off"></i>
					</span>
					<span class="menu-title">Deposit</span>
					<i class="menu-arrow"></i>
					
				</a>
				<div class="collapse" id="ui-basic3">
					<ul class="nav flex-column sub-menu">
						<li class="nav-item"> <a class="nav-link" href="deposit_view.php">View</a></li>
					</ul>
				</div>
          	</li>

          <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <span class="menu-icon">
                <i class="mdi mdi-security"></i>
              </span>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
			  	<li class="nav-item"> <a class="nav-link" href="user_setting.php"> User Access </a></li>
              </ul>
            </div>
          </li>
        </ul>
		<?php
		}
    	?>
    </nav>
