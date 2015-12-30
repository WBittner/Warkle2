<?php

/*
 * This class will construct the roll dice query when supplied with an array of 6 integers.
 */

require_once("Query.php");

class RollDiceQuery extends Query
{
	
	function __construct( $conn, $game, $dice )
	{
		//set our connection
		parent::__construct( $conn );
		
		$this->sql = "UPDATE game 
						SET ";
						
		for ($i = 1; $i <= 6; $i++) 
		{
			$this->sql.="dice$i = ".$dice[$i-1].", ";
		}
		
		//remove trailing comma
		$this->sql = substr( $this->sql, 0, -2 )." where game_id = $game;";
	}
	
}

?>