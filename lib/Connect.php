<?php
 
/*
 * Grab a connection to the database
 */

require_once("Conf.php");
require_once("Toolbox.php");

//Grab a connection to the database
function getDatabaseConnection()
{
	$conf = getConf();
	$db = $conf['db'];
	
    $databaseConnection = new mysqli( $db['host'], $db['username'], $db['password'], $db['name'] );
    
    if ( $databaseConnection->connect_error )
    {
        throw new Exception( "Could not connect to database." );
    }
	
    return $databaseConnection;
} 

?>
