<?php
    //defining site-wide variables
    if ( $dir_level == 0 ){
    	$home_dir = "";
    }else if ( $dir_level == 1 ){
    	$home_dir = "../";
    }else if ( $dir_level == 2 ){
    	$home_dir = "../../";
    }else if ( $dir_level == 3 ){
    	$home_dir = "../../../";
    }
	
	//Defining active pages
	$dashboard_active = "";
	$campaigns_active = "";
	$leads_active = "";
	$quizzes_active = "";
	$surveys_active = "";
	$polls_active = "";
	$support_active = "";
	$tutorials_active = "";
	$tickets_active = "";
	$support_open1 = "";
	$support_open2 = "display: none;";

	$user_active = "";
	
	switch ($active_page){
		case 'dashboard' :
			$dashboard_active = "active";
			break;
		case 'campaigns' :			
			$campaigns_active = "active";
			break;	
		case 'leads' :			
			$leads_active = "active";
			break;	
		case 'quizzes' :
			$quizzes_active = "active";
			break;
		case 'surveys' :
			$surveys_active = "active";
			break;	
		case 'polls' :
			$polls_active = "active";
			break;	
		case 'tutorials' :
			$support_active = "active";
			$tutorials_active = "active";
			$support_open1 = "menu-open";
			$support_open2 = "";
			break;
		case 'tickets' :
			$support_active = "active";
			$tickets_active = "active";
			$support_open1 = "menu-open";
			$support_open2 = "";
			break;
	}
?>
