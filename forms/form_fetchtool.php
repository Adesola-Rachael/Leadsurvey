<?php
//---------------------------------ON LINE--------------------------------------------//

include_once('../includes/dbConnection.php');
  header('Content-Type: application/json');
  $headers = apache_request_headers();
// Takes raw data from the request
$_POSTs = file_get_contents('php://input');
//echo $_POSTs;
$post=json_decode($_POSTs, true);

if(isset($post)){
  if (count($post)!=0) {
    $_POST=$post;
  }
}else{
  if (strlen($post)!=0) {
    $_POST=$post;
  }
}
session_start();
//error_reporting(0);
$_SESSION["reg_error_msg"] = "";
//$_SESSION["user_name"] = "";
$_SESSION["email"] = "";
$confirm_password='';
$password=' ';
//preparation for ajax usage
if (isset($_GET['ajax']) && $_GET['ajax']=='true'){
    //echo "AJAX IN THE BUILDING";
    $handle_wt_php = false;
}else{
    $handle_wt_php = true;
}

if (isset($_SESSION['victor_work_username']) && !empty($_SESSION['victor_work_username'])){
    $user_name = cleanse(strtolower($_SESSION['victor_work_username']),$conn);
}
else {
    $_SESSION["reg_error_msg"] = $_SESSION["reg_error_msg"]." - Please Enter Your User Name";
} 

if (isset($_POST['type']) && !empty($_POST['type'])){
    $type = cleanse(strtolower($_POST['type']),$conn);
}
else {
    $_SESSION["reg_error_msg"] = $_SESSION["reg_error_msg"]." - Please Select type";
} 

if($_SESSION["reg_error_msg"] != ""){
        //echo $_SESSION["login_error_msg"];
        $error = array('status' => '0', 
            'message' => $_SESSION["reg_error_msg"],

        );
        echo json_encode($error);
        
}else{

    $feedback_tool=mysqli_query($conn, "SELECT * FROM feedback_tool WHERE user_id='$user_name'");
    
    if ($feedback_tool) {
        //echo $_SESSION["login_error_msg"];
        $error = array('status' => '1', 
            'message' => 'feedback tool fetched successfully',
            'data' => mysqli_fetch_array($feedback_tool)
        );
        echo json_encode($error);
    }else{
        //echo $_SESSION["login_error_msg"];
        $error = array('status' => '0', 
            'message' => "Feed tool not available",

        );
        echo json_encode($error);
    }

}



function cleanse($field,$conn) {//To protect against sql Injection
    $result = trim($field);
    $result = stripslashes($result);
    $result = mysqli_real_escape_string($conn, $result); //for prevention of mySQL injection

    return $result;
}





?>