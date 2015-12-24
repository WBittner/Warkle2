<?php

/*
 * Super class for Query classes
 */
 
abstract class Query
{
	protected $sql;
	private $connection;
	
	function __construct( $conn ) 
	{
		$this->connection = $conn;
	}
	
	function query()
	{
		if( isset( $this->sql ) )
		{
			$result = $this->connection->query( $this->sql );
			if( $result === FALSE )
				throw new Exception( 'Sql in '.get_class($this).' errored.' );
		}
		else
			throw new Exception( 'Sql not set in '.get_class($this).' query ' );
		
		return $result;
	}
	
	function getNumRows()
	{
		$result = $this->query();
		return mysqli_num_rows( $result );
	}
	
}

?>