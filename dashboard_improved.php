"<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  session_start();
  include "inc/top.php";
  
  // Database connection
  include "app/config/db.php";
  
  // Fetch statistics
  $project_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM project"))['count'];
  $deposit_total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(amount) as total FROM deposit"))['total'];
  $costing_total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(costing_amount) as total FROM costing"))['total'];
  $vendor_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM vandor"))['count'];
  $material_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM materials"))['count'];
  $office_cost_total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(office_amount) as total FROM office_cost"))['total'];
  $total_expense = $costing_total + $office_cost_total;
  $balance = $deposit_total - $total_expense;
  
  // Get recent projects
  $recent_projects = mysqli_query($conn, "SELECT * FROM project ORDER BY starting_date DESC LIMIT 5");
  
  // Get recent deposits
  $recent_deposits = mysqli_query($conn, "SELECT d.*, p.project_name FROM deposit d JOIN project p ON d.project_id = p.id ORDER BY d.deposit_date DESC LIMIT 5");
  
  // Get top projects by deposit amount
  $top_projects = mysqli_query($conn, "SELECT p.project_name, SUM(d.amount) as total_deposit FROM project p JOIN deposit d ON p.id = d.project_id GROUP BY p.id ORDER BY total_deposit DESC LIMIT 5");
?>
</head>
<body>
  <div class="container-scroller">
    <!-- sidebar -->
    <?php include "inc/sidebar.php"; ?>
    <!-- sidebar -->
    
    <div class="container-fluid page-body-wrapper">
      <!-- navbar -->
      <?php include "inc/navbar.php"; ?>
      <!-- navbar -->

      <!-- content-wrapper start -->
      <div class="main-panel">
        <div class="content-wrapper">
          
          <!-- Page Header -->
          <div class="page-header d-flex justify-content-between align-items-center mb-4">
            <div>
              <h3 class="page-title mb-1">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span>
                Dashboard
              </h3>
              <p class="text-muted mb-0">Welcome back! Here's your project overview.</p>
            </div>
            <div class="d-flex gap-2">
              <button class="btn btn-outline-primary btn-sm">
                <i class="mdi mdi-download mr-1"></i> Report
              </button>
              <button class="btn btn-primary btn-sm">
                <i class="mdi mdi-plus mr-1"></i> New Project
              </button>
            </div>
          </div>

          <!-- Statistics Cards -->
          <div class="row">
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card stats-card stats-card-primary">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div>
                    <p class="text-muted mb-1 font-weight-bold">Total Projects</p>
                    <h3 class="mb-0"><?= $project_count ?></h3>
                  </div>
                  <div class="stats-icon">
                    <i class="mdi mdi-folder-multiple"></i>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card stats-card stats-card-success">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div>
                    <p class="text-muted mb-1 font-weight-bold">Total Deposit</p>
                    <h3 class="mb-0">৳ <?= number_format($deposit_total) ?></h3>
                  </div>
                  <div class="stats-icon">
                    <i class="mdi mdi-cash-multiple"></i>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card stats-card stats-card-danger">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div>
                    <p class="text-muted mb-1 font-weight-bold">Total Expense</p>
                    <h3 class="mb-0">৳ <?= number_format($total_expense) ?></h3>
                  </div>
                  <div class="stats-icon">
                    <i class="mdi mdi-wallet-giftcard"></i>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card stats-card stats-card-warning">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div>
                    <p class="text-muted mb-1 font-weight-bold">Balance</p>
                    <h3 class="mb-0">৳ <?= number_format($balance) ?></h3>
                  </div>
                  <div class="stats-icon">
                    <i class="mdi mdi-chart-line"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Secondary Stats -->
          <div class="row">
            <div class="col-md-2 grid-margin stretch-card">
              <div class="card mini-stats-card">
                <div class="card-body text-center">
                  <i class="mdi mdi-account-group text-primary mb-2" style="font-size: 2rem;"></i>
                  <h4 class="mb-1"><?= $vendor_count ?></h4>
                  <p class="text-muted mb-0">Vendors</p>
                </div>
              </div>
            </div>
            
            <div class="col-md-2 grid-margin stretch-card">
              <div class="card mini-stats-card">
                <div class="card-body text-center">
                  <i class="mdi mdi-package-variant text-success mb-2" style="font-size: 2rem;"></i>
                  <h4 class="mb-1"><?= $material_count ?></h4>
                  <p class="text-muted mb-0">Materials</p>
                </div>
              </div>
            </div>
            
            <div class="col-md-2 grid-margin stretch-card">
              <div class="card mini-stats-card">
                <div class="card-body text-center">
                  <i class="mdi mdi-briefcase-check text-info mb-2" style="font-size: 2rem;"></i>
                  <h4 class="mb-1"><?= $project_count ?></h4>
                  <p class="text-muted mb-0">Active</p>
                </div>
              </div>
            </div>
            
            <div class="col-md-2 grid-margin stretch-card">
              <div class="card mini-stats-card">
                <div class="card-body text-center">
                  <i class="mdi mdi-alert-circle text-warning mb-2" style="font-size: 2rem;"></i>
                  <h4 class="mb-1">2</h4>
                  <p class="text-muted mb-0">Pending</p>
                </div>
              </div>
            </div>
            
            <div class="col-md-2 grid-margin stretch-card">
              <div class="card mini-stats-card">
                <div class="card-body text-center">
                  <i class="mdi mdi-check-circle text-success mb-2" style="font-size: 2rem;"></i>
                  <h4 class="mb-1">8</h4>
                  <p class="text-muted mb-0">Complete</p>
                </div>
              </div>
            </div>
            
            <div class="col-md-2 grid-margin stretch-card">
              <div class="card mini-stats-card">
                <div class="card-body text-center">
                  <i class="mdi mdi-trending-up text-danger mb-2" style="font-size: 2rem;"></i>
                  <h4 class="mb-1">12%</h4>
                  <p class="text-muted mb-0">Growth</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Main Content Grid -->
          <div class="row">
            <!-- Chart Section -->
            <div class="col-lg-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title mb-4">Financial Overview</h4>
                  <canvas id="financialChart" height="120"></canvas>
                </div>
              </div>
            </div>
            
            <!-- Top Projects -->
            <div class="col-lg-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title mb-4">Top Projects</h4>
                  <div class="d-flex flex-column gap-3">
                    <?php while($tp = mysqli_fetch_assoc($top_projects)): ?>
                    <div class="top-project-item">
                      <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="font-weight-bold"><?= htmlspecialchars($tp['project_name']) ?></span>
                        <span class="text-primary font-weight-bold">৳ <?= number_format($tp['total_deposit']) ?></span>
                      </div>
                      <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-primary" style="width: <?= min(100, ($tp['total_deposit'] / max($deposit_total, 1)) * 100) ?>%"></div>
                      </div>
                    </div>
                    <?php endwhile; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Recent Activities & Quick Actions -->
          <div class="row">
            <!-- Recent Projects -->
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title mb-0">Recent Projects</h4>
                    <a href="project_view.php" class="text-primary">View All</a>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Project Name</th>
                          <th>Address</th>
                          <th>Start Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php while($rp = mysqli_fetch_assoc($recent_projects)): ?>
                        <tr>
                          <td class="font-weight-bold"><?= htmlspecialchars($rp['project_name']) ?></td>
                          <td class="text-muted"><?= htmlspecialchars($rp['address']) ?></td>
                          <td><span class="badge badge-info"><?= date('M d, Y', strtotime($rp['starting_date'])) ?></span></td>
                        </tr>
                        <?php endwhile; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Recent Deposits -->
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title mb-0">Recent Deposits</h4>
                    <a href="deposit_view.php" class="text-primary">View All</a>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Project</th>
                          <th>Amount</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php while($rd = mysqli_fetch_assoc($recent_deposits)): ?>
                        <tr>
                          <td class="font-weight-bold"><?= htmlspecialchars($rd['deposit_name']) ?></td>
                          <td class="text-muted"><?= htmlspecialchars($rd['project_name']) ?></td>
                          <td class="text-success font-weight-bold">+৳ <?= number_format($rd['amount']) ?></td>
                          <td><span class="badge badge-success"><?= date('M d', strtotime($rd['deposit_date'])) ?></span></td>
                        </tr>
                        <?php endwhile; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Quick Actions -->
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title mb-4">Quick Actions</h4>
                  <div class="row">
                    <div class="col-md-3 col-sm-6">
                      <a href="project.php" class="quick-action-card">
                        <i class="mdi mdi-folder-plus"></i>
                        <span>Add Project</span>
                      </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                      <a href="deposit.php" class="quick-action-card">
                        <i class="mdi mdi-cash-plus"></i>
                        <span>Add Deposit</span>
                      </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                      <a href="materials.php" class="quick-action-card">
                        <i class="mdi mdi-package-variant-closed"></i>
                        <span>Add Material</span>
                      </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                      <a href="vandor.php" class="quick-action-card">
                        <i class="mdi mdi-account-plus"></i>
                        <span>Add Vendor</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- content-wrapper ends -->

        <?php include "inc/footer.php"; ?>
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  
  <script>
    // Financial Chart
    const ctx = document.getElementById('financialChart').getContext('2d');
    const financialChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Deposit', 'Costing', 'Office Cost', 'Balance'],
        datasets: [{
          label: 'Amount (৳)',
          data: [<?= $deposit_total ?>, <?= $costing_total ?>, <?= $office_cost_total ?>, <?= $balance ?>],
          backgroundColor: [
            'rgba(0, 112, 243, 0.8)',
            'rgba(255, 82, 82, 0.8)',
            'rgba(255, 193, 7, 0.8)',
            'rgba(40, 167, 69, 0.8)'
          ],
          borderColor: [
            'rgba(0, 112, 243, 1)',
            'rgba(255, 82, 82, 1)',
            'rgba(255, 193, 7, 1)',
            'rgba(40, 167, 69, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              color: 'rgba(0, 0, 0, 0.05)'
            }
          },
          x: {
            grid: {
              display: false
            }
          }
        }
      }
    });
  </script>
  
  <?php include "inc/bottom.php"; ?>
</body>
</html>
"