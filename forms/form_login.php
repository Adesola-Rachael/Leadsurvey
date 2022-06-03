<?php
    // error_reporting(0);
     error_reporting(E_ALL);
    
    header('Content-type: application/json');
     session_start();
   
    if ( isset($_POST['login_submit']) ) {
        include_once('../includes/dbConnection.php');
       
       

        $login_err_msg = "";

        $_SESSION["login_err_msg"] = "";
        $_SESSION["login_user_name"] = "";
        

        if (isset($_POST['user_name']) && !empty($_POST['user_name'])){
            $user_name = cleanse($_POST['user_name'], $conn);
            $_SESSION["login_user_name"] = $user_name;
        }
        else {
            $login_err_msg = "- Please Enter Your Username<br/>";
        }   

        
        if (isset($_POST['password']) && !empty($_POST['password'])){        
            $password = cleanse($_POST['password'], $conn);
        }
        else {
            $login_err_msg .= "- Please Enter Your Password<br/>";
        }  

        
        if($login_err_msg != ""){
            //echo $login_err_msg; 
            $_SESSION["login_err_msg"] = $login_err_msg;
                $response=array(
                    'status'=>0,
                    'message'=>$_SESSION["login_err_msg"]
                );
                echo json_encode($response);
        }else{
            //confirm if given credentials match those in DB
            $query = " SELECT * FROM user_auth where user_name='".$user_name."' OR email='".$user_name."' ";
            $result = $conn->query($query);
            $rows = $result->num_rows;
            

            
            
            if ($rows == 1){ 
                //echo "USER ID EXISTS<br/>";
                //collect user's DB data
                while($each_row = mysqli_fetch_array($result)){                 
                    $password_db = $each_row['password'];
                    $username_db = $each_row['user_name'];
                    $email_db = $each_row['email'];
                    $access_db = $each_row['access_level'];
                    $status_db = $each_row['status'];
                    $verify_db = $each_row['verifircation_status'];
                    $created_db = $each_row['time_created'];
                    $verify_id_db = $each_row['verification_id'];
                    
                }
                $getDate=explode(" ",$created_db);
                $new_date=$getDate[0];
                $time_expired=date('Y-m-d', strtotime($new_date. ' + 14 days'));
                

                //confirm if password matches
                if (password_verify($password, $password_db))
                {
                    //echo "USER ID MATCHES PASSWORD<br/>";
                    // if ($verify_db == 0  || $verify_db == NULL ){
                    
                    if ($verify_db == "No" ){
                        // Account Not Activated
                        $response=array(
                            'status'=>10,
                            'message'=>'<p>A verification link has been sent to your e-mail, kindly check your e-mail and verify your account to proceed.</p>',
                            'data'=>[
                             'email'=>$email_db,
                            'vkey'=>$verify_id_db
                            ],
                            
                            
                        );
                        echo json_encode($response);
                    } else if($status_db == "verified" || $status_db == "activated" || $status_db == "awaiting_approval" || $status_db == "registered"){   
                        //echo "USER ACCOUNT IS ACTIVATED<br/>";
                        
                        // Initializing Login Details Session
                        $_SESSION['victor_work_email']=$email_db;                         
                        $_SESSION['victor_work_username']= $username_db;                         
                        $_SESSION['victor_work_access_level'] = $access_db;
                        $_SESSION['victor_work_status'] = $status_db;

                        $response=array(
                            'status'=>1,
                            'message'=>"Login Successful"
                        );
                        echo json_encode($response);
                        
                        
                    }else if ( $status_db == "registeredxxxxxxxx" ){
                        //echo "USER ACCOUNT NOT ACTIVATED<br/>";
                    }else{
                    }                
                }else{
                    //echo "WRONG PASSWORD<br/>";
                  
                    $response=array(
                        'status'=>0,
                        'message'=>"Invalid Account Details, Please Try Again."
                    );
                    echo json_encode($response);
                     
                 }
            }else{
                // USER DOES NOT EXIST
                $response=array(
                    'status'=>0,

                    'message'=>'Invalid Account Details, Please Try Again.'
                );
                echo json_encode($response);
                
            }
             
        }
    }else  {
        $response=array(
            'status'=>0,
            'message'=>'Request Not Submitted'
        );
        echo json_encode($response);
    }



    function cleanse($field,$conn) {//To protect against sql Injection
        $result = trim($field);
        $result = stripslashes($result);
        $result = mysqli_real_escape_string($conn, $result); //for prevention of mySQL injection

        return $result;
    }

    function securePassword($pass){ //to store and retrieve hashed version of passwords
        // A higher $cost is more secure but consumes more processing power
        $cost = 19;

        //Now to create a random salt
        $salt = substr(strtr(base64_encode(hex2bin(RandomToken(32))), '+', '.'), 0, 44);

        //Setting Prefix information about the password so PHP knows how to verify it later
        // "$2a$" means we're using the Blowfish Algorithm. the two digits that follows are the cost parameter
        $salt = sprintf("$2a$%02d$" , $cost).$salt;

        //we finally hash the password with the salT
        $hash = crypt($pass, $salt);

        return $hash;
    }

    function RandomToken($length = 32){
        if(!isset($length) || intval($length) <= 8 ){
          $length = 32;
        }
        if (function_exists('random_bytes')) {
            return bin2hex(random_bytes($length));
        }        
        if (function_exists('openssl_random_pseudo_bytes')) {
            return bin2hex(openssl_random_pseudo_bytes($length));
        }
    }
?>