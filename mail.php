<?php 
 
    // Import PHPMailer classes into the global namespace 
    use PHPMailer\PHPMailer\PHPMailer; 
    use PHPMailer\PHPMailer\Exception; 
    
    require 'PHPMailer/Exception.php'; 
    require 'PHPMailer/PHPMailer.php'; 
    require 'PHPMailer/SMTP.php'; 
    
                     

    if (!checkdnsrr($_SERVER['SERVER_NAME'], 'NS')){
        $mail = new PHPMailer(true); 
 
    $mail->isSMTP(); 
        //echo "Website is OFFLINE";
        $mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers 
        $mail->SMTPAuth = true;               // Enable SMTP authentication 
        $mail->Username = 'vic650283@gmail.com';   // SMTP username 
        $mail->Password = '08163590610';   // SMTP password 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;    
                                        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`                    // TCP port to connect to 
        $mail->setFrom('no-reply@getleadsurge.com', 'Plconnect'); 
        $mail->addReplyTo('no-reply@getleadsurge.com', 'Plconnect'); 
    
    // Add a recipient 
    $mail->addAddress($email); 
    
    //$mail->addCC('cc@example.com'); 
    //$mail->addBCC('bcc@example.com'); 
    
    // Set email format to HTML 
    $mail->isHTML(true); 
    
    // Mail subject 
    // $mail->Subject = 'Activate Account'; 
    
    // Mail body content 
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body   = $email_message;
        
        // SEND EMAIL TO USER
    $mail->send();
        
    }else{
        $sendmailonline=mail($email,$subject,$email_message);
        if($sendmailonline){
            echo 'mail sent';
        }else{
            echo 'mail not sent';
        }
    }
       

?>