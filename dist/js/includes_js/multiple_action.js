  //MULTIPLE/GROUP  ACTION (DELETE) 
  $("#checkAl").click(function () {
    $('input:checkbox').not(this).prop('checked', this.checked);
    // if($('#checkbox').is(':checked') ){
    //   alert('cheked')
    // }
  });

  // var leadIsChecked = $('#checkAl:checkbox:checked').length > 0;
  // if(leadIsChecked)
  // $('#multiple_select').on('click','#mycheck',function(e){
  //   e.preventDefault();
  //   $('.loading-spinner').toggleClass('active');
  //   var form=$('#multiple_select').serialize();
  //   console.log(form);
  //   $.ajax({
  //     url: 'forms/form_multiple_action.php',
  //     type: 'POST',
  //     data: form,
  //     success: function(data){
        
  //       if(data.status=='success'){
  //         console.log(data);
  //         alert('Trashed Successfully!')
  //         window.location="leads.php";
  //         }else{
  //         console.log(data);
  //         alert('An Error Occured, Please Try Again')
  //       }   
  //     },
  //     fail: function(rp){
  //       alert(rp);
  //     }
  //   });
  // });






//   $(document).ready(function(){
//     $('input[type="checkbox"]').click(function(){
//         if($(this).is(":checked")){
//             console.log("Checkbox is checked.");
//         }
//         else if($(this).is(":not(:checked)")){
//             console.log("Checkbox is unchecked.");
//         }
//     });
// });


// $('#multiple_select').on('click','#mycheck',function(e){
// e.preventDefault();
// // var trash_me = confirm("Are sure you want to move this details to inactive, this process is irreversible?");            
// if($('input:checkbox').not(this).prop('checked', this.checked) ){ 
//   var trash_me = confirm("Are sure you want to move this details to inactive, this process is irreversible?");            
 
//   if (trash_me == true) {
//     $('.loading-spinner').toggleClass('active');
//     var form=$('#multiple_select').serialize();
//     console.log(form);
//     $.ajax({
//       url: 'forms/form_multiple_action.php',
//       type: 'POST',
//       data: form,
//       success: function(data){
        
//         if(data.status=='success'){
//           console.log(data);
//           alert('Trashed Successfully!')
//           window.location="leads.php";
//           }else{
//           console.log(data);
//           alert('An Error Occured, Please Try Again')
//         }   
//       },
//       fail: function(rp){
//         alert(rp);
//       }
//     });
//   } 
// }else{
//   alert('select leads to trash')
// }
// });
