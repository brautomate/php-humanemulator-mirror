<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class XHEBrowserCompatible extends XHEBaseObject
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// clear IE cash (in future will replace -> clear_cache)
	function clear_cash()
	{
		return $this->clear_cache("");
	}
        // ��������� ������ ������ ���� ��� ���������� ������
	function disable_download_file_dialog($enable)
	{
		return $this->enable_download_file_dialog($enable==0);
	}
        // ��������� ������������ ������� ������ ���� ��� ���������� ������
	function is_disable_download_file_dialog()
	{		
		return $this->is_enable_download_file_dialog()==0;
	}
     	// �������� ����� � ��������
	function change_cookies_folder($folder)
	{
		$params = array( "folder" => $folder );
		return $this->call_boolean(__FUNCTION__,$params);
	}
     	// �������� ����� � �����
	function change_cache_folder($folder)
	{
		$params = array( "folder" => $folder );
		return $this->call_boolean(__FUNCTION__,$params);
	}
	// ������ ������� (��������� ������� ��������)
	function set_accept($accept_string)
	{
		$params = array( "accept_string" => $accept_string );
		return $this->call_boolean(__FUNCTION__,$params);
   	}
   	// ������ ��������� � �������� (��������� ������� ��������)
	function set_accept_encoding($accept_string)
	{
		$params = array( "accept_string" => $accept_string );
		return $this->call_boolean(__FUNCTION__,$params);
   	}
   	// ������ ����� �������� � �������� (��������� ������� ��������)
	function set_accept_charset($accept_string)
	{
		$params = array( "accept_string" => $accept_string );
		return $this->call_boolean(__FUNCTION__,$params);
   	}	
   	// ������ �������
	function set_referer($referer)
	{
		$params = array( "referer" => $referer );
		return $this->call_boolean(__FUNCTION__,$params);
   	}	
};		
?>