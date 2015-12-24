<?php

/*
 * This class will construct the add user query.
 */

require_once("Query.php");

class AddUserQuery extends Query
{
	
	function __construct( $conn, $username, $password )
	{
		//set our connection
		parent::__construct( $conn );
		
		$this->sql = "INSERT INTO player(username, password) VALUES ('$username','$password');";
	}
}

?>