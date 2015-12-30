<?php

/*
 * This class will construct the increase score query.
 */

require_once("Query.php");
require_once("PlayerNumberQuery.php");

class IncreaseScoreQuery extends Query
{
	
	function __construct( $conn, $game, $player, $increaseAmount )
	{
		//set our connection
		parent::__construct( $conn );
		
		//subquery to figure out if we are increasing player 1 or player 2
		$playerNumberQuery = new PlayerNumberQuery( $conn, $game, $player );
		
		//player number returned as number, so we can just concatenate into a string
		$playerNumber = $playerNumberQuery->getPlayerNumber();
		
		$this->sql = "UPDATE game 
						SET player".$playerNumber."_score = player".$playerNumber."_score + $increaseAmount
						where game_id=$game;";
	}
}

?>