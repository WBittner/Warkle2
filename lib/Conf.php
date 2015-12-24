<?php

//Config File. Various globals set here.
function getConf()
{
	$config = array(
		"db" => array(
			"name" => "warkle",
			"username" => "root",
	        "password" => "",
	        "host" => "localhost" ),
	    "debug" => true
	);
	
	return $config;
}

?>