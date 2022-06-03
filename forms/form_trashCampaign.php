<?php

if ( isset($_POST['trash_submit']) && $_POST['trash_submit'] == "Trash User contact"){   
    include_once('../includes/dbConnection.php');

    //preparation for ajax usage
    $errors         = array();      // array to hold validation errors
    $data           = array();      // array to pass back data
    
    //declaring page variables
    $trash_error_msg = "";

    //collecting and validating FORM input-[username]
    if (isset($_POST['trash_id']) && !empty($_POST['trash_id'])){
        $trash_id = cleanse($_POST['trash_id'],$conn); //for prevention of mySQL injection
    }
    else {
        $trash_error_msg .= "- Please select a valid user<br/>";
        //echo $trash_error_msg;
    }

    //IF statement to ensure form process is executed with no errors
    if($trash_error_msg != ""){
       $data['success'] = true;
       $data['status'] = "error";
       $data['message'] = $trash_error_msg;  
    }else{   
        //updating DB details
        $result1 = FALSE;
        $query1 = "UPDATE campaigns SET status='trashed' WHERE sn ='".$trash_id."' "; 
        $result1 = $conn->query($query1);

        if ($result1){
           $data['success'] = true;
           $data['status'] = "success";
           $data['message'] = "Your changes have been recorded successfully.";
        }else{
           $data['success'] = true;
           $data['status'] = "query-error";
           $data['message'] = "Query Error: ".$query1;
        }
    }

    // return all our data to an AJAX call
    echo json_encode($data);
}


//defining Php Functions
function cleanse($field,$conn) {//To protect against sql Injection
    $result = trim($field);
    $result = stripslashes($result);
    $result = mysqli_real_escape_string($conn, $result); //for prevention of mySQL injection

    return $result;
}


?>