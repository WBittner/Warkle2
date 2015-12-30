<?php

/*
 * This class will construct the game info query.
 */

require_once("Query.php");

class GameInfoQuery extends Query
{
	private $game;
	private $player1;
	private $player2;
	private $player1Score;
	private $player2Score;
	private $turn;
	
	function __construct( $conn, $game )
	{
		//set our connection
		parent::__construct( $conn );
		
		$this->game = $game;
		
		$this->sql = "SELECT * FROM game WHERE game_id='$game';";
	}
	
	function fetchGameInfo()
	{
		$result = $this->query();
		
		//once because one game for each game id
		$result = $result->fetch_assoc();
		
		$this->player1 = $result["player1"];
		$this->player2 = $result["player2"];
		$this->player1Score = $result["player1_score"];
		$this->player2Score = $result["player2_score"];
		$this->turn = $result["turn"];
	}
	
	//return assoc array
	function getGameInfo()
	{
		//assume if turn not set, nothing set
		if( !isset( $this->turn ) )
			$this->fetchGameInfo();
		
		$result = array( 
						"game"=>$this->game,
						"player1"=> $this->getPlayer1(),
						"player2"=> $this->getPlayer2(),
						"player1Score"=> $this->getPlayer1Score(),
						"player2Score"=> $this->getPlayer2Score(),
						"turn"=> $this->getTurn()
					   );
					   
		return $result;
	}
	
	function getTurn()
	{
		if( !isset( $this->turn ) )
			$this->fetchGameInfo();
		
		return $this->turn;
	}
	
	function getPlayer1()
	{
		if( !isset( $this->player1 ) )
			$this->fetchGameInfo();
		
		return $this->player1;
	}
	
	function getPlayer2()
	{
		if( !isset( $this->player2 ) )
			$this->fetchGameInfo();
		
		return $this->player2;
	}
	
	function getPlayer1Score()
	{
		if( !isset( $this->player1Score ) )
			$this->fetchGameInfo();
		
		return $this->player1Score;
	}
	
	function getPlayer2Score()
	{
		if( !isset( $this->player2Score ) )
			$this->fetchGameInfo();
		
		return $this->player2Score;
	}
	
	
}

?>