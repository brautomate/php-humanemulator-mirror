<?php
////////////////////////////////////////////////////// Tr ///////////////////////////////////////////////////
class XHEStyle  extends XHEBaseDOMVisual
{
	/////////////////////////////////////// ��������� ������� //////////////////////////////////////////
	// server initialization
	function __construct($server,$password="")
	{    
		$this->server = $server;
		$this->password = $password;
		$this->prefix = "Style";
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////
};		
?>