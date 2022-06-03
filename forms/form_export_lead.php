<?php

// error_reporting(0);
error_reporting(E_ALL);
        
    header('Content-type: application/json');
    // session_start();

if ( isset($_POST['submit_export']) ) {
    include_once('../includes/dbConnection.php');
    $response = array();
    $errors = array();
    $lead_edit_error_msg = "";
    // collecting and validating form input
    if (isset($_POST['user_id']) && !empty($_POST['user_id'])){
        $user_id = cleanse($_POST['user_id'], $conn); 
    }
    else {
        $lead_edit_error_msg = "WRONG USER_ID<br/>";
    }   
    if($lead_edit_error_msg != ""){
        //echo $lead_edit_error_msg; 
        $response['success']=true;
        $response['status']='error';  
        $response['message']=$lead_edit_error_msg;   
    }else{
        $lead = mysqli_query($conn, "SELECT * FROM leads WHERE user_id='".$user_id."' AND status != 'trashed' ");
        $rows = $lead->num_rows;
        $query_lead = "SELECT * FROM leads WHERE user_id='".$user_id."' AND status != 'trashed' ";
        $result = $conn->query($query_lead);
        if ($result){
            $response['success']=true;
                $response['status']='success';  
                $response['message']='Lead gotten Successfully!'; 
            $i=0;
           
            while ($row=mysqli_fetch_assoc($result)) {
               
                $name=$row['full_name'];
                $user_id=$row['user_id'];
                $email=$row['email'];
                $gender=$row['gender'];
                $phone_number=$row['phone_number'];
                $cont_abbr=$row['country_abbr'];
                $agegroup=$row['agegroup'];
                $state=$row['state'];
                $country=$row['country'];

                $response['data'][$i]=[

                    'sn'=>$i+1,
                    'name'=>$name,
                    'email'=>$email,
                    'gender'=>$gender,
                    'phone'=>$cont_abbr.' '.$phone_number,
                    'agegroup'=>$agegroup,
                    'Country'=>$country,
                    'state'=>$state
                ];  
                $i++;
            }

            echo json_encode($response);
            
        }else{
            $response['success']=true;
            $response['status']='error';  
            $response['message']='ID NOT FOUND!'; 
            echo json_encode($response);
        }

        

    }

}else{
    $response['success']=true;
    $response['status']='error';  
    $response['message']='REQUEST NOT SENT!'; 
    echo json_encode($response);
}



 //-----FUNCTIONS DECLARATION----//
 function cleanse($field,$conn) {//To protect against sql Injection
    $result = trim($field);
    $result = stripslashes($result);
    $result = mysqli_real_escape_string($conn, $result); //for prevention of mySQL injection

    return $result;
}
?>