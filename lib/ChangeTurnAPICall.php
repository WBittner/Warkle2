<?php
/*
 * Increase a players score in the database
 */
 
 require_once("APICall.php");
 require_once("Connect.php");
 require_once("ChangeTurnQuery.php");
 require_once("RollDiceQuery.php");
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
		//update turn game
		$conn = getDatabaseConnection();
		$changeTurnQuery = new ChangeTurnQuery( $conn, $this->game );
		$changeTurnQuery->query();
		
		//reroll dice
		$dice = array();
		for ($i = 0; $i < 6; $i++) 
		{
  		  array_push( $dice, rand( 1, 6 ) );
		}
		
		$rollDiceQuery = new RollDiceQuery( $conn, $this->game, $dice );
		$rollDiceQuery->query();
			
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