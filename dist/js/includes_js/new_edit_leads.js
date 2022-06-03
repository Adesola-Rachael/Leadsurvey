 // CREATE NEW LEAD 
 $('#id_new_lead').submit('#id_new_lead_submit',function(e){
    e.preventDefault();
    $('.loading-spinner').toggleClass('active');
    var formData={
      'user_id' : $('#id_user_id').val(),
      'full_name' : $('#id_full_name').val(),
      'gender' : $('#id_gender').val(),
      'agegroup' : $('#id_agegroup').val(),
      'email' : $('#id_email').val(),
      'phone' : $('#id_phone').val(),
      'state' : $('#stateId').val(),
      'country' : $('#countryId').val(),
      'new_lead_submit' : ''
    }

    console.log(formData);
    $.ajax({
      url: 'forms/form_new_lead.php',
      type: 'post',
      data: formData,
      success: function(response){
        if(response.status=='success'){
          console.log(response)
           $('#lead_message').html(
            '<div class="alert alert-success alert-dismissible">'+
              '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
              '<h5><i class="icon fas fa-thumbs-up"></i>'+response.message+'</h5>'+                               
            '</div>'
          
          );
          $('.loading-spinner').toggleClass('active');
          $('#id_new_lead').modal('hide');
          // window.location="leads.php";

          
        }else{
          $('#lead_create_message_error').html(
            '<div class="alert alert-danger alert-dismissible">'+
              '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
              '<h5><i class="icon fas fa-ban"></i>'+response.message+'</h5>'+                               
            '</div>'
          );
          $('.loading-spinner').toggleClass('active');
          // $('#id_new_lead').modal('hide');
        }
        
      },
      fail: function(rp){
      alert(rp);
      }
    });
  });



  // EDIT LEAD 
  $('#id_edit_lead').submit('#id_edit_lead_submit',function(e){
    e.preventDefault();
    $('.loading-spinner').toggleClass('active');
    var cont=$('#country_Id').val();
    var formData={
      'user_id' : $('#id_user_id').val(),
      'full_name' : $('#id_edit_name').val(),
      'gender' : $('#id_edit_gender').val(),
      'agegroup' : $('#id_edit_agegroup').val(),
      'email' : $('#id_edit_email').val(),
      'phone' : $('#id_edit_phone').val(),
      'state' : $('#state_Id').val(),
      'country' : $('#country_Id').val(),
      'edit_sn' : $('#edit_sn').val(),
      'edit_lead_submit' : ''
    }
    console.log(formData);
    console.log(cont);
    $.ajax({
      url: 'forms/form_edit_lead.php',
      type: 'post',
      data: formData,

      success: function(response){ 
        console.log(response)
        if(response.status=='success'){
        
          $('#lead_message').html(
          '<div class="alert alert-success alert-dismissible">'+
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
            '<h5><i class="icon fas fa-thumbs-up"></i>'+response.message+ ' </h5>'+                               
          '</div>'
        
        );
        $('.loading-spinner').toggleClass('active');
        $('#id_edit_lead').modal('hide');
        // window.location="leads.php";
          
        }else{
          
          $('#lead_edit_message_error').html(
            '<div class="alert alert-danger alert-dismissible">'+
              '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
              '<h5><i class="icon fas fa-ban"></i>'+response.message+'</h5>'+                               
            '</div>'
          );
          $('.loading-spinner').toggleClass('active');
          // $('#id_edit_lead').modal('hide');
        }
        
        
      },
      fail: function(rp){
      alert(rp);
      }
    });

  });