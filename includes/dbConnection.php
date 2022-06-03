<?php
//session_start();

//setting variables for offline and online respectively
if (!checkdnsrr($_SERVER['SERVER_NAME'], 'NS')){
    //echo "Website is OFFLINE";
    $conn = mysqli_connect("localhost","root","","victor_wrk_db");
}else{
    //echo "ONLINE ONLINE ONLINE";
    //$conn = mysqli_connect("localhost","plconnec","ur=^%T62V*c#","plconnec_db");
}


// Check connection
if (mysqli_connect_errno()){
  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}//else{
//echo "Connected Succefully";
//exit();
//} 
  
  
  
  
?>