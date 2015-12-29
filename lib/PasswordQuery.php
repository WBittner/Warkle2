<?php

/*
 * This class will construct the select password query.
 */

require_once("Query.php");

class PasswordQuery extends Query
{
	
	function __construct( $conn, $username )
	{
		//set our connection
		parent::__construct( $conn );
		
		$this->sql = "SELECT password FROM player WHERE username='".$username."'";
	}
	
	function getPassword()
	{
		$result = $this->query();
		$result = $result->fetch_assoc();
		return $result["password"];
	}
}

?>