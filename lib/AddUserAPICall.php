<?php
/*
 * Adds a user to the database
 */
 
 require_once("APICall.php");
 require_once("Connect.php");
 require_once("UsernameAvailabilityQuery.php");
 require_once("AddUserQuery.php");
 require_once("Conf.php");

 //Class to handle the heavy lifting.
 class AddUserAPICall extends APICall
 {
    private $username;
	private $password;
	
	protected function readParameters()
	{
	    $this->username = $this->getParameterValue("username");
		$this->password = $this->getParameterValue("password");
		
		return true;
	}
	
	//attempt to insert the user into the database
	protected function processData()
	{
		//Alpha-num
		sanitizeUsername( $this->username );
		
		//Verify username and password length requirements
		if( strlen( $this->username ) > 40 )
			throw new Exception( "Username must be shorter than 40 characters" );
		if( strlen( $this->username ) > 72 )
			throw new Exception( "Password must be shorter than 72 characters" );
		
		//verify username available
		$conn = getDatabaseConnection();
		$availabilityQuery = new UsernameAvailabilityQuery( $conn, $this->username );
		$available = $availabilityQuery->getNumRows() == 0;
		
		if( $available )//create user
		{
			//hash pw
			$this->password = password_hash( $this->password, PASSWORD_DEFAULT );
			//add user
			$addUserQuery = new AddUserQuery( $conn, $this->username, $this->password );
			$addUserQuery->query();
		}
		else //username taken
			throw new Exception( "Username taken" );
			
		return true;
	}
 }

 
 try
 {
    $apicall = new AddUserAPICall();
	$apicall->activate();
 }
 catch( Exception $e )
 {
	echo $e->getMessage();
 }
 

?>