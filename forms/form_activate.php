<?php
 header('Content-type: application/json');
    if ( isset($_GET['vkey']) ) {
        $vkey = $_GET['vkey'];
        // process Verification for acount
        include_once('../includes/dbConnection.php');

            // session_start();
            $query = " SELECT verification_id, verifircation_status FROM user_auth WHERE verification_id='".$vkey."' AND verifircation_status=0 LIMIT 1";
            $result = $conn->query($query);
            if($result->num_rows == 1){
                // Validate The Email
                $update_update= "UPDATE user_auth SET verifircation_status=1 WHERE verification_id='".$vkey."' LIMIT 1 ";
                $result = $conn->query($update_update);
                if($result){
                    // Account Activation Suucessful

                    header('Location:../login.php?status=login&login_activate=AccountActivated');
                }
                
            }else{
                 header('Location:../login.php?status=login&login_activate=AccountActivated'); 
            }
    }else{ 
        // The verification id for the account is empty
    }  
        
?>