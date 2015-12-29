<?php

/*
 * Super class for API calls. Shared functions between API calls go here.
 */

abstract class APICall
{
	//In subclasses, this will call getParameterValue with the correct parameter names
	abstract protected function readParameters();
	
	//In subclasses, this will process whatever data the API call needs to process
	abstract protected function processData();
	
	//Activate the API call - read the 
	public function activate()
	{
	    $resultParam = $this->readParameters();
		$resultProcess = $this->processData();
		
		if( $resultParam && $resultProcess )
			return true;		
		else
			return false;
	}
	
	//Grab value set to a parameter. If parameter is not set and required is false, return null
	//Returns the value of the parameter, or null if not supplied and not required
	protected function getParameterValue( $paramName, $required=true )
	{
		if( !isset( $_GET[ $paramName ] ) )
		{
			if( $required )
				 throw new Exception( 'API call error on "'.get_class($this).'."'
				 						.PHP_EOL.'Required parameter "'.$paramName.'" not supplied.');
			else//required == false
				return null;
		}
		else //is set
		{
			return $_GET[ $paramName ];
		}
	}
}

?>