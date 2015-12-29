<?php
/*
 * User log in
 */
 
 require_once("APICall.php");
 require_once("Connect.php");
 require_once("UsernameAvailabilityQuery.php");
 require_once("AddUserQuery.php");
 require_once("PasswordQuery.php");
 require_once("Conf.php");

 //Class to handle the heavy lifting.
 class LogInAPICall extends APICall
 {
    private $username;
	private $password;
	
	protected function readParameters()
	{
	    $this->username = $this->getParameterValue("username");
		$this->password = $this->getParameterValue("password");
		
		return true;
	}
	
	public function getUsername()
	{
		return $this->username;
	}
	
	//check password
	protected function processData()
	{
		//Alpha-num
		sanitizeUsername( $this->username );
		
		//Verify username and password length requirements
		if( strlen( $this->username ) > 40 )
			throw new Exception( "Username invalid" );
		if( strlen( $this->username ) > 72 )
			throw new Exception( "Password incorrect" );
		
		//verify password
		$conn = getDatabaseConnection();
		$storedPassQuery = new PasswordQuery( $conn, $this->username );
		$storedPassHash = $storedPassQuery->getPassword();
 		$valid = password_verify( $this->password, $storedPassHash );

 		return $valid;	
	}
 }

 
 try
 {
    $apicall = new LogInAPICall();
	$result = $apicall->activate();
	
	if( $result )
	{
		session_start();
	
		$_SESSION["username"] = $apicall->getUsername();
	
		echo "Logged in";
	}
	else
		echo "Incorrect information";
 }
 catch( Exception $e )
 {
	echo $e->getMessage();
 }
 

?>