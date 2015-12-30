<?php
/*
 * Increase a players score in the database
 */
 
 require_once("APICall.php");
 require_once("Connect.php");
 require_once("ChangeTurnQuery.php");
 require_once("Conf.php");

 //Class to handle the heavy lifting.
 class ChangeTurnAPICall extends APICall
 {
 	private $game;
	
	protected function readParameters()
	{
		$this->game = $this->getParameterValue("game");
		
		return true;
	}
	
	//attempt to update the score into the database
	//PRE: assume username is valid, as logged in
	protected function processData()
	{
		//add game
		$conn = getDatabaseConnection();
		$addGameQuery = new ChangeTurnQuery( $conn, $this->game );
		$addGameQuery->query();
			
		return true;
	}
 }

 
 try
 {
    $apicall = new ChangeTurnAPICall();
	$apicall->activate();
 }
 catch( Exception $e )
 {
	echo $e->getMessage();
 }
 

?>