<?php

/*
 * This class will construct the change turn query.
 */

require_once("Query.php");
require_once("GameInfoQuery.php");

class ChangeTurnQuery extends Query
{
	
	function __construct( $conn, $game )
	{
		//set our connection
		parent::__construct( $conn );
		
		//get turn subquery
		$gameInfo = new GameInfoQuery( $conn, $game );
		$turn = $gameInfo->getTurn();

		$turn = $turn == 1? 2 : 1;
		$this->sql = "UPDATE game 
						SET turn = $turn
						where game_id = $game;";
	}
	
}

?>