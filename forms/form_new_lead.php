<?php
    error_reporting(E_ALL);
        
    header('Content-type: application/json');
    // session_start();
    if ( isset($_POST['new_lead_submit']) ) {
        include_once('../includes/dbConnection.php');

        //preparation for ajax usage
        $errors= array();       // array to hold validation errors
        $response =array();     // array to pass back data

        // declaring page variable
        $lead_error_msg = "";
        // collecting and validating form input
        if (isset($_POST['user_id']) && !empty($_POST['user_id'])){
            $user_id = cleanse($_POST['user_id'], $conn); 
            // echo $lead_error_msg;
        }
        else {
            $lead_error_msg = "LOGIN ERROR<br/>";
        }   

        if (isset($_POST['full_name']) && !empty($_POST['full_name'])){
            $full_name = cleanse($_POST['full_name'], $conn); 
            // echo $lead_error_msg;
        }
        else {
            $lead_error_msg = "- Please Enter Full Name <br/>";
            // echo $lead_error_msg;
        }

        if (isset($_POST['gender']) && !empty($_POST['gender'])){
            $gender = cleanse($_POST['gender'],$conn);
        }else{
            $lead_error_msg = "- Please Select gender <br/>";
            // echo $lead_error_msg;
        }

        if (isset($_POST['agegroup']) && !empty($_POST['agegroup'])){
            $agegroup = cleanse($_POST['agegroup'],$conn);
        }else{
            $lead_error_msg = "- Please Select Age group <br/>";
            // echo $lead_error_msg;
        } 

        if (isset($_POST['phone']) && !empty($_POST['phone'])){
            $phone = cleanse($_POST['phone'],$conn);           
        }else{
            $lead_error_msg = "- Please Enter Phone number <br/>";
            // echo $lead_error_msg;
        }  

        if (isset($_POST['email']) && !empty($_POST['email'])){
            $email = cleanse($_POST['email'],$conn);         
        }else{
            $lead_error_msg = "- Please Enter Email <br/>";
            // echo $lead_error_msg;
        } 

        if (isset($_POST['state']) && !empty($_POST['state'])){
            $state = cleanse($_POST['state'],$conn);           
        }else{
            $lead_error_msg = "- Please Enter State<br/>";
            // echo $lead_error_msg;
        }  

        if (isset($_POST['country']) && !empty($_POST['country'])){
            $country = cleanse($_POST['country'],$conn);         
        }else{
            $lead_error_msg = "- Please Enter Country <br/>";
            // echo $lead_error_msg;
        } 
        // getting country abbreviation from country
        $row=mysqli_fetch_assoc($conn->query("SELECT * FROM countries WHERE countryName='$country' "));
        $cont_abbr=$row['id'];
       


        if($lead_error_msg != ""){
            $response['success']=true;
            $response['status']='error';
            $response['message']=$lead_error_msg;
            
        }else{
            // check if email is pre_existence
            $query_lead_1 = "SELECT * FROM  leads WHERE email='".$email."' ";
            $result_1 = $conn->query($query_lead_1);
            $rows_email=$result_1->num_rows;

             // check if phone number is pre_existence
             $query_lead_2 = "SELECT * FROM  leads WHERE phone_number='".$phone."' ";
             $result_2 = $conn->query($query_lead_2);
             $rows_phone=$result_2->num_rows;
            if($rows_email==0){
                if($rows_phone == 0){

                     //Send Data to DB
                    
                    $result = FALSE;            
                    $query_lead = "INSERT INTO leads(sn, user_id, campaign_id, campaign, lead_tool_id, lead_tool_type, email, full_name, phone_number,country_abbr, state, country, address, gender, agegroup, date_created, status, time_modified, time_created)
                    VALUES (NULL, '".$user_id."' , 0 , 'Upload', 0 , 'Manual', '".$email."' , '".$full_name."' , '".$phone."', '".$cont_abbr."' , '".$state."' , '".$country."' , NULL , '".$gender."' , '".$agegroup."' , '".date("Y-m-d")."' , 'active' , CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
                    $result = $conn->query($query_lead);
                    if($result==1){
                        // Data has been inserted into the db
                        $response['success']=true;
                        $response['status']='success';
                        $response['message']='New Lead Created Successfully!'; 
                    }else{
                        //echo "FAILED<br/>";
                         echo mysqli_error($conn);
                        $lead_error_msg = "Query Error!!!, Please Try again later.<br/>";
                        $response['success']=true;
                        $response['status']='error';
                        $response['message']=$lead_error_msg;  

                    }
                }else{
                        $lead_error_msg = "Phone Number Already Exists<br/>";
                        // Phone Number Exists
                        // $_SESSION["lead_error_msg"] = $lead_error_msg;
                        $response['success']=true;
                        $response['status']='error';
                        $response['message']=$lead_error_msg; 
                }
            }else{
                    $lead_error_msg = "Email Already Exists<br/>";
                    // Phone Number Exists
                    // $_SESSION["lead_error_msg"] = $lead_error_msg;
                    $response['success']=true;
                    $response['status']='error';
                    $response['message']= $lead_error_msg; 
            }
        }
        // return all our data to an AJAX call
        echo json_encode($response);
            
    }else{
        // $response['success']=true;
        // $response['status']='error';
        // $response['message']='Lead Not Created'; 
    }


    //-----FUNCTIONS DECLARATION----//

    function cleanse($field,$conn) {//To protect against sql Injection
        $result = trim($field);
        $result = stripslashes($result);
        $result = mysqli_real_escape_string($conn, $result); //for prevention of mySQL injection

        return $result;
    }
?>