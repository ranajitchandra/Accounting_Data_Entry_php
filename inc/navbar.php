
<nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="dashboard.php"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
          </div>
          <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <!-- <ul class="navbar-nav w-100">
              <li class="nav-item w-100">
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                  <input type="text" class="form-control" placeholder="Search products">
                </form>
              </li>
            </ul> -->
            <ul class="navbar-nav navbar-nav-right">
				<?php if(!empty($_SESSION["user_role"] == 'root_admin')){ ?>
              	<li class="nav-item dropdown d-sm-block">
                	<a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown" data-bs-toggle="dropdown" aria-expanded="false" href="#">+ Create</a>
					<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="createbuttonDropdown">
							<div class="dropdown-divider"></div>
							<a href="costing.php" class="dropdown-item preview-item">
								<div class="preview-thumbnail">
									<div class="preview-icon bg-dark rounded-circle">
										<i class="mdi mdi-file-outline text-warning"></i>
									</div>
								</div>
								<div class="preview-item-content">
									<p class="preview-subject ellipsis mb-1">Expense</p>
								</div>
							</a>
							<div class="dropdown-divider"></div>
							<a href="materials.php" class="dropdown-item preview-item">
								<div class="preview-thumbnail">
									<div class="preview-icon bg-dark rounded-circle">
										<i class="mdi mdi-trello text-info"></i>
									</div>
								</div>
								<div class="preview-item-content">
									<p class="preview-subject ellipsis mb-1">Materials</p>
								</div>
							</a>
							<div class="dropdown-divider"></div>
							<a href="office_cost.php" class="dropdown-item preview-item">
								<div class="preview-thumbnail">
									<div class="preview-icon bg-dark rounded-circle">
										<i class="mdi mdi-book-open-page-variant text-primary"></i>
									</div>
								</div>
								<div class="preview-item-content">
									<p class="preview-subject ellipsis mb-1">Office</p>
								</div>
							</a>
							<div class="dropdown-divider"></div>
							<a href="project.php" class="dropdown-item preview-item">
								<div class="preview-thumbnail">
									<div class="preview-icon bg-dark rounded-circle">
										<i class="mdi mdi-incognito text-success"></i>
									</div>
								</div>
								<div class="preview-item-content">
									<p class="preview-subject ellipsis mb-1">Project</p>
								</div>
							</a>
							<div class="dropdown-divider"></div>
							<a href="vandor.php" class="dropdown-item preview-item">
								<div class="preview-thumbnail">
									<div class="preview-icon bg-dark rounded-circle">
										<i class="mdi mdi-wrench text-info"></i>
									</div>
								</div>
								<div class="preview-item-content">
									<p class="preview-subject ellipsis mb-1">Vandor</p>
								</div>
							</a>
							<div class="dropdown-divider"></div>
								<a href="deposit.php" class="dropdown-item preview-item">
									<div class="preview-thumbnail">
										<div class="preview-icon bg-dark rounded-circle">
											<i class="mdi mdi-layers text-danger"></i>
										</div>
									</div>
									<div class="preview-item-content">
										<p class="preview-subject ellipsis mb-1">Deposit</p>
									</div>
								</a>
							<div class="dropdown-divider"></div>	
					</div>
              	</li>
				<?php } ?>

              <!-- Logout -->

              	<li class="nav-item dropdown">
					<a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
					<div class="navbar-profile">
						<img class="img-xs rounded-circle" src="assets/images/faces/face15.jpg" alt="">
						<p class="mb-0 d-none d-sm-block navbar-profile-name">
							<?php 
								if(isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 'root_admin' or isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 'general'){
									echo ucwords($_SESSION["user_name"]);
								}
							?>
						</p>
						<i class="mdi mdi-menu-down d-none d-sm-block"></i>
					</div>
					</a>
					<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
						<h6 class="p-3 mb-0">
						<?php 
							if(isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 'root_admin' or isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 'general'){
								echo ucwords($_SESSION["user_name"]);
							}
						?>
						</h6>
						<div class="dropdown-divider"></div>
							<a class="dropdown-item preview-item">
								<div class="preview-thumbnail">
								<div class="preview-icon bg-dark rounded-circle">
									<i class="mdi mdi-settings text-success"></i>
								</div>
								</div>
								<div class="preview-item-content">
								<p class="preview-subject mb-1">Settings</p>
								</div>
							</a>
							<div class="dropdown-divider"></div>
							<a href="logout.php" class="dropdown-item preview-item">
								<div class="preview-thumbnail">
									<div class="preview-icon bg-dark rounded-circle">
										<i class="mdi mdi-logout text-danger"></i>
									</div>
								</div>
								<div class="preview-item-content">
									<p class="preview-subject mb-1">Log out</p>
								</div>
							</a>
							<div class="dropdown-divider"></div>	
						</div>
					
              	</li>

              <!-- logout -->
            </ul>


            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>
        <!-- partial -->
        <!-- Navbar end -->