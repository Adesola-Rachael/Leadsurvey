<!-- <div class="modal fade"  data-backdrop="false" id="activate_account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  >
  <div class="modal-dialog" role="document" >
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
</div> -->


<?php
    //getting current year
    $current_date = date("Y-m-d");
    $current_year = substr($current_date, 0, 4);
?>

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      v1.3.5
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo $current_year; ?> <a href="index.php">Victor Work</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->
<!-- REQUIRED SCRIPTS -->
<!-- script for account activation -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>


<script>
$(document).ready(function(){
  $(document).on('click', '.active', function(){
     //$('#activate_account').modal('show');
     $('#activate_message').html(
        '<div class="alert alert-success alert-dismissible">'+
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
            '<div class="alert alert-success alert-dismissible">'+
            
                '<p>An activation link has been sent to your email address. KIndly check your email to activate your account.</p>'+
                  ' <p>Didn`t get the link?'+
                    '<form id="resendLink">'+
                      '<input type="hidden" class="email" name="email" value="<?php echo $email ?>">'+
                      '<input type="hidden" class="vkey" name="vkey" value="<?php echo $vkey ?>">'+
                      '<input type="hidden" class="username" name="username" value="<?php echo $username ?>">'+
                      '<a type="submit" name="submit" id="resend_link" >resend Link</a>'+
                    '</form>'+
            '</div>'+                               
        '</div>'
     );
     $(document).on('click', '#resend_link', function(e){
          e.preventDefault();
           //var data=$('#resendLink').serialize();
          var data={
            'email':$('.email').val(),
            'vkey':$('.vkey').val(),
            'username':$('.username').val(),
            'submit':''
          }
          console.log(data);
// 
          $.ajax({
        url: 'forms/form_resend_link.php',
        type: 'post',
        data: data,
        success: function(response){
          if(response.status==0){
            // $('#success_message').addClass('alert alert-warning').css("display" ,"block")
            $('#activate_message').html(
              '<div class="alert alert-danger alert-dismissible">'+
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                  '<h5><i class="icon fas fa-ban"></i>Activation Error!</h5>' +response.message+
              '</div>'
            );
            // $('#success_message').text(response.message) 
            $('.loading-spinner').toggleClass('active');
            console.log(response)
            
          }else if(response.status==1){
            $('#activate_message').html(
              '<div class="alert alert-success alert-dismissible">'+
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                  '<h5><i class="icon fas fa-ban"></i>Link Resent Successfully!</h5>' +response.message+
              '</div>'
            );
            // $('#success_message').text(response.message) 
            $('.loading-spinner').toggleClass('active');
            console.log(response)
            
          }
          // else if(response.status==1 && response.mail_status=='not-sent'){
             
          // } 
        },
        fail: function(rp){
        alert(rp);
        }
      });


     });
    // alert("welcome");
    // console.log("welcome");
  });
});
</script>
 