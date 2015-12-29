<?php

/*
 * This class will construct the add game query.
 */

require_once("Query.php");

class AddGameQuery extends Query
{
	
	function __construct( $conn, $player1, $player2 )
	{
		//set our connection
		parent::__construct( $conn );
		
		$this->sql = "INSERT INTO game(player1, player2) VALUES ('$player1','$player2');";
	}
}

?>