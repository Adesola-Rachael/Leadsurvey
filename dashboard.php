<?php
  //set page type
  $page_type = "members_only"; //variable includes: all_users , members_only, visitors_only

  //setting directory level
  $dir_level = 0;

  $page_title = "Dashboard";
  $active_page = "dashboard";

  //include variables
  include_once './includes/variables.inc.php';

  //Include page header
  include_once './includes/header.inc.php';

  //Include database connection file
  include_once('./includes/dbConnection.php');

  //collecting values to be utilised in page
  $id = $_SESSION['victor_work_username'];

  $query_active_quizzes = "SELECT * FROM feedback_tool WHERE user_id='$id' AND tool_type = 'quiz' AND status = 'active' ";  
  $result_active_quizzes = $conn->query($query_active_quizzes);
  if($result_active_quizzes){//if query was executed successfully
    $active_quizzes = $result_active_quizzes->num_rows;
  }else{
    $active_quizzes = 0;
  } 

  $query_total_quizzes = "SELECT * FROM feedback_tool WHERE user_id='$id' AND tool_type = 'quiz' ";  
  $result_total_quizzes = $conn->query($query_total_quizzes);
  if($result_total_quizzes){//if query was executed successfully
    $total_quizzes = $result_total_quizzes->num_rows;
  }else{
    $total_quizzes = 0;
  } 

  $query_active_surveys = "SELECT * FROM feedback_tool WHERE user_id='$id' AND tool_type = 'survey' AND status = 'active' ";  
  $result_active_surveys = $conn->query($query_active_surveys);
  if($result_active_surveys){//if query was executed successfully
    $active_surveys = $result_active_surveys->num_rows;
  }else{
    $active_surveys = 0;
  } 

  $query_total_surveys = "SELECT * FROM feedback_tool WHERE user_id='$id' AND tool_type = 'survey' ";  
  $result_total_surveys = $conn->query($query_total_surveys);
  if($result_total_surveys){//if query was executed successfully
    $total_surveys = $result_total_surveys->num_rows;
  }else{
    $total_surveys = 0;
  } 

  $query_active_polls = "SELECT * FROM feedback_tool WHERE user_id='$id' AND tool_type = 'poll' AND status = 'active' ";  
  $result_active_polls = $conn->query($query_active_polls);
  if($result_active_polls){//if query was executed successfully
    $active_polls = $result_active_polls->num_rows;
  }else{
    $active_polls = 0;
  } 

  $query_total_polls = "SELECT * FROM feedback_tool WHERE user_id='$id' AND tool_type = 'poll' ";  
  $result_total_polls = $conn->query($query_total_polls);
  if($result_total_polls){//if query was executed successfully
    $total_polls = $result_total_polls->num_rows;
  }else{
    $total_polls = 0;
  } 

  $query_active_campaigns = "SELECT * FROM campaigns WHERE user_id='$id' AND status = 'ongoing' ";  
  $result_active_campaigns = $conn->query($query_active_campaigns);
  if($result_active_campaigns){//if query was executed successfully
    $active_campaigns = $result_active_campaigns->num_rows;
  }else{
    $active_campaigns = 0;
  } 

  $query_total_campaigns = "SELECT * FROM campaigns WHERE user_id='$id'";  
  $result_total_campaigns = $conn->query($query_total_campaigns);
  if($result_total_campaigns){//if query was executed successfully
    $total_campaigns = $result_total_campaigns->num_rows;
  }else{
    $total_campaigns = 0;
  } 

  $query_new_leads = "SELECT * FROM leads WHERE user_id='$id' AND date_created = '" .date("Y-m-d")."' ";  
  $result_new_leads = $conn->query($query_new_leads);
  if($result_new_leads){//if query was executed successfully
    $new_leads = $result_new_leads->num_rows;
  }else{
    $new_leads = 0;
  } 

  $query_total_leads = "SELECT * FROM leads WHERE user_id='$id'";  
  $result_total_leads = $conn->query($query_total_leads);
  if($result_total_leads){//if query was executed successfully
    $total_leads = $result_total_leads->num_rows;
  }else{
    $total_leads = 0;
  } 

  //Getting data for Graph
  $leads_graph_dates = [];
  $leads_graph_values = [];

  //get dates
  $currentdate = date("Y-m-d");
  for ($i = 13; $i >= 0; $i--){
    $leads_graph_dates[$i] = date('j-M-y', strtotime($currentdate.'- '.$i.' days'));
    
    $date_graph = date('Y-m-d', strtotime($currentdate.'- '.$i.' days'));
    $query_new_leads = "SELECT * FROM leads WHERE user_id='$id' AND date_created = '$date_graph' ";  
    $result_new_leads = $conn->query($query_new_leads);
    if($result_new_leads){//if query was executed successfully
      $leads_graph_values[$i] = $result_new_leads->num_rows;
    }else{
      $leads_graph_values[$i] = 0;
    } 
  }
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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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
          <!-- ./col -->
          <div class="col-lg-2 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><sup style="font-size: 20px"><?php echo $active_quizzes;?>/</sup><?php echo $total_quizzes;?></h3>

                <p>Active Quizzes</p>
              </div>
              <div class="icon">
                <i class="fas fa-feather-alt"></i>
              </div>
              <a href="quizzes.php" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><sup style="font-size: 20px"><?php echo $new_leads;?>/</sup><?php echo $total_leads;?></h3>

                <p>New Leads Today</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-shield"></i>
              </div>
              <a href="leads.php" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>          
          <!-- ./col -->
          <div class="col-lg-2 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><sup style="font-size: 20px"><?php echo $active_surveys;?>/</sup><?php echo $total_surveys;?></h3>

                <p>Active Surveys</p>
              </div>
              <div class="icon">
                <i class="fas fa-poll-h"></i>
              </div>
              <a href="surveys.php" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><sup style="font-size: 20px"><?php echo $active_campaigns;?>/</sup><?php echo $total_campaigns;?></h3>

                <p>Ongoing Campaigns</p>
              </div>
              <div class="icon">
                <i class="fas fa-bullhorn"></i>
              </div>
              <a href="campaigns.php" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-6">
            <!-- small card -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><sup style="font-size: 20px"><?php echo $active_polls;?>/</sup><?php echo $total_polls;?></h3>

                <p>Active Polls</p>
              </div>
              <div class="icon">
                <i class="fas fa-poll"></i>
              </div>
              <a href="polls.php" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Leads Generation History</h3>               
              </div>
              <div class="card-body">
                <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                  <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 312px;" width="390" height="312" class="chartjs-render-monitor"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
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
  <!-- ChartJS -->
  <script src="./plugins/chart.js/Chart.min.js"></script>
  
  <script type="text/javascript">
    $(function () {
        var lineChartData = {
        labels  : [ <?php echo " '".$leads_graph_dates[13]." '"; ?>, 
                    <?php echo " '".$leads_graph_dates[12]." '"; ?>,
                    <?php echo " '".$leads_graph_dates[11]." '"; ?>,
                    <?php echo " '".$leads_graph_dates[10]." '"; ?>,
                    <?php echo " '".$leads_graph_dates[9]." '"; ?>,
                    <?php echo " '".$leads_graph_dates[8]." '"; ?>,
                    <?php echo " '".$leads_graph_dates[7]." '"; ?>,
                    <?php echo " '".$leads_graph_dates[6]." '"; ?>,
                    <?php echo " '".$leads_graph_dates[5]." '"; ?>,
                    <?php echo " '".$leads_graph_dates[4]." '"; ?>,
                    <?php echo " '".$leads_graph_dates[3]." '"; ?>,
                    <?php echo " '".$leads_graph_dates[2]." '"; ?>,
                    <?php echo " '".$leads_graph_dates[1]." '"; ?>,
                    <?php echo " 'Today'"; ?>
                  ],
        datasets: [
          {
            label               : 'Leads',
            backgroundColor     : 'rgba(60,141,188,0.9)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : true,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : [ <?php echo $leads_graph_values[13]; ?>, 
                                    <?php echo $leads_graph_values[12]; ?>,
                                    <?php echo $leads_graph_values[11]; ?>,
                                    <?php echo $leads_graph_values[10]; ?>,
                                    <?php echo $leads_graph_values[9]; ?>,
                                    <?php echo $leads_graph_values[8]; ?>,
                                    <?php echo $leads_graph_values[7]; ?>,
                                    <?php echo $leads_graph_values[6]; ?>,
                                    <?php echo $leads_graph_values[5]; ?>,
                                    <?php echo $leads_graph_values[4]; ?>,
                                    <?php echo $leads_graph_values[3]; ?>,
                                    <?php echo $leads_graph_values[2]; ?>,
                                    <?php echo $leads_graph_values[1]; ?>,
                                    <?php echo $leads_graph_values[0]; ?>
                                     
                                  ],
          }
        ]
      }

      var lineChartOptions = {
        maintainAspectRatio : false,
        responsive : true,
        legend: {
          display: false
        },
        scales: {
          xAxes: [{
            gridLines : {
              display : true,
            }
          }],
          yAxes: [{
            gridLines : {
              display : true,
            }
          }]
        }
      }

      //-------------
      //- LINE CHART -
      //--------------
      var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
      var lineChartOptions = $.extend(true, {}, lineChartOptions)
      var lineChartData = $.extend(true, {}, lineChartData)
      lineChartData.datasets[0].fill = false;
      lineChartOptions.datasetFill = false

      var lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
      })
    })
  </script>
  <!-- END IN-PAGE SRIPTS -->

</body>
</html>
