<?php
 
    // error_reporting(E_ALL);
        
    header('Content-type: application/json');
    
    if(isset($_POST["import"])){
        // DB connection
        include_once('../includes/dbConnection.php');
        $data=array();
        
        // Collecting and validating user _id
        if (isset($_POST['user_id']) && !empty($_POST['user_id'])){
            $user_id = cleanse($_POST['user_id'], $conn);
            if(isset($_FILES['file']['name']))
            {


                $filename = explode(".", $_FILES['file']['name']);
                if (file_exists($_FILES["file"]["tmp_name"])) {
                    if($filename[1] == 'csv')
                    {
                        $handle = fopen($_FILES['file']['tmp_name'], "r");

                        $row=0;
                        $data = fgetcsv($handle, 20000, ",");
                        $myfile=$data;
                        if(count($myfile)==8){
                            while(($data = fgetcsv($handle, 200000, ",")) !== FALSE)//handling csv file 
                            
                            {
                          

                                $row++;

                                if($row == 1) continue;
                               
                                $getphone = cleanse($data[4],$conn);
                                $myphone = explode(" ",$getphone );
                                $newphone=$myphone[1];
                                $cont_abbr=$myphone[0];
                                
                                $name = cleanse($data[1],$conn);
                                $email = cleanse($data[2],$conn);
                                $gender = cleanse($data[3],$conn);
                                $phone = $newphone;
                                $agegroup = cleanse($data[5],$conn );
                                $country = cleanse($data[6],$conn);
                                $state = cleanse($data[7],$conn);

                                            // check if phone number pre-exists
                                $query_lead_1 = "SELECT sn FROM  leads WHERE email='".$email."' ";
                                $result_1 = $conn->query($query_lead_1);
                                $rows_email=$result_1->num_rows;

                                // check if email pre-exists
                                $query_lead_2 = "SELECT sn FROM  leads WHERE phone_number='".$phone."' ";
                                $result_2 = $conn->query($query_lead_2);
                                $rows_phone=$result_2->num_rows;

                                if ($rows_email > 0){  
                                    $query_lead = "UPDATE leads SET email='".$email."',  full_name='name',  country_abbr='".$cont_abbr."', phone_number='".$phone."',  state='".$state."' ,  country='".$country."' ,  gender='".$gender."' ,  agegroup='".$agegroup."' , time_modified = CURRENT_TIMESTAMP email = '$email' AND status !='trashed' ";
                                    $result_email = $conn->query($query_lead);
                                }else if($rows_phone > 0){
                                    $query_lead = "UPDATE leads SET email='".$email."',  full_name='name',  country_abbr='".$cont_abbr."', phone_number='".$phone."',  state='".$state."' ,  country='".$country."' ,  gender='".$gender."' ,  agegroup='".$agegroup."' , time_modified = CURRENT_TIMESTAMP phone_number= '$phone' AND status !='trashed'";
                                    $result_phone = $conn->query($query_lead);
                                }else{
                                        //insert data from CSV file 
                                    $query_lead_import = "INSERT INTO leads(sn, user_id, campaign_id, campaign, lead_tool_id, lead_tool_type, email, full_name, phone_number, country_abbr, state, country, address, gender, agegroup, date_created, status, time_modified, time_created)
                                    VALUES (NULL, '".$user_id."' , 0 , 'Upload', 0 , 'Manual', '".$email."' , '".$name."' , '".$phone."' ,'".$cont_abbr."' , '".$state."' , '".$country."' , NULL , '".$gender."' , '".$agegroup."' , '".date("Y-m-d")."' , 'active' , CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
                                    $result = $conn->query($query_lead_import);
                                }
                                // }else{
                                //     $data['success'] = true;
                                //     $data['status'] = "success";
                                //     $data['message'] = "Incorrect Row Format !" ; 
                                //     echo json_encode($data);
                                // }
                            
                            }
                            fclose($handle);
                            $data['success'] = true;
                            $data['status'] = "success";
                            $data['message'] = "Data imported successfully !" ; 
                            echo json_encode($data);
                        }else{
                            $data['success'] = true;
                            $data['status'] = "error";
                            $data['message'] = "Incorrect File Format! Please Use The Right Format" ; 
                            echo json_encode($data);
                        }
                            
                            
                    }else{
                        $data['success'] = true;
                        $data['status'] = "error";
                        $data['message'] = "Please Choose A CSV file !" ;  
                        echo json_encode($data);
                    }
                }else{
                    $data['success'] = true;
                    $data['status'] = "error";
                    $data['message'] = "File Must Not be Empty !" ;  
                    echo json_encode($data);
                }
            }else{
                $data['success'] = true;
                $data['status'] = "error";
                $data['message'] = "Please Upload A File !" ;  
                echo json_encode($data); 
            } 
            
        }else {
            // $lead_error_msg = "Wrong User Id<br/>";
            $data['success'] = true;
            $data['status'] = "error";
            $data['message'] = "User id Must Not Be Empty !" ;
            echo json_encode($data);
        }         
    }else{
        $data['success'] = true;
        $data['status'] = "error";
        $data['message'] = "Request Not Sent !" ;  
        echo json_encode($data);
    }
   

   
   
     
    
    //-----FUNCTIONS DECLARATION----//
    function cleanse($field,$conn) {//To protect against sql Injection
        $result = trim($field);
        $result = stripslashes($result);
        $result = mysqli_real_escape_string($conn, $result); //for prevention of mySQL injection

        return $result;
    }

   
