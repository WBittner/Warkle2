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
 
 
?>