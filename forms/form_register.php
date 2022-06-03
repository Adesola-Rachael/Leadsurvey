<?php
 error_reporting(E_ALL);
 
    header('Content-type: application/json');
   
    session_start();

    if ( isset($_POST['register_submit']) ) 
    {
        
        include_once('../includes/dbConnection.php');

        $reg_error_msg = "";
         

        $_SESSION["reg_error_msg"] = "";
        $_SESSION["reg_full_name"] = "";
        $_SESSION["reg_user_name"] = "";
        $_SESSION["reg_email"] = "";

        if (isset($_POST['full_name']) && !empty($_POST['full_name'])){
            $full_name = cleanse($_POST['full_name'], $conn);   
            $_SESSION["reg_full_name"] = $full_name;   

        }
        else {
            $reg_error_msg = "- Please Enter Your Full Name<br/>";
        } 
        

        if (isset($_POST['email']) && !empty($_POST['email'])){
            $email = cleanse($_POST['email'],$conn);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $reg_error_msg .= "- Please Enter a valid Email Address<br/>";
            }
            //echo $email;
            $_SESSION["reg_email"] = $email;
        }
        else {
            $reg_error_msg .= "- Please Enter Your Email Address<br/>";
            //echo $reg_error_msg;
        }   

        if (isset($_POST['user_name']) && !empty($_POST['user_name'])){
            $user_name = cleanse($_POST['user_name'],$conn);

            //Username verification
            $username_ver = checkUsername($user_name);
            if( $username_ver != ""){
                $reg_error_msg .= "- ".$username_ver;
            }else{
                $_SESSION["reg_user_name"] = $user_name;
            }
        }
        else {
            $reg_error_msg .= "- Please Enter Your Username<br/>";
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


        if (isset($_POST['tnc']) && !empty($_POST['tnc'])){
            $tnc = cleanse($_POST['tnc'],$conn);        
            $_SESSION["reg_tnc"] = $tnc;        
        }
        else {
            $reg_error_msg .= "- You Must Agree to Our Terms and Conditions to Register<br/>";
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
            $query = " select * from user_auth where email='".$email."' ";
            $result = $conn->query($query);
            $rows_email = mysqli_num_rows($result);

            //To confirm if username is not pre-existent
            $query = " select * from user_auth where user_name='".$user_name."' ";
            $result = $conn->query($query);
            $rows_username = mysqli_num_rows($result);

            if ($rows_email == 0){ 
                if ($rows_username == 0){
                    //echo "<br/>DOES NOT EXIST<br/>";

                    //secure password before inserting into the dB
                    $password = password_hash($password, PASSWORD_DEFAULT);

                    //creating a unique hash for email verification
                    $user_hash = md5( rand(0,1000) ); // Generate random 32 character hash and assign it to a local variable.

                    //Creating an email verification/account activation link
                    $verify_key=md5( rand(0,1000) );
                    //setting variables for offline and online respectively
                    if (isLocal ()){
                        //echo "Website is OFFLINE";
                        //Creating an email verification/account activation link
                        $act_link = 'http://localhost/victorwrk/forms/form_activate.php?email='.$email.'&vkey='.$verify_key;
                    }else{
                        //echo "Website is ONLINE ONLINE ONLINE ONLINE ";
                        $act_link = 'http://plconnect.com.ng/assets/forms/form_activate.php?email='.$email.'&vkey='.$verify_key;
                    }

                    //Send Data to DB
                    $result = FALSE;
                    
                    $query_user_auth = "INSERT INTO user_auth (sn, user_name, password, access_level, user_type, email, hash, verification_id, verifircation_status, status, time_created, time_modified) VALUES (NULL, '".$user_name."', '".$password."', 0,'client', '".$email."', '".$user_hash."', '".$verify_key."', 0,'registered', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)"; 

                    $result = $conn->query($query_user_auth);
                    
                    
                    if ($result){
                        //echo "SUCCESSFUL"; 

                        //populate user data table too
                        $query2 = "
                            INSERT INTO user_data (sn, user_name, full_name, image, gender, dob, nationality, phone_num, email, percentage_complete, status, time_created, time_modified) VALUES 
                            (NULL, '".$user_name."', '".$full_name."', NULL, NULL, NULL, NULL, NULL, '".$email."', 28, 'active', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
                        ";  

                        $result2 = $conn->query($query2);
                       
                        if ($result2) {
                        // Variables for sending email to user, the variables are  use in mail.php

                            $link_text="Verify Account";
                            $company="Company Name";
                            $state="State";
                            $country="Country";
                            $message="Click the box below to confirm your email address. If you did not create an account with  <a href='#'>$company</a>, you can safely delete this email.";
                            $greeting="Welcome To $company";
                            $subject="Account | Activation";
                            $reason="You received this email because we received a request form you for account creation on $company. If you did not request for account creation, you can safely delete this email.";
                            $msg= 
                            '
                            Thanks for Creating An Account at plconnect.com.ng!
                            
                            Kindly click the Activation link provided below to activate your account 
                            
                            ------------------------
                            Username: '.$user_name.'
                            Password: XXXXXXX
                            ------------------------
                            
                            Please click this link to activate your account:        
                            '.$act_link.'
                        
                        ';
                            
                            
                        
                        
                        // include email message
                             
                            // include_once('../mail.php');
                             
                           

                            // $_SESSION["reg_error_msg"] = "";
                            // $_SESSION["reg_user_name"] = "";
                            
                            if(sendEmail($email, $user_name, $subject, $msg)){
                                 
                                 
                                $response= array(
                                   'status'=>1,
                                   'mail_status'=>'sent',
                                   'email'=>$email,
                                   'message' =>"A verification link has been sent to your e-mail, kindly check your e-mail and verify your account to proceed",
                                   'user_name'=>$user_name
                                );
                                 
                                echo json_encode($response);  
        
                            }else{  
                                
                                $response= array(
                                   'status'=>1,
                                   'mail_status'=>'not-sent',
                                   'message'=>"Data  Sucessfully Created"
                               );
                                echo json_encode($response);
                                                  
                             }    
                        }else{
                            //Query2 
                            //echo $query2;                        
                            exit();
                        }         
                    }
                    else {
                        //echo "FAILED<br/>";
                        //echo $query_user_auth;
 
                        $reg_error_msg = "Query Error!!!, Please Try again later.<br/>";
                        $_SESSION["reg_error_msg"] = $reg_error_msg;
                        $response= array(
                            'status'=>0,
                            'message'=> $_SESSION["reg_error_msg"]
                        );
                        echo json_encode($response);  
                     }
                }else{
                    $reg_error_msg = " Username Already exists, Please choose another one<br/>".$reg_error_msg;
                    $_SESSION["reg_error_msg"] = $reg_error_msg;
                     $response= array(
                        'status'=>0,
                        'message'=>$_SESSION["reg_error_msg"]
                    );
                    echo json_encode($response);
 
                    //echo "<br/>ALREADY EXISTS";        
                 }        
            }else {            
                //echo "<br/>ALREADY EXISTS";    
                $_SESSION["reg_email"] = $email;   
                $reg_error_msg = " Email Already exists, Please choose another one<br/>".$reg_error_msg;
                $_SESSION["reg_error_msg"] = $reg_error_msg;
                 $response= array(
                    'status'=>0,
                    'message'=>$_SESSION["reg_error_msg"]
                );
                echo json_encode($response);
                // header('Location:../login.php?status=registered'); // User is registered and email is activated. Redirecting To signin Page as Old User         
                
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

    function checkUsername($userN) {//to ensure rubbishe strings are not used for usernames
        $error = "";

        if (strlen($userN) < 5 ||  !preg_match("#[a-zA-Z]+#", $userN)) {
            $error = "Username Must be at least 5 chars long with at least 1 letter<br/>";
        }

        return $error;
    }

    //defining Php Functions
    function isLocal (){//function to check if site is hosted online or is offline
        return !checkdnsrr($_SERVER['SERVER_NAME'], 'NS');
    }

    function sendEmail($friendEmail,$friendName,$dSubject, $msgBody){    
        return TRUE;
    }
?>