<?php
//////////////////////////////////////////////////// InputFile //////////////////////////////////////////////
class XHEInputFile  extends XHEInputFileCompatible
{
	//////////////////////////////////// ��������� ������� /////////////////////////////////////////////
	// server initialization
	function __construct($server,$password="")
	{    
		$this->server = $server;
		$this->password = $password;
		$this->prefix = "InputFile";
	}
   	/////////////////////////////////////////////////////////////////////////////////////////////////////
};		
?>