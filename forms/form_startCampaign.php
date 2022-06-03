<?php

if ( isset($_POST['submit']) && $_POST['submit'] == "submit"){   
    include_once('../includes/dbConnection.php');

    //preparation for ajax usage
    $errors         = array();      // array to hold validation errors
    $data           = array();      // array to pass back data
    
    //declaring page variables
    $trash_error_msg = "";

    //collecting and validating FORM input-[username]
    if (isset($_POST['id']) && !empty($_POST['id'])){
        $id = cleanse($_POST['id'],$conn); //for prevention of mySQL injection
    }
    else {
        $trash_error_msg .= "- Please select a valid user<br/>";
        //echo $trash_error_msg;
    }

     if (isset($_POST['action']) && !empty($_POST['action'])){
        $action = cleanse($_POST['action'],$conn); //for prevention of mySQL injection
    }
    else {
        $trash_error_msg .= "- Please select an action";
        //echo $trash_error_msg;
    }

    //IF statement to ensure form process is executed with no errors
    if($trash_error_msg != ""){
       $data['success'] = true;
       $data['status'] = "error";
       $data['message'] = $trash_error_msg;  
    }else{   

        $result = FALSE;
        $query = "SELECT * FROM campaigns WHERE sn ='".$id."' AND feedback_tool!='' AND feedback_data!=''"; 
        $result = $conn->query($query);

        if(mysqli_num_rows($result)==1 || $action!='ongoing'){
            //updating DB details
            $result1 = FALSE;
            $query1 = "UPDATE campaigns SET status='$action' WHERE sn ='".$id."'"; 
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
        }else{
            $data['success'] = true;
            $data['status'] = "failed";
            $data['message'] = "No feedback tool/data found, please add your feedback tool and data to proceed.";
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