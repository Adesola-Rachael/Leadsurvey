<?php
  //set page type
  $page_type = "members_only"; //variable includes: all_users , members_only, visitors_only

  //setting directory level
  $dir_level = 0;

  $page_title = "Support Tickets";
  $active_page = "tickets";

  //include variables
  include_once './includes/variables.inc.php';

  //Include page header
  include_once './includes/header.inc.php';

  //Include database connection file
  include_once('./includes/dbConnection.php');

  //collecting values to be utilised in page
  $processing = 0;
  $completed = 0;
  $abandoned = 0;
  $today_user = 0;
  $local_sales = 0;

  //collecting contact_us_msg details for display
  // $query_contact = "SELECT * FROM contact_us ";  
  // $result_contact = $conn->query($query_contact);
  // if($result_contact){//if query was executed successfully
  //     $rows_contact = $result_contact->num_rows;
  // } 

  //collecting contact details for display
  // $query_user = "SELECT * FROM user_auth ";  
  // $result_user = $conn->query($query_user);
  // if($result_user){//if query was executed successfully
  //     $rows_user = $result_user->num_rows;
  // } 
?>

<!--START IN-PAGE STYLES -->

<!--END IN-PAGE STYLES -->

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php
    //Include top nav
    include_once './includes/nav.inc.php';

    //Include sidebar
    include_once './includes/sidebar.inc.php';
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Support Tickets</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Support Tickets</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>

                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk of the card's
                  content.
                </p>

                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
              </div>
            </div>

            <div class="card card-primary card-outline">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>

                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk of the card's
                  content.
                </p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
              </div>
            </div><!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header">
                <h5 class="m-0">Featured</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Special title treatment</h6>

                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Featured</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Special title treatment</h6>

                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
  //Include page footer
  include_once './includes/footer.inc.php';
  ?>

  <!-- START IN-PAGE SRIPTS -->
 
  <!-- END IN-PAGE SRIPTS -->

</body>
</html>
