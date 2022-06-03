<?php
  //set page type
  $page_type = "members_only"; //variable includes: all_users , members_only, visitors_only

  //setting directory level
  $dir_level = 0;

  $page_title = "Campaigns";
  $active_page = "campaigns";

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

  //collecting page variables
  if (isset($_GET['status'])){
    $status = $_GET['status'];
  }

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
            <h1 class="m-0">Campaign Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Campaign Management</li>
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
          <!-- /.col-md-12 -->
          <div class="col-lg-12">
            <!-- Alert Boxes -->
            <?php 
                if (!empty($status) && $status == "camp_error" && $_SESSION["camp_error_msg"] != "" ) {
            ?>  

              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> New Campaign Error!</h5>                
                <?php echo $_SESSION["camp_error_msg"];?>
              </div>

            <?php }else if(!empty($status) && $status == "camp_edit_error" && $_SESSION["camp_edit_error_msg"] != ""){ ?>

              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Edit Campaign Error!</h5>                
                <?php echo $_SESSION["camp_edit_error_msg"];?>
              </div>
            <?php } ?>


            <?php 
                if (!empty($status) && $status == "camp_success") {
            ?>  

              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-thumbs-up"></i> New Campaign Created Successfully!</h5>                                
              </div>

            <?php }else if(!empty($status) && $status == "camp_edit_success"){ ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-thumbs-up"></i> Edit Campaign Successfully!</h5>                                
              </div>
            <?php } ?>



            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pop_register"><i class="fa fa-plus"></i> <b>New</b></button>                 
                  &nbsp;All Campaigns
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0 table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Title</th>
                      <th style="text-align: center;">Status</th>
                      <th style="text-align: center;">Leads</th>
                      <th style="text-align: center;">Feedback tool</th>
                      <th style="text-align: center;">Tool Data</th>
                      <th style="text-align: center;">Duration</th>
                      <th style="text-align: center;">Start Date</th>
                      <th style="text-align: center;">End Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $id=$_SESSION['victor_work_username'];
                      $camp=mysqli_query($conn, "SELECT * FROM campaigns WHERE user_id='$id' AND status!='trashed'");
                      $sn=0;
                      while ($row=mysqli_fetch_assoc($camp)) {
                       $sn+=1;
                    ?>
                    <tr>
                      <td><?php echo $sn ?>.</td>
                      <td id="title_db<?php echo $row['sn'] ?>"><?php echo $row['title'] ?></td>
                      <td id="descr_db<?php echo $row['sn'] ?>" style="display: none;"><?php echo $row['descr'] ?></td>
                      <td style="text-align: center;" id="status_db<?php echo $row['sn'] ?>">
                        <?php 
                          if ($row['status']=='not-started') {
                            $badge="secondary";
                        }else if($row['status']=='ongoing'){
                            $badge="success";
                        }else if($row['status']=='trashed'){
                            $badge="default";
                        }else if($row['status']=='ended'){
                            $badge="warning";
                        }
                        ?>
                        <span class="badge bg-<?php echo $badge ?>"><?php echo $row['status'] ?></span>
                      </td>
                      <td style="text-align: center;" id="goal_db<?php echo $row['sn'] ?>"><?php echo $row['goal'] ?></td>
                      <td style="text-align: center;" id="feedback_tool_db<?php echo $row['sn'] ?>"><?php echo $row['feedback_tool'] ?></td>
                      <td style="text-align: center;" id="feedback_data_db<?php echo $row['sn'] ?>"><a href="#"> <?php echo $row['feedback_data'] ?></a></td>
                      <td style="text-align: center;"><span id="duration_db<?php echo $row['sn'] ?>"><?php echo $row['duration'] ?></span> Weeks</td>
                      <td style="text-align: center;" id="start_date_db<?php echo $row['sn'] ?>"> 
                        <?php 
                          if ($row['start_date']==null) {
                            echo '--/--/--';
                          }else{ 
                            echo $row['start_date'];
                          } 
                        ?> 
                      </td>
                      <td style="text-align: center;" id="end_date_db<?php echo $row['sn'] ?>"> 
                        <?php 
                          if ($row['end_date']==null) {
                            echo '--/--/--';
                          }else{ 
                            echo $row['end_date'];
                          } 
                        ?> 
                      </td>
                      <td>
                        <?php 
                          if ($row['status']=='not-started') {
                            echo 
                            ' <button type="button" class="btn btn-success btn-sm" onclick="startCamp('.$row['sn'].",'".'ongoing'."');".'"><i class="fa fa-play" title="Start"></i></button>
                              <button type="button" class="btn btn-secondary btn-sm" onclick="view_options('."'".$row['title']."','".$row['sn']."')".'"><i class="fa fa-eye" title="View"></i></button>
                              <button type="button" class="btn btn-info btn-sm" onclick="edit_options('."'".$row['title']."','".$row['sn']."')".'"><i class="fa fa-pen" title="Edit"></i></button>
                              <button type="button" class="btn btn-danger btn-sm" id="id_status_trash'.$row['sn'].'"><i class="fa fa-trash" title="trash" onclick="ignore_contact('."'".$row['title']."','".$row['sn']."')".'"></i></button>
                            ';
                          }else if($row['status']=='ongoing'){ 
                            echo '
                            <button type="button" class="btn btn-warning btn-sm" onclick="summary_options('."'".$row['title']."','".$row['sn']."')".'"><i class="fa fa-stop" title="End"></i></button>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="view_options('."'".$row['title']."','".$row['sn']."')".'"><i class="fa fa-eye" title="View"></i></button>
                            <button type="button" class="btn btn-info btn-sm" onclick="edit_options('."'".$row['title']."','".$row['sn']."')".'"><i class="fa fa-pen" title="Edit"></i></button>
                            <button type="button" class="btn btn-danger btn-sm" id="id_status_trash'.$row['sn'].'"><i class="fa fa-trash" title="trash" onclick="ignore_contact('."'".$row['title']."','".$row['sn']."')".'"></i></button>';
                          } else if($row['status']=='ended'){ 
                            echo '
                            <button type="button" class="btn btn-secondary btn-sm" onclick="view_options('."'".$row['title']."','".$row['sn']."')".'"><i class="fa fa-eye" title="View"></i></button>
                            <button type="button" class="btn btn-danger btn-sm" id="id_status_trash'.$row['sn'].'"><i class="fa fa-trash" title="trash" onclick="ignore_contact('."'".$row['title']."','".$row['sn']."')".'"></i></button>';
                          }else if($row['status']=='trashed'){ 
                            echo '<span class="btn btn-danger btn-sm">Trashed</span>';
                          } 
                        ?> 
                        
                        <!--  -->
                        
                      </td>
                      
                    </tr>

                  <?php } ?>
                  </tbody>
                </table>
              </div>
               <!-- /.card-body -->
               <!-- <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div> -->
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal to add new campaign -->
  <div class="modal fade" id="pop_register">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Create New Campaign</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="forms/form_new_campaign.php" method="post" id="crud_form" role="form">
          <input name="user_id" id="id_user_id" type="text" value="<?php echo $_SESSION['victor_work_username'];?>" hidden>
          <div class="modal-body"> 
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Title</label>
                  <input name="title" id="id_title" type="text" class="form-control" placeholder="Enter Title..." required>
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea name="descr" id="id_descr" type="text" rows="2" class="form-control" placeholder="Enter Title..."></textarea>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Duration <i style="font-weight:100">(In Weeks e.g. 5)</i></label>
                      <input name="duration" id="id_duration" type="number" class="form-control" placeholder="Enter Duration...">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Goal <i style="font-weight:100">(Total leads e.g. 100)</i></label>
                      <input name="goal" id="id_goal" type="number" class="form-control" placeholder="Enter Goal...">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Feedback Tool </label>                  
                      <select name="feedback_tool" id="id_quiz1" class="form-control" onchange="fetchtool(this.value, 'tool_data1')">
                        <option value="">Select Tool</option>
                        <option value="quiz">Quiz</option>
                        <option value="survey">Survey</option>
                        <option value="poll">Poll</option>
                      </select>
                    </div>
                  </div> 
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Select Tool Data </label>                  
                      <select name="feedback_data" id="tool_data1" class="form-control">
                        <option value="">Select Data</option>
                      </select>
                    </div>
                  </div> 
                </div>              
              </div>
              <div class="col-sm-6">
                <h5>Tool Data Preview</h5>
                <div style="height: 90%; width: 100%; background: #ccc;">
                </div>
              </div>
            </div>             
          </div>

          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button name="new_campaign_submit" id="id_new_campaign_submit" type="submit" class="btn btn-primary">Create Campaign</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


  <!-- Edit Modal -->
  <div class="modal fade" id="_pop_register" tabindex="1" role="dialog" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="edit_title">Edit Campaign</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="forms/form_edit_campaign.php" method="post" id="crud_form" role="form">
          <input name="user_id" id="id_user_id" type="text" value="<?php echo $_SESSION['victor_work_username'];?>" hidden>
          
          <div class="modal-body"> 
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Title</label>
                  <input name="title" id="id_edit_title" type="text" class="form-control" placeholder="Enter Title..." required>
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea name="descr" id="id_edit_descr" type="text" rows="2" class="form-control" placeholder="Enter Title..."></textarea>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Duration <i style="font-weight:100">(In Weeks e.g. 5)</i></label>
                      <input name="duration" id="id_edit_duration" type="number" class="form-control" placeholder="Enter Duration...">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Goal <i style="font-weight:100">(Total leads e.g. 100)</i></label>
                      <input name="goal" id="id_edit_goal" type="number" class="form-control" placeholder="Enter Goal...">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Feedback Tool </label>                  
                      <select name="feedback_tool" id="id_edit_feedbackt" class="form-control" onchange="fetchtool(this.value, 'edit_tool_data1')">
                        <option value="">Select Tool</option>
                        <option value="quiz">Quiz</option>
                        <option value="survey">Survey</option>
                        <option value="poll">Poll</option>
                      </select>
                    </div>
                  </div> 
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Select Tool Data </label>                  
                      <select name="feedback_data" id="edit_tool_data1" class="form-control">
                        <option value="">Select Data</option>
                      </select>
                    </div>
                  </div> 
                </div>
              </div>
              <div class="col-sm-6">
                <h5>Tool Data Preview</h5>
                <div style="height: 90%; width: 100%; background: #ccc;">
                </div>
              </div>
            </div>               
          </div>

          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="hidden" id="edit_sn" name="edit_sn">
            <button name="new_campaign_submit" id="id_edit_campaign_submit" type="submit" class="btn btn-primary">Edit Campaign</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>


  <!-- View Modal -->
  <div class="modal fade" id="_pop_view" tabindex="1" role="dialog" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="view_title">View Campaign</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <input name="user_id" id="id_user_id" type="text" value="<?php echo $_SESSION['victor_work_username'];?>" hidden>
          
          <div class="modal-body"> 
            <div class="row">
              <div class="col-sm-6">
                <div id="form_content">
                  <!--  <p>&nbsp;&nbsp;&nbsp;<b> <u>Edit Site Details</u> </b></p> -->

                    <div class="col-sm-12">
                      <div class="form-group mb-30">
                        <label>Title:</label><span class="title_view"></span>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group mb-30">
                        <label>Status:</label><span class="status_view"></span>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group mb-30">                                  
                        <div class="form-group mb-30">
                          <label>Leads:</label><span class="leads_view"></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group mb-30">                                  
                        <div class="form-group mb-30">
                          <label>Feedback tool:</label><span class="feedbacktool_view"></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group mb-30">                                  
                        <div class="form-group mb-30">
                          <label>Tool Data:</label><span class="tooldata_view"></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group mb-30">                                  
                        <div class="form-group mb-30">
                          <label>Duration:</label><span class="duration_view"></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group mb-30">                                  
                        <div class="form-group mb-30">
                          <label>Start Date:</label><span class="startdate_view"></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group mb-30">                                  
                        <div class="form-group mb-30">
                          <label>End Date:</label><span class="enddate_view"></span>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="col-sm-6">
                <h5>Tool Data Preview</h5>
                <div style="height: 90%; width: 100%; background: #ccc;">
                </div>
              </div>
            </div>  
          </div>

          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
            
          </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>

    <!-- View Modal -->
  <div class="modal fade" id="_pop_summary" tabindex="1" role="dialog" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="summary_title">Summary Campaign</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <input name="user_id" id="id_user_id" type="text" value="<?php echo $_SESSION['victor_work_username'];?>" hidden>
         
          <div class="modal-body"> 
            <div class="row">
              <div class="col-sm-6">
                <div id="form_content">
                  <!--  <p>&nbsp;&nbsp;&nbsp;<b> <u>Edit Site Details</u> </b></p> -->

                    <div class="col-sm-12">
                      <div class="form-group mb-30">
                        <label>Title:</label><span class="title_view"></span>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group mb-30">                                  
                        <div class="form-group mb-30">
                          <label>Leads:</label><span class="leads_view"></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group mb-30">                                  
                        <div class="form-group mb-30">
                          <label>Feedback tool:</label><span class="feedbacktool_view"></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group mb-30">                                  
                        <div class="form-group mb-30">
                          <label>Tool Data:</label><span class="tooldata_view"></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group mb-30">                                  
                        <div class="form-group mb-30">
                          <label>Duration:</label><span class="duration_view"></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group mb-30">                                  
                        <div class="form-group mb-30">
                          <label>Start Date:</label><span class="startdate_view"></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group mb-30">                                  
                        <div class="form-group mb-30">
                          <label>End Date:</label><span class="enddate_view"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <h5>Tool Data Preview</h5>
                  <div style="height: 90%; width: 100%; background: #ccc;">
                </div>
              </div>
            </div>  
          </div>

          <div class="modal-footer align-center center">
            <center>
              <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="startCamp($('#edit_sn').val(), 'ended');">End Now</button>
            </center>
          </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
  <?php
  //Include page footer
  include_once './includes/footer.inc.php';
  ?>

  <!-- START IN-PAGE SRIPTS -->
  <script type="text/javascript">

     function startCamp(id, action) {
          // get the form data
          // there are many ways to get this data using jQuery (you can use the class or id also)
          var formData = {
              'id' : id,
              'submit' : 'submit',
              'action' : action         
          };
          
          // process the form
          $.ajax({
              type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
              url         : 'forms/form_startCampaign.php', // the url where we want to POST
              data        : formData, // our data object
              dataType    : 'json', // what type of data do we expect back from the server
              encode      : true
          })
          
          //using the done promise callback
          .done(function(data) { 
              if (data.status == "success") {    
                  //change displayed status to trashed
                  alert(data.message);
                  window.location="campaigns.php";
              }else if (data.status == "failed") {  
                      alert(data.message);
              }else{
                  alert("Error, Please try again Later1.");
              }
          })

          // using the fail promise callback
          .fail(function(data) {
              alert("Error, Please try again Later2.");                    
          });
     }


     function fetchtool(type, elementID){

      if(type=="-1"){
         const package= document.getElementById(elementID);
         var dataOptions=`<option value="">Select Data</option>`;
         package.innerHTML=dataOptions;
      }else{
          var formData = {
                'type': type      
            };
            
            // process the form
            $.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url         : 'forms/form_fetchtool.php', // the url where we want to POST
                data        : formData, // our data object
                dataType    : 'json', // what type of data do we expect back from the server
                encode      : true
            })
            
            //using the done promise callback
            .done(function(data) { 
                if (data.status == "1") {    
                    
                    //change displayed status to trashed
                    
                    const package= document.getElementById(elementID);
                    var dataOptions='';
                    var opt=data['data'];
                    if(opt==null){
                            dataOptions+=`<option value="">No ${type} data found.</option>`;
                    }else{
                      opt.forEach(opt => {
                            dataOptions+=`<option value="${opt['sn']}">${opt['title']}</option>`;
                        });
                    }
                        

                      package.innerHTML=dataOptions;

                }else{
                    alert("Fetch Error, Please try again Later1.");
                }
            })

            // using the fail promise callback
            .fail(function(data) {
                alert("Fetch Error, Please try again Later2.");                    
            });      
        }          
     }
      function edit_options(name_db, sn){
            $("#edit_sn").val(sn);         

            $('#id_edit_descr').val($('#descr_db'+sn).text().trim());
            $('#id_edit_duration').val($('#duration_db'+sn).text().trim());
            $('#id_edit_title').val($('#title_db'+sn).text().trim());
            $('#id_edit_goal').val($('#goal_db'+sn).text().trim());
            $('#id_edit_feedbackt').val($('#feedback_tool_db'+sn).html());
            $('#edit_tool_data1').val($('#feedback_data_db'+sn).html());

            $('#edit_title').text('Edit Campaign: '+name_db);
            $('#_pop_register').modal();
        }


        function view_options(name_db, sn){
            $("#edit_sn").val(sn);         

            $('.status_view').html($('#status_db'+sn).html());
            $('.feedbacktool_view').html($('#feedback_tool_db'+sn).text().trim());
            $('.title_view').html($('#title_db'+sn).text().trim());
            $('.duration_view').html($('#duration_db'+sn).text().trim());
            $('.title_view').html($('#title_db'+sn).text().trim());
            $('.leads_view').html($('#goal_db'+sn).text().trim());
            $('.feedbacktool_view').val($('#feedback_tool_db'+sn).html());
            $('.tooldata_view').val($('#feedback_data_db'+sn).html());
            $('.startdate_view').html($('#start_date_db'+sn).text().trim());
            $('.enddate_view').html($('#end_date_db'+sn).text().trim());
            $('#view_title').text('View Campaign: '+name_db);
            $('#_pop_view').modal();
        }



        function summary_options(name_db, sn){
            $("#edit_sn").val(sn);         


            $('.feedbacktool_view').html($('#feedback_tool_db'+sn).text().trim());
            $('.title_view').html($('#title_db'+sn).text().trim());
            $('.duration_view').html($('#duration_db'+sn).text().trim());
            $('.title_view').html($('#title_db'+sn).text().trim());
            $('.leads_view').html($('#goal_db'+sn).text().trim());
            $('.feedbacktool_view').val($('#feedback_tool_db'+sn).html());
            $('.tooldata_view').val($('#feedback_data_db'+sn).html());
            $('.startdate_view').html($('#start_date_db'+sn).text().trim());
            $('.enddate_view').html($('#end_date_db'+sn).text().trim());
            $('#summary_title').text('Summary Campaign: '+name_db);
            $('#_pop_summary').modal();
        }

        function ignore_contact(Filename, userSN){
            var trash_me = confirm("Are sure you want to move this details to inactive, this process is irreversible?");            
            if (trash_me == true) {
                 // Get and process the form     
                var form = $('#id_account_trash_form');

                form.serialize();
                    
                //set trash input
                //$("#id_trash_account").val(userID); 
                
                // get the form data
                // there are many ways to get this data using jQuery (you can use the class or id also)
                var formData = {
                    'trash_submit' : "Trash User contact",
                    'trash_id' : userSN,
                    'file_name': Filename,           
                };
                
                // process the form
                $.ajax({
                    type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                    url         : 'forms/form_trashCampaign.php', // the url where we want to POST
                    data        : formData, // our data object
                    dataType    : 'json', // what type of data do we expect back from the server
                    encode      : true
                })
                
                //using the done promise callback
                .done(function(data) { 
                    if (data.status == "success") {    
                        var status_html = `
                            <label class="label label-danger" style="font-size: 0.9em;" id="id_status{userSN}" >
                                TRASHED
                            </label> 
                        `;

                        //change displayed status to trashed
                        window.location="campaigns.php";
                        $('#id_status_trash'+userSN).html(status_html);
                        $('#action_'+userSN).html('');
                        alert("Trash Action Completed Successfully!");
                    }else{
                        alert("Trash Error, Please try again Later1.");
                    }
                })

                // using the fail promise callback
                .fail(function(data) {
                    alert("Trash Error, Please try again Later2.");                    
                });                
            }           
        }
  </script>
  <!-- END IN-PAGE SRIPTS -->

</body>
</html>
