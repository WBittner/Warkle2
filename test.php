<?php

/*
 * Test page
 */
 
 require_once("lib/UsernameAvailabilityQuery.php");
 require_once("lib/Connect.php");
 
 $conn = getDatabaseConnection();
 $pw = $conn->query("SELECT password FROM player WHERE username='Will'")->fetch_assoc()["password"];
 $ex = password_verify("Will", $pw);
 echo $ex;
 //echo pw;
 
 
?>