  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="./dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">VictorWork</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="profile.php" class="d-block"><?php echo $_SESSION['victor_work_username']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">          
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link <?php echo $dashboard_active; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="campaigns.php" class="nav-link <?php echo $campaigns_active; ?>">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>
                Campaigns
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="leads.php" class="nav-link <?php echo $leads_active; ?>">
              <i class="nav-icon fas fa-user-shield"></i>
              <p>
                Leads
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="quizzes.php" class="nav-link <?php echo $quizzes_active; ?>">
              <i class="nav-icon fas fa-feather-alt"></i>
              <p>
                Quizzes
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="surveys.php" class="nav-link <?php echo $surveys_active; ?>">
              <i class="nav-icon fas fa-poll-h"></i>
              <p>
                Surveys
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="polls.php" class="nav-link <?php echo $polls_active; ?>">
              <i class="nav-icon fas fa-poll"></i>
              <p>
                Polls
              </p>
            </a>
          </li>
          <li class="nav-item <?php echo $support_open1; ?>">
            <a href="#" class="nav-link <?php echo $support_active; ?>">
              <i class="nav-icon fas fa-life-ring"></i>
              <p>
                Support
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="<?php echo $support_open2; ?>">
              <li class="nav-item">
                <a href="tutorials.php" class="nav-link <?php echo $tutorials_active; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tutorials</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="tickets.php" class="nav-link <?php echo $tickets_active; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tickets</p>
                </a>
              </li>
            </ul>
          </li>          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>