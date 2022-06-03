<?php
// error_reporting(0);
// error_reporting(E_ALL);
        
    header('Content-type: application/json');
    // session_start();

    if ( isset($_POST['edit_lead_submit']) ) {
        include_once('../includes/dbConnection.php');

        $response = array();
        $errors = array();
        $lead_edit_error_msg = "";
        // collecting and validating form input
        if (isset($_POST['user_id']) && !empty($_POST['user_id'])){
            $user_id = cleanse($_POST['user_id'], $conn); 
        }
        else {
            $lead_edit_error_msg = "LOGIN ERROR<br/>";
        }   

        if (isset($_POST['full_name']) && !empty($_POST['full_name'])){
            $full_name = cleanse($_POST['full_name'], $conn); 
        }
        else {
            $lead_edit_error_msg = "- Please Enter Full Name <br/>";
        }

        if (isset($_POST['gender']) && !empty($_POST['gender'])){
            $gender = cleanse($_POST['gender'],$conn);
        }else{
            $lead_edit_error_msg = "- Please Select gender <br/>";
        }

        if (isset($_POST['agegroup']) && !empty($_POST['agegroup'])){
            $agegroup = cleanse($_POST['agegroup'],$conn);
        }else{
            $lead_edit_error_msg = "- Please Select Age group <br/>";
        } 

        if (isset($_POST['phone']) && !empty($_POST['phone'])){
            $phone = cleanse($_POST['phone'],$conn);           
        }else{
            $lead_edit_error_msg = "- Please Enter Phone number <br/>";
        }  

        if (isset($_POST['email']) && !empty($_POST['email'])){
            $email = cleanse($_POST['email'],$conn);         
        }else{
            $lead_edit_error_msg = "- Please Enter Email <br/>";
        } 

        if (isset($_POST['state']) && !empty($_POST['state'])){
            $state = cleanse($_POST['state'],$conn);           
        }else{
            $lead_edit_error_msg = "- Please Enter State <br/>";
        }  

        if (isset($_POST['country']) && !empty($_POST['country'])){
            $country = cleanse($_POST['country'],$conn);         
        }else{
            $lead_edit_error_msg = "- Please Enter Country <br/>";
        } 

        if (isset($_POST['edit_sn']) && !empty($_POST['edit_sn'])){
            $edit_sn = cleanse($_POST['edit_sn'],$conn);          
        }else{
            $edit_sn = "";
        } 
        // getting country abbreviation from country
        $row=mysqli_fetch_assoc($conn->query("SELECT * FROM countries WHERE countryName='$country' "));
        $cont_abbr=$row['id'];

        if($lead_edit_error_msg != ""){
            //echo $lead_edit_error_msg; 
            $response['success']=true;
            $response['status']='error';  
            $response['message']=$lead_edit_error_msg;   
        }else{

            // check if phone number pre-exists
            $query_lead_1 = "SELECT * FROM  leads WHERE email='".$email."' AND   $edit_sn !=sn ";
            $result_1 = $conn->query($query_lead_1);
            $rows_email=$result_1->num_rows;

            // check if email pre-exists
            $query_lead_2 = "SELECT * FROM  leads WHERE phone_number='".$phone."' AND  $edit_sn !=sn ";
            $result_2 = $conn->query($query_lead_2);
            $rows_phone=$result_2->num_rows;

           if($rows_email==0){
               if($rows_phone == 0){
                    $result = FALSE;     
                    $query_lead = "UPDATE leads SET email='".$email."',  full_name='".$full_name."',  phone_number='".$phone."', country_abbr='".$cont_abbr."',  state='".$state."' ,  country='".$country."' ,  gender='".$gender."' ,  agegroup='".$agegroup."' , time_modified = CURRENT_TIMESTAMP WHERE sn = '$edit_sn'";
                    $result = $conn->query($query_lead);
                    if ($result == 1){
                        // echo success message
                        $response['success']=true;
                        $response['status']='success';  
                        $response['message']='Lead Edited Successfully!'; 
                    }else{
                        //echo "FAILED<br/>";
                        //echo $query_lead;
                        echo mysqli_error($conn);
                        $lead_edit_error_msg = "Query Error!!!, Please Try again later.<br/>";
                        $response['success']=true;
                        $response['status']='error';  
                        $response['message']=$lead_edit_error_msg; 
                    }
                }else{
                    $response['success']=true;
                    $response['status']='error';  
                    $response['message']='Phon Number Already Exist'; 
                }
            }else{
                $response['success']=true;
                $response['status']='error';  
                $response['message']='Email Already Exist'; 
            } 
        }
        echo json_encode($response);
    }else{
        $response['success']=true;
        $response['status']='error';  
        $response['message']='Request Not Submitted';
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