//  LEAD EXPORT SCRIPT
function convertArrayOfObjectsToCSV(args) {
  var result, ctr, keys, columnDelimiter, lineDelimiter, data;

  data = args.data || null;
  if (data == null || !data.length) {
  return null;
  }

  columnDelimiter = args.columnDelimiter || ',';
  lineDelimiter = args.lineDelimiter || '\n';

  keys = Object.keys(data[0]);

  result = '';
  result += keys.join(columnDelimiter);
  result += lineDelimiter;

  data.forEach(function(item) {
  ctr = 0;
  keys.forEach(function(key) {
  if (ctr > 0) result += columnDelimiter;

  result += item[key];
  ctr++;
  });
  result += lineDelimiter;
  });

  return result;
  }

  window.downloadCSV = function(args) {
  var data, filename, link;
  var stockData=args.data;
  var csv = convertArrayOfObjectsToCSV({
  data: stockData
  });
  if (csv == null) return;

  filename = args.filename || 'export.csv';

  if (!csv.match(/^data:text\/csv/i)) {
  csv = 'data:text/csv;charset=utf-8,' + csv;
  }
  data = encodeURI(csv);

  link = document.createElement('a');
  link.setAttribute('href', data);
  link.setAttribute('download', filename);
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
  } 
      

  $('#export').on('click', '.submit', function(event) {
    event.preventDefault();
    
    var data={
    'user_id':$('#user_id').val(),
    'submit_export':''
    }
    console.log(data);
    $.ajax({
      url: 'forms/form_export_lead.php',
      type: 'post',
      data: data,
      success: function(response){
      // $("#submit").html('Sign In');
        if (response.status=='success') { 
          console.log(response)
          var stockData=response.data;
          downloadCSV({ filename: "lead-data.csv", data:stockData });
          
        }
      },
      fail: function(rp){
      alert(rp);
      }
  });
});

// IMPORT LEADS
$('#import_new_lead').on('submit',function(e){
  e.preventDefault();
  $('.loading-spinner').toggleClass('active');
  var fd=new FormData(this)
  console.log(fd);
  $.ajax({  
    url:"forms/form_import_lead.php",  
    method:"POST",  
    data:fd,  
    contentType:false,          // The content type used when sending data to the server.  
    cache:false,                // To unable request pages to be cached  
    processData:false,          // To send DOMDocument or non processed data file it is set to false  
    success: function(data){ 
      if(data.status == 'success') {
        $('#lead_message').html(
            '<div class="alert alert-success alert-dismissible">'+
              '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
              '<h5><i class="icon fas fa-thumbs-up"></i>'+data.message+'</h5>'+                               
            '</div>'
          );
          $('.loading-spinner').toggleClass('active');
          $('#import_lead').modal('hide');
          // window.location="leads.php";

      }else{
        console.log(data);
          $('#lead_message_error').html(
            '<div class="alert alert-danger alert-dismissible">'+
              '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
              '<h5><i class="icon fas fa-ban"></i>'+data.message+'</h5>'+                               
            '</div>'
          );
          $('.loading-spinner').toggleClass('active');
       }
    }  
  })  
});




