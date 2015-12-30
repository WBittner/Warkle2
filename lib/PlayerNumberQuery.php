<?php

/*
 * This class will construct the determine player number query.
 */

require_once("Query.php");

class PlayerNumberQuery extends Query
{
	
	private $player;
	
	function __construct( $conn, $game, $player )
	{
		//set our connection
		parent::__construct( $conn );
		
		$this->player = $player; 
		
		$this->sql = "SELECT player1, player2 FROM game WHERE game_id='$game';";
	}
	
	function getPlayerNumber()
	{
		$result = $this->query();
		$result = $result->fetch_assoc();
		if( $result["player1"] == $this->player )
			return 1;
		elseif( $result["player2"] == $this->player )
			return 2;
		else//error!
			return 0;
		
	}
}

?>