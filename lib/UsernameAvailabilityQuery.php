<?php

/*
 * This class will construct the username availability query.
 */

require_once("Query.php");

class UsernameAvailabilityQuery extends Query
{
	
	function __construct( $conn, $username )
	{
		//set our connection
		parent::__construct( $conn );
		
		$this->sql = "SELECT * FROM player WHERE username='".$username."';";
	}
}

?>