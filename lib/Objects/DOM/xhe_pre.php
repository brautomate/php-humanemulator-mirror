<?php
////////////////////////////////////////////////////// Pre //////////////////////////////////////////////////
class XHEPre  extends XHEBaseDOMVisual
{
	/////////////////////////////////////// ��������� ������� //////////////////////////////////////////
	// server initialization
	function __construct($server,$password="")
	{    
		$this->server = $server;
		$this->password = $password;
		$this->prefix = "Pre";
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////
};		
?>