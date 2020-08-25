<?php
////////////////////////////////////////////////////// Canvas ///////////////////////////////////////////////
class XHECanvas  extends XHEBaseDOMVisual
{
	/////////////////////////////////////////////////////////////////////////////////
	// server initialization
	function __construct($server,$password="")
	{    
		$this->server = $server;
		$this->password = $password;
		$this->prefix = "Canvas";
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////

	// нарисовать картинку с заданным номером
	function draw_image_by_number($number,$path, $frame=-1) 
	{
		$this->wait_element_exist_by_number($number,$frame);		

		$params = array( "number" => $number , "path" => $path , "frame" => $frame );
		return $this->call_boolean(__FUNCTION__,$params);
	}
};		
?>