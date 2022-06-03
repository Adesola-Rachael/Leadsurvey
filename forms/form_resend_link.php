
<?php
// error_reporting(0);
error_reporting(E_ALL);
 
    header('Content-type: application/json');
   
    session_start();

    if ( isset($_POST['submit']) ) 
    {
        
        include_once('../includes/dbConnection.php');

        $_SESSION["resend_err_msg"] = "";
        $resend_link_error_message = "";
        // Checking the value of the input 
        if (isset($_POST['email']) && !empty($_POST['email'])){
            $email = cleanse($_POST['email'],$conn);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $resend_link_error_message .= "- Please Enter a valid Email Address<br/>";
            }
            //echo $email;
         }
        else {
            $resend_link_error_message .= "- Please Enter Your Email Address<br/>";
            //echo $resend_link_error_message;
        }  
        if (isset($_POST['vkey']) && !empty($_POST['vkey'])){
            $vkey = cleanse($_POST['vkey'],$conn);        
         }
        else {
            $resend_link_error_message .= "- You do not have a verification key<br/>";
        } 
        if (isset($_POST['username']) && !empty($_POST['username'])){
            $user_name = cleanse($_POST['username'],$conn);        
         }
        else {
            $resend_link_error_message .= "- You do not have a  Username key<br/>";
        }   

        if($resend_link_error_message != ""){
            
            $_SESSION["resend_err_msg"] = $resend_link_error_message;
        //    return with error message
            $response= array(
                'status'=>0,
                'message'=> $_SESSION["resend_err_msg"]
             );
            echo json_encode($response);        
        }else{
            
            if (isLocal ()){
                //echo "Website is OFFLINE";
                //Creating an email verification/account activation link
                $act_link = 'http://localhost/victorwrk/forms/form_activate.php?email='.$email.'&vkey='.$vkey;
            }else{
                //echo "Website is ONLINE ONLINE ONLINE ONLINE ";
                $act_link = 'http://plconnect.com.ng/assets/forms/form_activate.php?email='.$email.'&vkey='.$vkey;
            }
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
                        'message'=>'<p>Your Activation Link been re-sent to your e-mail.<br>Kindly check your e-mail to activate your account.</p>',
                        'data'=>[
                            'email'=>$email,
                           'vkey'=>$vkey
                        ],
                    );
                    echo json_encode($response);
                }else{
                    $response= array(

                        'status'=>0,
                        'message'=>'<p>Email not sent</p>
                        <p>Kindly Retry</p>'
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

     

    //defining Php Functions
    function isLocal (){//function to check if site is hosted online or is offline
        return !checkdnsrr($_SERVER['SERVER_NAME'], 'NS');
    }

    function sendEmail($friendEmail,$friendName,$dSubject, $msgBody){    
        return TRUE;
    }

     
?>