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
  
  if ( isset($_GET['vkey']) ) {
    $vkey = $_GET['vkey'];
  }
 
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reset Password</title>

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
      <p class="login-box-msg">Reset Your Password</p>

      <form id="reset-password-form" action="#" method="post" role="form" >
        <!-- Alert Boxes -->
           

          <div class="" id="success_message"></div>
          <input type="hidden" name="vkey" id="vkey" value=<?php echo $vkey ?>>
        <div class="input-group mb-3">
          <input id="id_password" name="password" type="password" class="form-control" placeholder="Enter New Password" required="">
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
             <!--  -->
          </div>
          <!-- /.col -->
          <div class="col-4">
            <input type="hidden" name="register_submit">
            <button id="id_reset_password_submit" name="reset_password" type="submit" class="btn btn-primary btn-block"><span>Reset Password</span><span><i class="loading-spinner fa fa-spinner"></i></span></button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!--
      <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>
      -->
      <!-- <a href="login.php" class="text-center">I already have a membership</a> -->
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
    $("#reset-password-form").submit(function(event) {
      /* stop form from submitting normally */
      event.preventDefault();
      // $("#id_register_submit").html('<i class="fa fa-spinner"> </i>');
      $('.loading-spinner').toggleClass('active');
      var data = {
        'vkey':$('#vkey').val(),
        'password':$('#id_password').val(),
        'password2':$('#id_password2').val(),
        'reset_password':''
      }
      $.ajax({
        url: 'forms/form_reset_password.php',
        type: 'post',
        data: data,
        success: function(response){
            if(response.status==0){
                // $('#success_message').addClass('alert alert-warning').css("display" ,"block")
                $('#success_message').html(
                '<div class="alert alert-danger alert-dismissible">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                    '<h5><i class="icon fas fa-ban"></i>Password Error!</h5>' +response.message+
                '</div>'
                );
                // $('#success_message').text(response.message) 
                $('.loading-spinner').toggleClass('active');
                $('#id_reset_password_submit')[0].reset();
                console.log(response)
            
            } else if(response.status==1){            
             window.location='login.php?reset=password_reset'; 
            }
            
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
