<?php
error_reporting(E_ALL);
        
header('Content-type: application/json');
     include_once('../includes/dbConnection.php');
    $data = array();
	$checkbox = $_POST['check'];
	for($i=0;$i<count($checkbox);$i++){
	    $del_id = $checkbox[$i]; 

        $query1 = "UPDATE leads SET status='trashed' WHERE sn ='".$del_id ."' "; 
            $result1 = $conn->query($query1);
            if($result1){
                $data['success'] = true;
                $data['status'] = "success";
                $data['message'] = "Data Trashed successfully !" ;  
             }else{
                $data['success'] = false;
                $data['status'] = "error";
                $data['message'] = "Data Not Not Trashed ! Please Try Again" ; 
             }
        
    }
    echo json_encode($data);
 
?>