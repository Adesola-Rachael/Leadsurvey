<?php
  session_start();
  
  //checking if user is logged in and acting accordingly
  if(isset($_SESSION['victor_work_username']) && $_SESSION['victor_work_username'] != ""){
    header('Location: dashboard.php'); // Redirecting To Home Page    
	}

  //Include database connection file
  include_once('includes/dbConnection.php');

  //getting current year
  $current_date = date("Y-m-d");
  $current_year = substr($current_date, 0, 4);

  if (isset($_GET['status'])) {
    $reg_status = $_GET['status'];
  }else{
    $reg_status = "";
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  <style>
    .loading-spinner {
	    display: none;
    }

    .loading-spinner.active {
	    display: inline-block;  
    }
    

  </style>
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="index.php"><b>Victor</b>Work</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form id="register-form" action="#" method="post" role="form" >
        <!-- Alert Boxes -->
        <div class="" id="success_message"></div>
        <div class="input-group mb-3">
          <input id="id_full_name" name="full_name" type="text" class="form-control" placeholder="Full name" required=""
           
          >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input id="id_email" name="email"  type="email" class="form-control" placeholder="Email" required=""
           >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <hr/>
        <div class="input-group mb-3">
          <input id="id_user_name" name="user_name" type="text" class="form-control" placeholder="User name" required=""
           >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input id="id_password" name="password" type="password" class="form-control" placeholder="Password" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input id="id_password2" name="password2" type="password" class="form-control" placeholder="Retype password" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input id="id_tnc" name="tnc" type="checkbox" value="agree" required="">
              <label for="id_tnc">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <input type="hidden" name="register_submit">
            <button id="id_register_submit" name="register_submit" type="submit" class="btn btn-primary btn-block"><span>Register</span><span><i class="loading-spinner fa fa-spinner"></i></span></button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <a href="login.php" class="text-center">Go To Login</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
  <br/>
</div>
<!-- /.register-box -->
All Rights Reserved &copy; <?php echo $current_year; ?>, Victor work. 

<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
</body>
<?php
  //clearing session variables
  $_SESSION["reg_error_msg"] = "";
  $_SESSION["reg_user_name"] = "";
  $_SESSION["reg_email"] = "";
?>

<!-- START IN-PAGE SRIPTS -->
<script type="text/javascript">
  $(document).ready(function () {

    /* attach a submit handler to the form */
    $("#register-form").submit(function(event) {
      /* stop form from submitting normally */
      event.preventDefault();
      // $("#id_register_submit").html('<i class="fa fa-spinner"> </i>');
      $('.loading-spinner').toggleClass('active');
      var data = {
        'full_name':$('#id_full_name').val(),
        'email':$('#id_email').val(),
        'user_name':$('#id_user_name').val(),
        'password':$('#id_password').val(),
        'password2':$('#id_password2').val(),
        'tnc':$('#id_tnc').val(),
        'register_submit':''
      }
      $.ajax({
        url: 'forms/form_register.php',
        type: 'post',
        data: data,
        success: function(response){
          if(response.status==0){
            // $('#success_message').addClass('alert alert-warning').css("display" ,"block")
            $('#success_message').html(
              '<div class="alert alert-danger alert-dismissible">'+
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                  '<h5><i class="icon fas fa-ban"></i>Registration Error!</h5>' +response.message+
              '</div>'
            );
            // $('#success_message').text(response.message) 
            $('.loading-spinner').toggleClass('active');
            console.log(response)
            
          }else if(response.status==1){
            // $('#success_message').html(
            //   '<div class="alert alert-success alert-dismissible">'+
            //     '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
            //       '<h5><i class="icon fas fa-ban"></i>Account Created  Successfully!</h5>' +response.message+
            //   '</div>'
            // );

            // $('.loading-spinner').toggleClass('active');
            // $('#register-form')[0].reset();
            
            window.location='login.php?status=newuser&mail_status='+response.mail_status;
            
          }
          // else if(response.status==1 && response.mail_status=='not-sent'){
             
          // } 
        },
        fail: function(rp){
        alert(rp);
        }
      });
    });
    
  });
</script>
<!-- END IN-PAGE SRIPTS -->

</html>
