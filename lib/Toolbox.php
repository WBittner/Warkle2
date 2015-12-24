<?php

/*
 * Page for utility functions
 */
 
 // Format and echo a JSON string
 function prettyPrint( $json )
 {
 	
	echo "<pre>".json_encode( $json, JSON_PRETTY_PRINT )."</pre>";
	
 }
 
 // Check if a username is sanitary ( alpha-numeric )
 function sanitizeUsername( $username )
 {
 	if( !ctype_alnum( $username ) )
	{
		throw new Exception( 'Error: Username "'.$username.'" is invalid. Please only user letters and numbers' );
	}
 }
 
 //query the database to see if the username is available
 //PRE: Username is sanitized!
 function isUsernameAvailable( $username, $conn )
 {
	$result = $conn->query( 'SELECT * FROM player WHERE username='.$username );
	
	return mysqli_num_rows( $result ) == 0;
 }
 
?>