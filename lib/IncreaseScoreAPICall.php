<?php
/*
 * Increase a players score in the database
 */
 
 require_once("APICall.php");
 require_once("Connect.php");
 require_once("IncreaseScoreQuery.php");
 require_once("Conf.php");

 //Class to handle the heavy lifting.
 class IncreaseScoreAPICall extends APICall
 {
 	private $game;
    private $player;
	private $increaseAmount;
	
	protected function readParameters()
	{
		$this->game = $this->getParameterValue("game");
	    $this->player = $this->getParameterValue("player");
		$this->increaseAmount = $this->getParameterValue("inc");
		
		return true;
	}
	
	//attempt to update the score into the database
	//PRE: assume username is valid, as logged in
	protected function processData()
	{
		//add game
		$conn = getDatabaseConnection();
		$addGameQuery = new IncreaseScoreQuery( $conn, $this->game, $this->player, $this->increaseAmount );
		$addGameQuery->query();
			
		return true;
	}
 }

 
 try
 {
    $apicall = new IncreaseScoreAPICall();
	$apicall->activate();
 }
 catch( Exception $e )
 {
	echo $e->getMessage();
 }
 

?>