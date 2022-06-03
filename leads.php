<?php
  //set page type
  $page_type = "members_only"; //variable includes: all_users , members_only, visitors_only

  //setting directory level
  $dir_level = 0;

  $page_title = "Leads"; 
  $active_page = "leads";

  //include variables
  include_once './includes/variables.inc.php';

  //Include page header
  include_once './includes/header.inc.php';

  //Include database connection file
  include_once('./includes/dbConnection.php');
  //collecting values to be utilised in page
  $id=$_SESSION['victor_work_username'];

   //collecting page variables
   if (isset($_GET['status'])){
    $status = $_GET['status'];
  }

// pagination code
 
$page_name = "leads"; //the name of this page without the dot and extension 
$tbl_name = "leads"; //the name of the table in the db that we are loading the page table content from
$primary_search_column = "full_name"; //the name of the column in the table which we are primarily matching search string against
$search_part_query = ""; //inclusion of one or more secondary search column e.g. OR column2 LIKE '%".$search_string."%' 
$compulsory_part_query = "user_id = '$id' AND status !='trashed'";
 
  include_once './includes/pagination.inc.php';
  // include_once './includes/page.php';

?>

<!--START IN-PAGE STYLES -->

<!--END IN-PAGE STYLES -->
<style>
    .loading-spinner {
	    display: none;
    }

    .loading-spinner.active {
	    display: inline-block;  
    }
   #myfont{
     margin: 5px ;
   }
   .pager-nav {
    margin: 16px 0;
  }
  .pager-nav span {
      display: inline-block;
      padding: 4px 8px;
      margin: 1px;
      cursor: pointer;
      font-size: 14px;
      background-color: #FFFFFF;
      border: 1px solid #e1e1e1;
      border-radius: 3px;
      box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
  }
  .pager-nav span:hover,
  .pager-nav .pg-selected {
      background-color: #f9f9f9;
      border: 1px solid #CCCCCC;
  }
  </style>
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
            <h1 class="m-0">Leads Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Leads Management</li>
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
            <!-- import alert -->
             
            <!-- Alert Boxes -->
            <div id="lead_message"></div>
             
           
            <div class="card">
              <div class="card-header">
                <div class="row">
                <div class="col-sm-12 col-md-10"> 
                <form name="control-form" id="control-form" method="get" action="">
                  <div class="row">                  
                    <div class="col-sm-12 col-md-6">                      
                      <h3 class="card-title">
                        <button type="button" title="Create New Lead" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#id_new_lead"><i class="fa fa-plus"></i> <b>New</b></button>                 
                        &nbsp; All Leads
                      </h3>
                    </div>
                    
                    <?php
                      //condition to ensure table head is not displayed when no result is found
                        if ($total_rows > 0) { 
                    ?>

                    <div class="col-sm-12 col-md-6">
                      <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="input-group input-group-sm">
                          <select class="form-control" name="items_per_page" id="leads_per_page" onchange="this.form.submit()" title="Number of leads that should be on page at a time..">
                              <option <?php echo $show10;?> value="10">Show 10</option>
                              <option <?php echo $show25;?> value="25">Show 25</option>
                              <option <?php echo $show50;?> value="50">Show 50</option>
                              <option <?php echo $show100;?> value="100">Show 100</option>
                          </select> &nbsp;&nbsp;
                          <select class="form-control" name="sort_order" id="id_sort_order" onchange="this.form.submit()" title="To arrange sorted leads in ascending or descending order as selected.">                            
                              <option <?php echo $asc_sort;?> value="asc">A-Z</option>
                              <option <?php echo $desc_sort;?> value="desc">Z-A</option>
                          </select> &nbsp;&nbsp;
                        
                        
                          <input name="search" type="search" class="form-control" placeholder="keyword here..." <?php echo $search_opt; ?> >
                          <span class="input-group-append">
                            <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search" title="Search"></i></button>
                          </span>
                        </div>

                      </div>
                    </div>  
                    
                    <?php
                        }
                        
                    ?>
                  </div>
                </form>
                </div>
                <div class="col-sm-12 col-md-2"> 
                
                <form id="export" action="#">
                  <input type="hidden"  id="user_id" name="user_id" value="<?php echo $_SESSION['victor_work_username']?>">
                  <a name="submit_export" id="myfont" title="Export Lead"  class="btn btn-success btn-sm float-right submit" ><i class="fa fa-file-download  fa-lg"></i></a>
                </form>

                <button type="button" id="myfont" title="Import Lead" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#import_lead"><i class="fa fa-file-upload fa-lg"></i></button>
                
                
                <!-- form for multiple selection -->
                <form method="post" id="multiple_select" action="#">
                <!-- <button id="mycheck" type="submit" title="Trash Selected Leads" onclick="confirm('<?php echo 'Are you sure you want to trash the lead:' .$_SESSION['victor_work_username'].'? This process is irreversible...'?>')"  href="#" class="btn btn-danger   btn-sm" name="save" style="float:right; margin: 7px 5px; "><i class="fa fa-trash"></i></button> -->
                <button id="mycheck" type="submit" title="Trash Selected Leads"   href="#" class="btn btn-danger   btn-sm" name="save" style="float:right; margin: 5px; "><i class="fa fa-trash"></i></button>
                  </div>
                      </div>
                <div class="card-body p-0 table-responsive">
                 
                <table class="table table-striped" id="pager">
                
                  <thead>
                    <?php
                        //condition to ensure message is displayed accurately when no result is found
                        if ($total_rows <= 0) {
                          $start = -1;
                        }
                        
                        //condition to ensure table head is not displayed when no result is found
                          if ($total_rows > 0) {
                    ?><!-- submit multiple selection -->
                   
                       
                    <div class="action">

                    </div>
                   
                    <tr>
                     <th width="10%"><input type="checkbox" id="checkAl">
                     SN</th>
                      <th>Personal Data</th> 
                      <th style="text-align: center;">Contact Info</th>                      
                      <th style="text-align: center;">Address</th>
                      <th style="text-align: center;">Lead Acquisition</th>
                      <th style="text-align: center;">Date Added</th>
                      <th style="width:20%;">Actions </th>
                      
                    </tr>
                     
                    <?php
                        }
                      ?>
                  </thead>

                  <tbody>
                    <?php

                    //displaying search results                     
                    // $count = $start;
                    // $phone_db = "";

                    if($get_query_item){
                        $rows_search = $get_query_item->num_rows;
                        if ($rows_search > 0){ 

                      $id = $_SESSION['victor_work_username'];
                       
                      
                      $sn = $start;
                      // $sn = 0;
                      while ($row=mysqli_fetch_assoc($get_query_item )) {
                       $sn++;
                    ?>
                    <div style="display:none">
                        <h5>data for edit section</h5>
                        <span id="name_db<?php echo $row['sn'] ?>"> <?php echo $row['full_name'] ?> </span>
                        <span id="gender_db<?php echo $row['sn'] ?>"> <?php echo $row['gender'] ?> </span>
                        <span id="agegroup_db<?php echo $row['sn'] ?>"> <?php echo $row['agegroup'] ?> </span>
                        <span id="phone_db<?php echo $row['sn'] ?>"> <?php echo $row['phone_number'] ?> </span>
                        <span id="email_db<?php echo $row['sn'] ?>"> <?php echo $row['email'] ?> </span>
                        <span id="state_db<?php echo $row['sn'] ?>"> <?php echo $row['state'] ?> </span>
                        <span id="country_db<?php echo $row['sn'] ?>"> <?php echo $row['country'] ?> </span>
                    </div>
                      
                    <tr>
                       <td style="vertical-align: middle;"><input type="checkbox" id="checkItem" name="check[]" value="<?php echo $row["sn"]; ?>" >
                </form>
                      <?php echo $sn ?>.</td>
                      <td><?php echo $row['full_name'].' <br/> '.$row['gender'].' , Aged '.$row['agegroup']?></td>
                      <td style="text-align: center;"><?php echo $row['phone_number'].' <br/> '.$row['email'] ?></td>
                      <td style="text-align: center;"><?php echo $row['state'].' <br/>'.$row['country'] ?></span> </td>
                      <td style="text-align: center;"><a href="#<?php echo $row['lead_tool_id'] ?>"> <?php echo $row['lead_tool_type'] ?></a> <i>in</i><br/><a href="#<?php echo $row['campaign_id'] ?>"> <?php echo $row['campaign'] ?></a></td>
                      <td style="text-align: center;"> <?php echo $row['date_created'] ?></td>
                      <td>
                        <?php 
                          if ($row['status'] != 'trashed') {
                            echo 
                            ' <button type="button" class="btn btn-info btn-sm" onclick="edit_options('."'".$row['full_name']."','".$row['sn']."')".'"><i class="fa fa-pen" title="Edit"></i></button>
                              <button type="button" class="btn btn-secondary btn-sm" onclick="view_options('."'".$row['full_name']."','".$row['sn']."')".'"><i class="fa fa-eye" title="View"></i></button>
                              <span id="id_status_trash'.$row['sn'].'" class="btn btn-danger btn-sm " title="Trash" onclick="trash_lead(\''.$row['full_name'].'\', \''.$row['sn'].'\')" ><i class="fa fa-trash fa-lg"></i></span>
                            
                              ';
                          }else { 
                            echo '<span class="btn btn-danger btn-sm">Trashed</span>';
                          } 
                        ?> 
                        
                        <!--  -->
                        
                      </td>
                      
                    </tr>

                    <?php  
                          }                                    
                        }else{
                          echo '<script>document.getElementById("mycheck").style.display = "none"; document.getElementById("export").style.display = "none";</script>';
                         
                                   //echo "NO RESULT(S)!!!<br/>";
                      ?>
                      
                       <!-- Print out each item's details -->
                          <span class="col-sx-12 col-sm-12">
                              <div style="text-align: center;">
                                  No results were found.<!-- for this search string.<br/>
                                  would you like to search for "xxx" or "YYY" instead to stand a better chance?<br/>
                                  You can also click on any of the following Synonyms matching "xxxx"<br/> 
                                  OR Kindly Request for the exact user <a href="#">here</a>-->
                              </div>
                          </span>
                          <?php
                        }
                          }else{
                              echo "QUERY ERROR!!!<br/>".$sql;
                          }
                          ?>
                  </tbody>
                </table>
                  <!-- PAGINATION HERE -->
                  <?php
                      $start_pagination = '
                      <hr/>
                        <div class="row">
                        <div class="col-sm-5 col-md-5">
                          &nbsp;
                        </div>
                        <div class="col-sm-7 col-md-7">
                          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                            <ul class="pagination">
                                              ';              
                      if (!empty($pagination)){
                          echo $start_pagination.$pagination;                 
                      }else{
                          ;
                      }
                  ?> 
                 
              </div>
               
              
            </div>
          </div>
          <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
</div>
  <!-- /.content-wrapper -->

<!-- Modal to view lead -->
<div class="modal fade" id="_pop_view">
    <div class="modal-dialog  ">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="view_title">View Leads</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body"> 
            <div class="row">
              <div class="col-sm-6">
                <div id="form_content">
                  <!--  <p>&nbsp;&nbsp;&nbsp;<b> <u>Edit Site Details</u> </b></p> -->

                    <div class="col-sm-12">
                      <div class="form-group mb-30">
                        <label>Full Name:</label><span class="name_view"></span>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group mb-30">
                        <label>Gender:</label><span class="gender_view"></span>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group mb-30">                                  
                        <div class="form-group mb-30">
                          <label>Age Group:</label><span class="age_view"></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group mb-30">                                  
                        <div class="form-group mb-30">
                          <label>Email Address:</label><span class="email_view"></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group mb-30">                                  
                        <div class="form-group mb-30">
                          <label>Phone Number :</label><span class="phone_view"></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group mb-30">                                  
                        <div class="form-group mb-30">
                          <label>State:</label><span class="state_view"></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group mb-30">                                  
                        <div class="form-group mb-30">
                          <label>Country:</label><span class="country_view"></span>
                        </div>
                      </div>
                    </div>
                     
                  </div>
              </div>
               
            </div>  
          </div>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<!-- ./Modal -->




  <!-- Modal to add new lead -->
  <!-- Modal to add new lead -->
  <div class="modal fade" id="id_new_lead">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add New Lead</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="lead_create_message_error" ></div>
        <form action="#" method="post" id="crud_form" role="form">
          <input name="user_id" id="id_user_id" type="text" value="<?php echo $_SESSION['victor_work_username'];?>" hidden>
          <div class="modal-body"> 
            <div class="form-group">
              <label>Full Name</label>
              <input name="full_name" id="id_full_name" type="text" class="form-control" placeholder="Enter Full Name..." required>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">                      
                  <label>Gender </label>                  
                  <select name="gender" id="id_gender" class="form-control">
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>                      
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Age Group </label>                  
                  <select name="agegroup" id="id_agegroup" class="form-control">
                    <option value="<15">Select Age group</option>
                    <option value="15-24"> 15-24 (Youth)</option>
                    <option value="25-64"> 25 - 64 (Adult)</option>
                    <option value="64+"> 64+ (Seniors)</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">                      
                <label>Phone Number</label>
                <input name="phone" id="id_phone" type="text" class="form-control" placeholder="E.g. +2348012345678" required>               
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                <label>Email Address</label>
                <input name="email" id="id_email" type="email" class="form-control" placeholder="Enter your email..." required>  
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">  
                                     
                <label>Select Country</label>
                 
                <select id="countryId" name="country" class="form-control  countries"  >
                <option value="">Select Country</option>
                   
                </select>  
                <!-- <input name="state" id="stateId" type="text" class="form-control states" placeholder="Enter your State/Province/Region..." required>                -->
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                <label>State/Province/Region</label>
                 
                <select name="state" id="stateId" class="form-control states"  >
                <option value="">Select State</option>
                </select>  
                 </div>
              </div>
            </div>      
          </div>

          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button name="new_lead_submit" id="id_new_lead_submit" type="submit" class="btn btn-primary"><span>Add Lead</span><span><i class="loading-spinner fa fa-spinner"></i></span></button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Edit Modal -->
  <div class="modal fade" id="id_edit_lead" tabindex="1" role="dialog" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="edit_title">Edit Lead</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="lead_edit_message_error"></div>
        <form action="#" method="post" id="crud_form" role="form">
          <input name="user_id" id="id_user_id" type="text" value="<?php echo $_SESSION['victor_work_username'];?>" hidden>
          
          <div class="modal-body"> 
            <div class="form-group">
              <label>Full Name</label>
              <input name="full_name" id="id_edit_name" type="text" class="form-control" placeholder="Enter Full Name..." required>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">                      
                  <label>Gender </label> 
                                   
                  <select name="gender" id="id_edit_gender" class="form-control">
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>                      
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Age Group </label>                  
                  <select name="agegroup" id="id_edit_agegroup" class="form-control"  required>
                    <option value="<15">Select Age group</option>
                    <option value="15-24"> 15-24 (Youth)</option>
                    <option value="25-64"> 25 - 64 (Adult)</option>
                    <option value="64+"> 64+ (Seniors)</option>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">                      
                <label>Phone Number</label>
                <input name="phone" id="id_edit_phone" type="text" class="form-control" placeholder="E.g. +2348012345678" required>            
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                <label>Email Address</label>
                <input name="email" id="id_edit_email" type="email" class="form-control" placeholder="Enter your email..." required>  
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">  
                                     
                <label>Select Country</label>
                 
                <select id="country_Id" name="country" class="form-control  countries" required >
                <option value="">Select Country</option>
                </select>  
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                <label>State/Province/Region</label>
                 
                <select name="state" id="state_Id" class="form-control states" required>
                <option value="">Select State</option>
                </select>  
                 </div>
              </div>
            </div>    
          </div>

          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="hidden" id="edit_sn" name="edit_sn">
            <button name="edit_lead_submit" id="id_edit_lead_submit" type="submit" class="btn btn-primary"><span>Save Changes</span><span><i class="loading-spinner fa fa-spinner"></i></span></button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
      <!-- /.modal-dialog -->
    </div>

     <!-- import leads  -->
  <div class="modal fade" id="import_lead" tabindex="1" role="dialog" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="edit_title">Import Lead</h4>
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="lead_message_error" ></div>
        <form method="POST" id="import_new_lead" action="#" enctype="multipart/form-data">
        <input name="user_id" id="id_user_id" type="text" value="<?php echo $_SESSION['victor_work_username'];?>" hidden>
          <div class="modal-body"> 
            <div class="form-group">
              <label>Import Lead<small style="color:#696969;font-size:15px;">(Choose a csv file. File must not be more than 2mb)</small></label> <br> <a href="dist/csvFile/example.csv" download>Click here to download format</a>
              <input type="file" id="file" name="file" class="form-control" required>
            </div>
            <div class="form-group">
              <input  type="hidden" name="import" id="">
              <button type="submit" name="import1" id="import" class="btn btn-success"><span>Import Lead</span><span><i class="loading-spinner fa fa-spinner"></i></span></button>
            </div>
            </div>
      </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
      <!--./  -->
  <!-- Form creation for trashing a lead -->
  <form action="#" method="post" id="id_lead_trash_form" role="form">
    <input type="hidden" name="trash_id" id="id_trash_lead" value="">
  </form>

  <?php
  //Include page footer
  include_once './includes/footer.inc.php';
  ?>

  <!-- START IN-PAGE SRIPTS -->

  <!-- GET COUNTRIES AND CORRESPONDING STATES -->
  <script type="text/javascript" src="dist/js/includes_js/location.js"></script>

  <!--  JS TO CREATE AND EDIT LEADS-->
  <script type="text/javascript" src="dist/js/includes_js/new_edit_leads.js"></script>
  <!-- MULTIPLE/GROUP  ACTION (DELETE) SCRIPT -->
  <script type="text/javascript" src="dist/js/includes_js/multiple_action.js"></script>

  <script type="text/javascript">
    // View Option
        
 
    function view_options(name_db, sn){
       
      $('.name_view').html($( '#name_db'+sn).text().trim());
      $('.gender_view').html($( '#gender_db'+sn).text().trim());
      $('.age_view').html($( '#agegroup_db'+sn).text().trim());
      $('.email_view').html($( '#email_db'+sn).text().trim());
      $('.state_view').html($( '#state_db'+sn).text().trim());
      $('.country_view').html( $('#country_db'+sn).text().trim());
      $('.phone_view').html($( '#phone_db'+sn).text().trim());
      // $('#view_title').text( 'View Leads: '+sn);
      $('#_pop_view').modal();
    }


    // edit option
    function edit_options(name_db, sn){
      $("#edit_sn").val(sn);         

      $('#id_edit_gender').val($('#gender_db'+sn).text().trim());
      $('#id_edit_agegroup').val($('#agegroup_db'+sn).text().trim());
      $('#id_edit_name').val($('#name_db'+sn).text().trim());
      $('#id_edit_phone').val($('#phone_db'+sn).text().trim());
      $('#id_edit_email').val($('#email_db'+sn).html());
      $('#state_Id').val($('#state_db'+sn).text().trim());
      $('#country_Id').val($('#country_db'+sn).text().trim());

      $('#edit_title').text('Edit Lead: '+name_db);
      $('#id_edit_lead').modal();
    }

    // lead trash
    function trash_lead(lead_name, leadSN){
      var trash_me = confirm("Are you sure you want trash the lead: "+lead_name+"? this process is irreversible...");            
      if (trash_me == true) {
            // Get and process the form     
        var form = $('#id_lead_trash_form');

        form.serialize();
            
        //set trash input
        $("#id_trash_lead").val(leadSN); 
        
        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'trash_submit' : "trash lead",
            'trash_id' : leadSN            
        };
            
        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'forms/form_trash_lead.php', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
        })

        //using the done promise callback
        .done(function(data) { 
            if (data.status == "success") {    
                var status_html = `
                    <label class="label label-danger" style="font-size: 0.9em;" id="id_status{leadSN}" >
                        TRASHED
                    </label> 
                `;

                //change displayed status to trashed
                window.location="leads.php";
                $('#id_status_trash'+leadSN).html(status_html);
                $('#action_'+leadSN).html('');
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
    //  LEAD EXPORT SCRIPT
 
 



 
    // $("#checkAl").click(function () {
    //      $('input[type="checkbox"]').click(function(){
    //         if($(this).is(":checked")){
    //           // $( "mycheck" ).prop( "disabled", false );
    //           $('#multiple_select :input').prop("disabled",false);
    //           console.log('checked')
    //         }
    //         else if($(this).is(":not(:checked)")){
    //           // $('#multiple_select :input').prop("disabled",true);
    //           console.log('unckechecked')
    //         }
    //     });
   
    //   });

    $('#multiple_select').on('click','#mycheck',function(e){
    e.preventDefault();
    // var trash_me = confirm("Are sure you want to move this details to inactive, this process is irreversible?");            
    if($('input:checkbox').not(this).prop('checked', this.checked) ){ 
      var trash_me = confirm("Are sure you want to move this details to inactive, this process is irreversible?");            
     
      if (trash_me == true) {
        $('.loading-spinner').toggleClass('active');
        var form=$('#multiple_select').serialize();
        console.log(form);
        $.ajax({
          url: 'forms/form_multiple_action.php',
          type: 'POST',
          data: form,
          success: function(data){
            
            if(data.status=='success'){
              console.log(data);
              alert('Trashed Successfully!')
              window.location="leads.php";
              }else{
              console.log(data);
              alert('An Error Occured, Please Try Again')
            }   
          },
          fail: function(rp){
            alert(rp);
          }
        });
      } 
    }else{
      alert('select leads to trash')
    }
  });

 

</script>
<script src="dist/js/includes_js/import_export_leads.js"></script>
  <!-- END IN-PAGE SRIPTS -->

</body>
</html>
