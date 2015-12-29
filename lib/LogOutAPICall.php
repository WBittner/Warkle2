<?php
/*
 * User log out
 */
 
 try
 {
	session_start();
	
	$_SESSION["username"] = null;
	
	echo "Logged out";
 }
 catch( Exception $e )
 {
	echo $e->getMessage();
 }
 

?>