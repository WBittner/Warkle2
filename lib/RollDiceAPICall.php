<?php
/*
 * Increase a players score in the database
 */
 
 require_once("APICall.php");
 require_once("Connect.php");
 require_once("RollDiceQuery.php");
 require_once("Conf.php");

 //Class to handle the heavy lifting.
 class RollDiceAPICall extends APICall
 {
 	private $game;
	
	protected function readParameters()
	{
		$this->game = $this->getParameterValue("game");
		
		return true;
	}
	
	//roll dice
	protected function processData()
	{		
		//roll dice
		$conn = getDatabaseConnection();
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
    $apicall = new RollDiceAPICall();
	$apicall->activate();
 }
 catch( Exception $e )
 {
	echo $e->getMessage();
 }
 

?>