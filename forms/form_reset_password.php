
<?php
// error_reporting(0);
error_reporting(E_ALL);
 
    header('Content-type: application/json');
   
    session_start();

    if ( isset($_POST['reset_password']) ) 
    {
        
        include_once('../includes/dbConnection.php');

        $reg_error_msg = "";
         

        $_SESSION["reg_error_msg"] = "";
        $_SESSION["reg_full_name"] = "";
        $_SESSION["reg_user_name"] = "";
        $_SESSION["vkey"] = "";     
        
        // checking if verification id is empty
        if (isset($_POST['vkey']) && !empty($_POST['vkey'])){        
            $vkey= cleanse($_POST['vkey'], $conn);
        }
        else {
            $reg_error_msg .= "- Verification record does not exist<br/>";
        }  

        if (isset($_POST['password']) && !empty($_POST['password'])){ 
            $password = cleanse($_POST['password'], $conn); 

            //password strength verification
            $password_strength = checkPassword($password);
            if( $password_strength != ""){
                $reg_error_msg .= "- ".$password_strength;
            }else{
                if (isset($_POST['password2']) && !empty($_POST['password2'])){ 
                    $password2 = cleanse($_POST['password2'], $conn); 
                    
                    if ($password != $password2){
                        $reg_error_msg .= "- Both paswords must match<br/>";
                    }
                }
                else {
                    $reg_error_msg .= "- Please Re-Enter Your Password<br/>";
                }
            }
        }
        else {
            $reg_error_msg .= "- Please Enter Your Password<br/>";
        }

        if($reg_error_msg != ""){
            //echo "<br/>DOES NOT EXIST<br/>".$reg_error_msg; 
            $_SESSION["reg_error_msg"] = $reg_error_msg;
            // header('Location:../register.php?status=reg_error'); // Redirecting To Registration Page  
            $response= array(
                'status'=>0,
                'message'=> $_SESSION["reg_error_msg"]
             );
            echo json_encode($response);        
        }else{
            //To confirm if email is not pre-existent
            // $query = " select * from user_auth where verification_id='".$vkey."' ";
            // $result = $conn->query($query);
            // $rows_verify = mysqli_num_rows($result);
            
            // if ($rows_verify == 1){ 
                
                //echo "<br/>DOES EXIST<br/>";

                //secure password before updating into the dB
                $password = password_hash($password, PASSWORD_DEFAULT);

                //Send Data to DB
                // $result = FALSE;
                
                // $query_update_password = "UPDATE user_auth SET password = '.$password.'  WHERE verification_id='.$vkey.' LIMIT 1";
                $query_update_password = "UPDATE user_auth SET password = '".$password."' WHERE verification_id='".$vkey."' LIMIT 1 "; 

                $result = $conn->query($query_update_password);
                
                
                if ($result){
                    //echo "SUCCESSFUL"; 

                    //populate user data table too

                    $response= array(
                        'status'=>1,
                        'message'=>"Password Updated"
                    );
                        
                        echo json_encode($response); 
                }else {            
                //echo "<br/>Verificatiion number does not exist";    
                 
                 $response= array(
                    'status'=>0,
                    'message'=>"Verification number does not exist"
                );
                echo json_encode($response);
                 
            }        
        }
    }else{
        $response= array(
            'status'=>0,
            'message'=> "Request Not Submitted"
        );
        echo json_encode($response);   
    }


    //-----FUNCTIONS DECLARATION----//

    function cleanse($field,$conn) {//To protect against sql Injection
        $result = trim($field);
        $result = stripslashes($result);
        $result = mysqli_real_escape_string($conn, $result); //for prevention of mySQL injection

        return $result;
    }

    function checkPassword($pwd) {//To ensure password is strong
        $error = "";

        //if (strlen($pwd) < 8 || !preg_match("#[0-9]+#", $pwd) || !preg_match("#[a-zA-Z]+#", $pwd)) {
            //$error = "Password Must be at least 8 chars long,<br/>must have one or more numbers,<br/> and at least 1 letter!<br/>";
        //}else{
            //;
        //}

        if (strlen($pwd) < 5 ) {
            $error = "Password Must be at least 5 chars long.";
        }else{
            ;
        }

        return $error;
    }

     
    
?>