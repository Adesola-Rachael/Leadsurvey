
<?php
// error_reporting(0);
// error_reporting(E_ALL);
 
    header('Content-type: application/json');
   
    session_start();

    if ( isset($_POST['forgot_pass']) ) 
    {
        
        include_once('../includes/dbConnection.php');

        $reg_error_msg = "";
        $_SESSION["user_email"] = "";
 
        
        // Checking the value of the input 
        if (isset($_POST['email']) && !empty($_POST['email'])){
            $email = cleanse($_POST['email'],$conn);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $reg_error_msg .= "- Please Enter a valid Email Address<br/>";
            }
            //echo $email;
            $_SESSION["user_email"] = $email;
        }
        else {
            $reg_error_msg .= "- Please Enter Your Email Address<br/>";
            //echo $reg_error_msg;
        }   

        if($reg_error_msg != ""){
            
            $_SESSION["reg_error_msg"] = $reg_error_msg;
        //    return with error message
            $response= array(
                'status'=>0,
                'message'=> $_SESSION["reg_error_msg"]
             );
            echo json_encode($response);        
        }else{
            //To confirm if email is pre-existent
            $query = " select * from user_auth where email='".$email."' ";
            $result = $conn->query($query);
            $rows_email = mysqli_num_rows($result);           

            if ($rows_email == 1){ 

                //echo "USER ID EXISTS<br/>";
                //collect user's DB data
                while($each_row = mysqli_fetch_array($result)){                 
                     
                    $username_db = $each_row['user_name'];
                    $email_db = $each_row['email'];
                    $verify_key_db=$each_row['verification_id'];
                     
                }
                //
                $hash_email = md5( rand(0,10000) );
                if (isLocal ()){
                    //echo "Website is OFFLINE";
                    //Creating an email verification/account activation link
                    $act_link = 'http://localhost/victorwrk/reset_password.php?&vkey='.$verify_key_db;
                }else{
                    //echo "Website is ONLINE ONLINE ONLINE ONLINE";
                    $act_link = 'http://plconnect.com.ng/reset_password.php?email='.$hash_email.'&vkey='.$verify_key;
                }  
                // Variables for sending email to user, the variables are  use in mail.php
                $user_name=$username_db;
                $state="State";
                $country="Country";
                $link_text="Reset Password";
                $company="Company Name";
                $message="Click on the box below to reset your password.";
                $greeting="Welcome To $company";
                $subject="Password Reset";
                $reason="You received this email because we received a request form you for password reset on $company. If you did not request for password reset on $company , you can safely delete this email.";
                
                // Send email according to request from user
                 $email_message= 
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
                
                
                
                
                include_once('../mail.php');
                  
                    if($mail->send()){
                        $response= array(

                            'status'=>1,
                            'message'=>'<p>Your password reset link has been sent to your e-mail.<br>Kindly check your e-mail to reset your password.</p>'
                        );
                        echo json_encode($response);
                    }else{
                        $response= array(

                            'status'=>0,
                            'message'=>'<p>An Error Occured!</p>
                            <p>Kindly Retry</p>'
                        );
                        echo json_encode($response);
                    }
            }else{ 
                 //  EMAIL DOES NOT EXIST// USER NOT FOUND
                 $response= array(
                    'status'=>0,
                    'message'=>'<p>Invalid Account</p>
                    <p>Try Again</p>'
                );
                echo json_encode($response);
                 
            }        
        }
    }else{
        $response= array(
            'status'=>0,
            'message'=> "Request Invalid"
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