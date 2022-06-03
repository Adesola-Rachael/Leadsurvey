<?php
	session_start(); // start session

	session_unset(); //clearing all session variables
	if(session_destroy()) // Destroying All Sessions
	{
		header("Location: login.php"); // Redirecting To Home Page
	}
?>

