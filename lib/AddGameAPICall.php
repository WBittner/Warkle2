<?php
/*
 * Adds a game to the database
 */
 
 require_once("APICall.php");
 require_once("Connect.php");
 require_once("AddGameQuery.php");
 require_once("RollDiceQuery.php");
 require_once("Conf.php");

 //Class to handle the heavy lifting.
 class AddGameAPICall extends APICall
 {
    private $player1;
	private $player2;
	
	protected function readParameters()
	{
	    $this->player1 = $this->getParameterValue("player1");
		$this->player2 = $this->getParameterValue("player2");
		
		return true;
	}
	
	//attempt to insert the game into the database
	//PRE: assume usernames are valid, as logged in
	protected function processData()
	{
		//add game
		$conn = getDatabaseConnection();
		$addGameQuery = new AddGameQuery( $conn, $this->player1, $this->player2 );
		$addGameQuery->query();
		
		//roll dice
		$dice = array();
		for ($i = 0; $i < 6; $i++) 
		{
  		  array_push( $dice, rand( 1, 6 ) );
		}
		
		$rollDiceQuery = new RollDiceQuery( $conn,  $conn->insert_id, $dice );
		$rollDiceQuery->query();
			
		return true;
	}
 }

 
 try
 {
    $apicall = new AddGameAPICall();
	$apicall->activate();
 }
 catch( Exception $e )
 {
	echo $e->getMessage();
 }
 

?>