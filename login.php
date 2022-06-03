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

  $user_status = "";
  $reset_msg = "";
  $activate_msg="";
  $mail_status = "";
  $login_err_msg = "";
   $alert_title = "Registration Successful!";
  $alert_activate_account = "A verification link has been sent to your e-mail, kindly check your e-mail and verify your account.";
  $alert_msg = "Login Below";
  $reset_msg_details="Your Have Successfully Reset Your Password";
  $activate_msg_details="Your Account Is Successfully Activated";


  if (isset($_GET['status']) && !empty($_GET['status'])) {
      $user_status = $_GET['status'];

      // Handle mail sending alert
      if (isset($_GET['mail_status'])) {
          $mail_status = $_GET['mail_status'];

          if($mail_status == "sent"){       
            //In order to login, you need to click the ACTIVATION LINK sent to your email.     
            $alert_msg = "Login Below.";
          }elseif($mail_status == "Not-sent"){
            //Activation Email was Not sent. Please click "Resend Link" below at a later time to get the link.
            $alert_msg = "Login Below.";
          }
      }
      // Handle password alert
    //   if (isset($_GET['reset'])) {
    //     $reset_msg  = $_GET['reset'];

    //     if($mail_status == "password_reset"){       
    //       //In order to login, you need to click the ACTIVATION LINK sent to your email.     
    //       $alert_msg = "Your Password is updated, you can now login.";
    //     }
    // }
      // elseif(isset($_GET[])){

      // }

      if($user_status == "registered"){
        $alert_title = "Welcome Back!";
      }

      if (isset($_GET['login_err_msg'])) {
          $login_err_msg = $_GET['login_err_msg'];
      } 
       
  }
  // reset password message
  if (isset($_GET['reset']) && !empty($_GET['reset'])) {
    $reset_msg = $_GET['reset'];

      if($reset_msg == "password_reset"){
        $alert_title = "Welcome Back!";
      }
  }
// Activate Account Message
if (isset($_GET['login_activate']) && !empty($_GET['login_activate'])) {
  $activate_msg = $_GET['login_activate'];

    if($activate_msg == "AccountActivated"){
      $alert_title = "Welcome Back!";
    }
}
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in</title>

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

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="index.php"><b>Victor</b>Work</a>
    </div>
      <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form id="login-form" action="forms/form_login.php" method="post" role="form" >
        
          <!-- Good Alert -->
           

          <?php
            if ($reset_msg == "password_reset") {
          ?>
              <div class="alert alert-success alert-dismissible" id="success_reg"> 
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> <?php echo $reset_msg_details; ?></h5>
                <?php echo $alert_msg; ?>
              </div>
          <?php 
            }
          ?> 
          <?php
            if ($activate_msg == "AccountActivated") {
          ?>
              <div class="alert alert-success alert-dismissible" id="success_reg"> 
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> <?php echo $activate_msg_details; ?></h5>
                <?php echo $alert_msg; ?>
              </div>
          <?php 
            }
          ?> 
          <?php
            if ($user_status == "newuser" || $user_status == "registered") {
          ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> <?php echo $alert_title; ?></h5>
                <p><?php echo $alert_activate_account; ?></p>
                <?php echo $alert_msg; ?>
              </div>
          <?php 
            }
          ?>   
          
          <!-- Bad Alert -->
          <div class="" id="success_message"></div>


          <!-- Activation Alert -->
           

          <div class="input-group mb-3">
            <input id="id_user_name" name="user_name" type="text" class="form-control user_name" placeholder="Email/Username" required=""
            value="<?php if(isset($_SESSION["login_user_name"]) && isset($_SESSION["login_user_name"]) != ""){echo $_SESSION["login_user_name"];} ?>"
            >
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
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
          <div class="row">
            <div class="col-8">
               
            </div>
              <!-- /.col -->
            <div class="col-4">
              <input type="hidden" name="login_submit">
              <button id="id_login_submit" name="login_submit" type="submit" class="btn btn-primary btn-block"><span>Log In</span><span><i class="loading-spinner fa fa-spinner"></i></span></button>
            </div>
              <!-- /.col -->
          </div>
        </form>

        <!-- <div class="social-auth-links text-center mb-3">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
          </a>
        </div> -->
        <!-- /.social-auth-links -->

        <p class="mb-1">
          <a href="#" id="forgot_pass">Forgot Password</a>
        </p>
        <p class="mb-0">
          <a href="register.php" class="text-center">Create an Account</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
    <br/>
  </div>
<!-- /.login-box -->

All Rights Reserved &copy; <?php echo $current_year; ?>, Leads Gen

<!-- Modal To Get User E-mail Before Sending Reset Password Link-->
<div class="modal fade" id="forgot_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-group" id="getEmailForm" action="#" method="post" role="form" >
        <div class="modal-body" id="email_modal">
          <div id="myhide" >     
          <label for="Email">Email</label>
          <input class="form-control" type="email" name="email" id="email" placeholder="Enter The Email You Registered With" value="" required="required">  
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="forgot_pass"  class="btn btn-primary forgot_pass"><span>Submit</span><span><i class="loading-spinner fa fa-spinner"></i></span></button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Close -->
<!-- Modal To return Message If User Exists Or Not -->
<div class="modal fade" id="user_message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="display_user_message"></div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Close -->



<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
</body>
<script>
  $(document).ready(function () {
    $("#login-form").submit(function(event) {
      event.preventDefault();
    var validate = $('.user_name').val();
    var check_email=/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if((check_email.test(validate)) ){
      // console.log('it is an email');
      $('#myhide').hide();
      $('#email_modal').html(
          '<label for="Email">Email</label>'+
          '<input class="form-control" type="email" name="email" id="email" placeholder="Enter The Email You Registered With" value="'+validate+'" required="required">'
      );
    }else{
      $('#myhide').hide();
      $('#email_modal').html(
       '<label for="Email">Email</label>'+
        '<input class="form-control" type="email" name="email" id="email" placeholder="Enter The Email You Registered With" value="  " required="required">'
      );
    }
    // console.log(validate);
    });
    /* attach a submit handler to the form */
    $("#login-form").submit(function(event) {
      /* stop form from submitting normally */
      event.preventDefault();
      // $("#id_register_submit").html('<i class="fa fa-spinner"> </i>');
      $('.loading-spinner').toggleClass('active');
      var data = {
        'user_name':$('#id_user_name').val(),
        'password':$('#id_password').val(),
        'login_submit':''
      }
      $.ajax({
        url: 'forms/form_login.php',
        type: 'post',
        data: data,
        success: function(response){
          if(response.status==0){
            $('#success_reg').hide();
            $('#success_message').addClass('').css("display" ,"block")
            $('#success_message').html(
              '<div class="alert alert-danger alert-dismissible">'+
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                  '<h5><i class="icon fas fa-ban"></i>Login Error!</h5>' +response.message+ 
              '</div>'
            );
            // $('#email_modal').html(
            //   '<input class="form-control" type="email" name="email" id="email" placeholder="Email" value="'+response.email+'" required="required">'
            // );
            // // $('#success_message').text(response.message) 
            $('.loading-spinner').toggleClass('active');
            // $('#login-form')[0].reset();
            // console.log(response);
            
            
          }else if(response.status=='Activation Error'){
            $('#success_reg').hide();
            $('#success_message').addClass('').css("display" ,"block")
            $('#success_message').html(
              '<div class="alert alert-warning alert-dismissible">'+
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                  '<h5><i class="icon fas fa-ban"></i>Account Not Activated!</h5>' +response.message+ 
                  '<form id=resend_link >'+
                  '<input type="hidden" name="email" id="email" value="'+response.data.email+'">'+
                  '<input type="hidden" name="vkey" id="vkey" value="'+response.data.vkey+'">'+
                  '<span></span><a name="submit" id="submit" class="resend" style="text-decoration:none;cursor:pointer;">Resend Link</a>'+
                  '</form>'+
 
              '</div>'
            );
            // $('#email_modal').html(
            //   '<input class="form-control" type="email" name="email" id="email" placeholder="Email" value="'+response.email+'" required="required">'
            // );
            // // $('#success_message').text(response.message) 
            $('.loading-spinner').toggleClass('active');
            // $('#login-form')[0].reset();
            // console.log(response);
          }else if(response.status==1){
            // console.log(response);
            window.location='dashboard.php';
          }
          
        },
        fail: function(rp){
        alert(rp);
        }
      });
    });
  });

  //  RESEND LINK SCRIPT
 $(document).on('click','.resend',function(e){
   e.preventDefault();
   $('.loading-spinner').toggleClass('active');
    // console.log('resend');
  data={
    'email': $('#email').val(),
    'vkey': $('#vkey').val(),
    'submit': ''
  };
  console.log(data);
  $.ajax({
    url:"forms/form_resend_link.php",
    type:'post',
    data:data,
    success:function(response){
         
      if(response.status==1){
        $('#success_reg').hide();
        $('#success_message').addClass('').css("display" ,"block")
        $('#success_message').html(
          '<div class="alert alert-success alert-dismissible">'+
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
              '<h5><i class="icon fas fa-thumbs-up">Account Activation!</i>!</h5>' +response.message+ 
              '<form id=resend_link >'+
              '<input type="hidden" name="email" id="email" value="'+response.data.email+'">'+
              '<input type="hidden" name="vkey" id="vkey" value="'+response.data.vkey+'">'+
              '<a name="submit" id="submit" class="resend" style="text-decoration:none;cursor:pointer;"><span>Resend Link</span><i class="loading-spinner fa fa-spinner"></i><span></span></a>'+
              '</form>'+

          '</div>'
        );
       
        $('.loading-spinner').toggleClass('active');
      }else {
        $('#success_reg').hide();
        $('#success_message').addClass('').css("display" ,"block")
        $('#success_message').html(
          '<div class="alert alert-warning alert-dismissible">'+
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
              '<h5><i class="icon fas fa-ban">Account Not Activated!</i>!</h5>' +response.message+ 
              '<form id=resend_link >'+
              '<input type="hidden" name="email" id="email" value="'+response.data.email+'">'+
              '<input type="hidden" name="vkey" id="vkey" value="'+response.data.vkey+'">'+
              '<a name="submit" id="submit" class="resend" style="text-decoration:none;cursor:pointer;"><span>Did Not Receive The Link? Resend Link</span><i class="loading-spinner fa fa-spinner"></i><span></span></a>'+
              '</form>'+

          '</div>'
        );
        $('.loading-spinner').toggleClass('active');
      }
    }
  })
 });


    // Get email address and send forgot password link to user
  $(document).on('click','#forgot_pass',function(){
    $('#forgot_password').modal('show');
  });
  $(document).on('click','.forgot_pass',function(e){
    e.preventDefault();
    $('.loading-spinner').toggleClass('active');
    var data={
     'email': $('#email').val(),
     'forgot_pass':""
    }
   $.ajax({
     type:"post",
     url:"forms/form_forgot_password.php",
     data:data,
    success: function(response){
      //  console.log(response);
       
      if(response.status==0){
        
         $('#getEmailForm').modal('hide');
        // $('#user_message').modal('show');
        $('#getEmailForm').addClass('').css("display" ,"block");
        $('#getEmailForm').html(
          '<div class="modal-body" id="email_modal">'+    
          '<div class="alert alert-danger alert-dismissible" id="error">'+
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
              '<h5><i class="icon fas fa-ban"></i>Entry Error !</h5>' +response.message+
          '</div>'+
                   
        '</div>'+
        '<div class="modal-footer id="foot">'+
          '<button type="button" class="btn btn-secondary" id="email_data_dismiss" data-dismiss="modal">OK</button>'+
         '</div>'
          
        );
        $('#getEmailForm').on('click','#email_data_dismiss',function(){
        })
        $('.loading-spinner').toggleClass('active');
         
      }else if(response.status==1){
        $('.loading-spinner').toggleClass('active');
         $('#forgot_password').modal('hide');
         $('#user_message').modal('show');
        $('#user_message').addClass('').css("display" ,"block");
        $('#display_user_message').html(
          '<div class="alert alert-success alert-dismissible">'+
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
              '<h5><i class="icon fas fa-thumbs-up"></i>Account Confirmed !</h5>' +response.message+
          '</div>'
        );
        $('.loading-spinner').toggleClass('active');
        
      
         
      }
    }
  });
  });

</script>
</html>
