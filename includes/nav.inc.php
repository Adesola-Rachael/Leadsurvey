<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- acction Activation --> 
    <?php
    $id = $_SESSION['victor_work_username'];
    $query_activate_account = "SELECT * FROM user_auth WHERE user_name='$id' ";  
    $result_activate_account = $conn->query($query_activate_account);
    if($result_activate_account){//if query was executed successfully
      $row = mysqli_fetch_array($result_activate_account);
      $verify_db = $row['verifircation_status'];
      $email = $row['email'];
      $vkey = $row['verification_id'];
      $username = $row['user_name'];

      if($verify_db==0){
        echo 
        '<ul class="navbar-nav">
          <li class="nav-item">
          <button data-toggle="modal" href="#activate_account" class="btn btn-warning active" data-backdrop="false">Activate Account</button>
          <div class="modal fade" id="activate_account">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"></h4>
                  </div>
                  <div class="activateMyAccount">
                    <div id="activate_message"></div>
                   
                  </div>
                  <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                  </div>
                </div>
              </div>
          </div>

    
          </li>
          </ul>
          
          
          
          ';
      }
      
    }
    
 ?>
    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="profile.php" role="button">
          <i class="fas fa-user-circle"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php" role="button">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->


  <!-- Modal for confirm and delete author -->
  
<!-- End of modal for confirm nad delete author -->
<div id="#" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Modal header</h3>
  </div>
  <div class="modal-body">
    <p>One fine ody…</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary">Save changes</button>
  </div>
</div>

<a class="btn" data-target="#myModel" role="button" data-toggle="modal">Launch demo modal</a>