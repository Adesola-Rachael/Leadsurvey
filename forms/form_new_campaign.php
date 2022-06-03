<?php
    session_start();

    if ( isset($_POST['new_campaign_submit']) ) {
        include_once('../includes/dbConnection.php');

        $camp_error_msg = "";

        $_SESSION["camp_title"] = "";
        $_SESSION["camp_descr"] = "";
        $_SESSION["camp_goal"] = "";
        $_SESSION["camp_duration"] = "";
        $_SESSION["camp_feedback_tool"] = "";
        $_SESSION["camp_feedback_data"] = "";


        if (isset($_POST['user_id']) && !empty($_POST['user_id'])){
            $user_id = cleanse($_POST['user_id'], $conn); 
        }
        else {
            $camp_error_msg = "LOGIN ERROR<br/>";
        }   

        if (isset($_POST['title']) && !empty($_POST['title'])){
            $title = cleanse($_POST['title'], $conn);   
            $_SESSION["camp_title"] = $title;        
        }
        else {
            $camp_error_msg = "- Please Enter Title<br/>";
        }

        if (isset($_POST['descr']) && !empty($_POST['descr'])){
            $descr = cleanse($_POST['descr'],$conn);
            $_SESSION["camp_descr"] = $descr;
        }else{
            $descr = "";
        }

        if (isset($_POST['goal']) && !empty($_POST['goal'])){
            $goal = cleanse($_POST['goal'],$conn);
            $_SESSION["camp_goal"] = $goal;            
        }else{
            $goal = "";
        }  
        
        if (isset($_POST['duration']) && !empty($_POST['duration'])){
            $duration = cleanse($_POST['duration'],$conn);
            $_SESSION["camp_duration"] = $duration;       
            $start_date = date("d M Y");
            $end_date = date("d M Y", strtotime($start_date . "+".$duration." weeks"));  
        }else{
            $duration = "";
            $start_date = "";
            $end_date = "";
        }  

        if (isset($_POST['feedback_tool']) && !empty($_POST['feedback_tool'])){
            $feedback_tool = cleanse($_POST['feedback_tool'],$conn);
            $_SESSION["camp_feedback_tool"] = $feedback_tool;            
        }else{
            $feedback_tool = "";
        }  

        if (isset($_POST['feedback_data']) && !empty($_POST['feedback_data'])){
            $feedback_data = cleanse($_POST['feedback_data'],$conn);
            $_SESSION["camp_feedback_data"] = $feedback_data;            
        }else{
            $feedback_data = "";
        } 

       


        if($camp_error_msg != ""){
            //echo "<br/>DOES NOT EXIST<br/>".$camp_error_msg; 
            $_SESSION["camp_error_msg"] = $camp_error_msg;
            header('Location:../campaigns.php?status=camp_error');       
        }else{
            //Send Data to DB
            $result = FALSE;            
            $query_campaign = "INSERT INTO  campaigns ( sn ,  user_id ,  title ,  descr ,  duration ,  goal ,  start_date ,  end_date ,  feedback_tool , feedback_data ,  status ,  time_modified ,  time_created ) 
             VALUES (NULL, '".$user_id."', '".$title."' , '".$descr."' , '".$duration."' , '".$goal."' , '".$start_date."' , '".$end_date."' , '".$feedback_tool."' , '".$feedback_data."' , 'not-started' , CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
            $result = $conn->query($query_campaign);

            if ($result == 1){
                // echo $result;
                header('Location:../campaigns.php?status=camp_success');  
            }else {
                //echo "FAILED<br/>";
                //echo $query_campaign;
                echo mysqli_error($conn);
                $camp_error_msg = "Query Error!!!, Please Try again later.<br/>";
                $_SESSION["camp_error_msg"] = $camp_error_msg;
                header('Location:../campaigns.php?status=camp_error'); 
            }    
        }
    }else{
        ;
    }


    //-----FUNCTIONS DECLARATION----//

    function cleanse($field,$conn) {//To protect against sql Injection
        $result = trim($field);
        $result = stripslashes($result);
        $result = mysqli_real_escape_string($conn, $result); //for prevention of mySQL injection

        return $result;
    }
?>