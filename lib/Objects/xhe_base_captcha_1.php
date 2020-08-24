<?php
/////////////////////////////////////////////////////////// XHEBaseCaptcha_1 //////////////////////////////////////////////////////
class XHEBaseCaptcha_1
{
	var $soft_id=0;

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// ����� �������
	var $server='';
	// ���� api 
	var $api_key=null;

	// ���������� �� ������� ����������� (���)
	var $is_verbose = true;
	// ������������ ����� ������� ��������� � �������� (� ������ ttimeout)
	var $max_try=10;

	// ������� ����� ��������� ��������� ������������� ����� (� ��������)
	var $rtimeout = 5;
	// ������� ����� �������� ��������� ����� �� ������
	var $ttimeout = 20;
	// ������������ ����� ��� ��������� ����� (� ��������)
	var $mtimeout = 120;


	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// 0;1	0 = ���� ����� (�������� �� ���������) 1 = ����� ����� ��� �����
	var $is_phrase = 0;
	// 0 = ������� ������ �� ����� �������� (�������� �� ��������� ) 1 = ������� ������ ����� ��������
	var $is_regsense = 0;
	// 0 = �������� �� ������������ (�������� �� ��������� ) 1 = �� ����������� ����� ������, �������� ������ �������� �����
	var $is_question=0;
	// 0 = �������� �� ������������ (�������� �� ���������) 1 = ����� ������� ������ �� ���� (� ���������� ��� ��������� ��������: 2 = ����� ������� ������ �� ���� 3 = ����� ������� ���� ������ �� ����, ���� ������ �� ����.)
	var $is_numeric = 0;
	// 0 = �������� �� ������������ (�������� �� ���������) 1 = ��������� ����� ��������� �������������� �������� � �����
	var $is_calc=0;
	// 0 = �������� �� ������������ (�������� �� ���������) 1..20 = ����������� ���������� ������ � ������
	var $min_len = 0;
	// 0 = �������� �� ������������ (�������� �� ���������)	1..20 = ������������ ���������� ������ � ������
	var $max_len = 0;
	// 0 = �������� �� ������������ (�������� �� ���������) 1 = �� ����� ������ ������������� ����� (� ��������� ��� ��������� �������� 2 = �� ����� ������ ��������� �����)
	var $language = 0;

	// �����, ������� ����� ������� ���������. ����� ��������� � ���� ���������� �� �������� �����. ����������� - 140 ��������. ����� ���������� ����� � ��������� UTF-8. (�������� ��� ��������� ����� ��������)
	var $instructions="";

	// �������� �� ����� - ��������
	var $is_recaptcha=0;
	// ��������� ���������� � �������
	var $textinstructions="";
	// �������� ���������� � �������
	var $imginstructions="";

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// ����� id
	var $last_capcha_id;
	// ��������� ���� �����
	var $last_capcha_filename;
	// ��������� �����������
	var $last_capcha_result;

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // constructor
        function __construct($server)
        {
		$this->server = $server;
        }

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// call a command on the server
	function call($command)
	{
		// call server and return its answer
		$url = "http://".$this->server."/".$command;
		$postvars="";
		if(strstr($url,"?"))
      		{
         		$indexPost=strpos($url,"?",0);
			$postvars=substr($url,$indexPost+1,strlen($url)-$indexPost);
			$url=substr($url,0,$indexPost);
	   	}
      		$postvars=$postvars."  ";
      		$cUrl = curl_init();
      		curl_setopt($cUrl, CURLOPT_URL, $url);
      		curl_setopt($cUrl, CURLOPT_POST,  1); 
      		curl_setopt($cUrl, CURLOPT_POSTFIELDS, $postvars);
      		curl_setopt($cUrl, CURLOPT_RETURNTRANSFER, 1);
      		curl_setopt($cUrl, CURLOPT_TIMEOUT, 60);
      		$html = trim(curl_exec($cUrl));
      		curl_close($cUrl);
	
		return $html;
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// ������ ��������� ������������ �� ���������
	function set_default_params()
	{
		// 0;1	0 = ���� ����� (�������� �� ���������) 1 = ����� ����� ��� �����
		$this->is_phrase = 0;
		// 0 = ������� ������ �� ����� �������� (�������� �� ��������� ) 1 = ������� ������ ����� ��������
		$this->is_regsense = 0;
		// 0 = �������� �� ������������ (�������� �� ��������� ) 1 = �� ����������� ����� ������, �������� ������ �������� �����
		$this->is_question=0;
		// 0 = �������� �� ������������ (�������� �� ���������) 1 = ����� ������� ������ �� ���� 2 = ����� ������� ������ �� ���� 3 = ����� ������� ���� ������ �� ����, ���� ������ �� ����.
		$this->is_numeric = 0;
		// 0 = �������� �� ������������ (�������� �� ���������) 1 = ��������� ����� ��������� �������������� �������� � �����
		$this->is_calc=0;
		// 0 = �������� �� ������������ (�������� �� ���������) 1..20 = ����������� ���������� ������ � ������
		$this->min_len = 0;
		// 0 = �������� �� ������������ (�������� �� ���������)	1..20 = ������������ ���������� ������ � ������
		$this->max_len = 0;
		// 0 = �������� �� ������������ (�������� �� ���������) 1 = �� ����� ������ ������������� �����2 = �� ����� ������ ��������� �����
		$this->language = 0;
		// �����, ������� ����� ������� ���������. ����� ��������� � ���� ���������� �� �������� �����. ����������� - 140 ��������. ����� ���������� ����� � ��������� UTF-8.
		$this->instructions="";
		return true;
	}

	// ���������� ��������
	function recognize_image($filename)
	{
		return $this->recognize($filename, $this->api_key, "http://www.".$this->server,  $this->is_verbose, $this->rtimeout, $this->mtimeout, $this->is_phrase, $this->is_regsense, $this->is_numeric, $this->min_len, $this->max_len,$this->language,$this->is_question,$this->is_calc,$this->instructions,"",0,0);
	}

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// get last capcha id
	function get_last_capcha_id()
	{
            return $this->last_capcha_id;
	}
	// get last capcha file
	function get_last_capcha_filename()
	{
            return $this->last_capcha_filename;
	}
	// get last capcha result
	function get_last_capcha_result()
	{
            return $this->last_capcha_result;
	}
	// report bug capcha
	function report_bug_capcha($key,$id)
	{
            return $this->call("res.php?key=".urlencode($key)."&action=reportbad&id=".urlencode($id));
	}

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/*
	phrase		0;1	
			0 = ���� ����� (�������� �� ���������)
			1 = ����� ����� ��� �����
	regsense	0;1
			0 = ������� ������ �� ����� �������� (�������� �� ��������� )
			1 = ������� ������ ����� ��������
	question	0;1
			0 = �������� �� ������������ (�������� �� ��������� )
			1 = �� ����������� ����� ������, �������� ������ �������� �����
	numeric		0;1;2;3	
			0 = �������� �� ������������ (�������� �� ���������)
			1 = ����� ������� ������ �� ����
			2 = ����� ������� ������ �� ����
			3 = ����� ������� ���� ������ �� ����, ���� ������ �� ����.
	calc		0;1
			0 = �������� �� ������������ (�������� �� ���������)
			1 = ��������� ����� ��������� �������������� �������� � �����
	min_len		0..20
			0 = �������� �� ������������ (�������� �� ���������)
			1..20 = ����������� ���������� ������ � ������
	max_len		1..20	
			0 = �������� �� ������������ (�������� �� ���������)
			1..20 = ������������ ���������� ������ � ������
	language	0;1;2	
			0 = �������� �� ������������ (�������� �� ���������)
			1 = �� ����� ������ ������������� �����
			2 = �� ����� ������ ��������� �����
	instructions     TEXT	�����, ������� ����� ������� ���������. ����� ��������� � ���� ���������� �� �������� �����. ����������� - 140 ��������. ����� ���������� ����� � ��������� UTF-8.
	textcaptcha	 TEXT	��������� �����. �������� ��� ���� �� �����������, �������� �������� ������ ����� � ������ ����� �� ���� �����. ����������� - 140 ��������. ����� ���������� ����� � ��������� UTF-8.

	������: ������ ������� �� �������� �����:

	ERROR_WRONG_USER_KEY			�� ������ ������ ��������� key, ������ ���� 32 �������
	ERROR_KEY_DOES_NOT_EXIST		����������� �������������� key
	ERROR_ZERO_BALANCE	��������	������ ������ �������� �������
	ERROR_NO_SLOT_AVAILABLE	��������	������� ������ ������������� ����, ��� ����������� ������������� � ���������� ������ ��������. ���� �� ������� ��������� ������� � ��������� �� �������� � ���������, ��������� �������� ����� 5 ������.
	ERROR_ZERO_CAPTCHA_FILESIZE		������ ����� ������ 100 ����
	ERROR_TOO_BIG_CAPTCHA_FILESIZE		������ ����� ����� 100 �����
	ERROR_WRONG_FILE_EXTENSION		���� ����� ����� �������� ����������, ���������� ���������� jpg,jpeg,gif,png
	ERROR_IMAGE_TYPE_NOT_SUPPORTED		������ �� ����� ���������� ��� ����� �����
	ERROR_IP_NOT_ALLOWED			� ����� �������� ��������� ����������� �� IP � ������� ����� ������ �������. � IP, � �������� ������ ������ ������ �� ������ � ������ �����������.
	IP_BANNED				IP-�����, � �������� ������ ������ ������������ ��-�� ������ ��������� � ���������� ��������� �������. ���������� ��������� ����� ���

	������: ������ ������� �� �������� �����:

	ERROR_KEY_DOES_NOT_EXIST		�� ������������ �������� key � �������
	ERROR_WRONG_ID_FORMAT			�������� ������ ID �����. ID ������ ��������� ������ �����
	ERROR_CAPTCHA_UNSOLVABLE		����� �� ������ ��������� 3 ������ ���������. ��������� �������� �� ��� ����������� ������������ ������� �� ������
	ERROR_WRONG_CAPTCHA_ID			�� ��������� �������� ����� �� ����� ��� ������������ �� �����, ������� ���� ��������� ����� 15 ����� �����
	ERROR_BAD_DUPLICATES			������ ���������� ��� ���������� 100%� �����������. ���� ������������ ������������ ���������� �������, �� ����������� ���������� ���������� ������� �� ���� �������
	*/

	// ���������� �����
	function recognize($filename, $apikey, $path ='',  $is_verbose = true, $rtimeout = 5, $mtimeout = 120, $is_phrase = 0, $is_regsense = 0, $is_numeric = 0, $min_len = 0, $max_len = 0,$language = 0,$is_question=0,$is_calc=0,$instructions="",$textcaptcha="",$id_constructor=0,$is_invoice=0,
		$is_recaptcha=0,$textinstructions="",$imginstructions="",$coordinatescaptcha=0,$method="",$angle=0,$file_1="",$file_2="",$file_3="",$is_audio_recaptcha=0,$is_solveaudio=0)
	{
		// �������� apikey
		if ($apikey=="")
		{
			if ($this->api_key=="")
			{
				echo "API key is not setted\n";
				return false;
			}
			else
				$apikey=$this->api_key;
		}

		// ������� ������ �� ���������� �����
		$this->last_capcha_id=-1;
		$this->last_capcha_filename=$filename;
		
		// ���������� ���� �����
		$curl_file=null;
		if (!file_exists($filename) && $textcaptcha=="")
		{
			// ���
			if ($is_verbose) 
				echo "file $filename not found\n";
			$this->last_capcha_result=false;
			return false;
		}
		$curl_file = curl_file_create($filename);

		// ���������� ���� ���������� ���������� � �������
		$imginstructions_file=null;
		if ($imginstructions!="" && !file_exists($imginstructions))
		{
			// ���
			if ($is_verbose) 
				echo "file $imginstructions not found\n";
			$this->last_capcha_result=false;
			return false;
		}
		if ($imginstructions!="")
			$imginstructions_file = curl_file_create($imginstructions);
		
		// ���������� ���� 1 rotate captcha
		$file_1_file=null;
		if ($file_1!="")
			$file_1_file = curl_file_create($file_1);
		
		// ���������� ���� 2 rotate captcha
		$file_2_file=null;
		if ($file_2!="")
			$file_2_file = curl_file_create($file_2);

		// ���������� ���� 3 rotate captcha
		$file_3_file=null;
		if ($file_3!="")
			$file_3_file = curl_file_create($file_3);

		// ������������ post ���������
		$postdata = array(			
			'key'       => $apikey, 
			'soft_id'	=> $this->soft_id );
		// �������������� post ���������
		if ($filename!="" && $textcaptcha=="")
			$postdata['file']  = $curl_file;
		if ($is_phrase!=0)
			$postdata['phrase'] = $is_phrase;
		if ($is_regsense!=0)
			$postdata['regsense'] = $is_regsense;
		if ($is_question!=0)
			$postdata['question'] = $is_question;
		if ($is_calc!=0)
			$postdata['calc'] = $is_calc;
		if ($is_numeric!=0)
			$postdata['numeric'] = $is_numeric;
		if ($min_len!=0)
			$postdata['min_len'] = $min_len;
		if ($max_len!=0)
			$postdata['max_len'] = $max_len;
		if ($language!=0)
                {
			$postdata['language'] = $language;
                        $postdata['is_russian'] = $language;
                }
		if ($instructions!="")
			$postdata['textinstructions'] = $instructions;
		if ($textcaptcha!="")
			$postdata['textcaptcha'] = $textcaptcha;
		if ($id_constructor!=0)
			$postdata['id_constructor'] = $id_constructor;
		if ($is_recaptcha!=0)
			$postdata['is_recaptcha'] = $is_recaptcha;
		if ($textinstructions!="")
			$postdata['textinstructions'] = $textinstructions;
		if ($imginstructions_file!=null)
			$postdata['imginstructions'] = $imginstructions_file;
		if ($coordinatescaptcha!=0)
			$postdata['coordinatescaptcha'] = $coordinatescaptcha;
		if ($method!="")
			$postdata['method'] = $method;
		if ($angle!=0)
			$postdata['angle'] = $angle;
		if ($file_1_file!=null)
			$postdata['file_1'] = $file_1_file;
		if ($file_2_file!=null)
			$postdata['file_2'] = $file_2_file;
		if ($file_3_file!=null)
			$postdata['file_3'] = $file_3_file;
		if ($is_audio_recaptcha!=0)
			$postdata['recaptchavoice'] = 1;
		else if ($is_solveaudio!=0)
			$postdata['solveaudio'] = 1;

		$result = "";
		for ($i=0;$i<$this->max_try;$i++)
		{
			// ������� ������
			$ch = curl_init();
			if ($is_invoice!=0)
				curl_setopt($ch, CURLOPT_URL,             $path.'/in_invoice.php');
			else
				curl_setopt($ch, CURLOPT_URL,             $path.'/in.php');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,     1);
			curl_setopt($ch, CURLOPT_TIMEOUT,             60);
			curl_setopt($ch, CURLOPT_POST,                 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,         $postdata);
			$result = curl_exec($ch);

			// �� ����� ������� ��������� ����
			if (curl_errno($ch)) 
			{
				// ���
    				if ($is_verbose) 
					echo "CURL returned error: ".curl_error($ch)."\n";
				$this->last_capcha_result=false;
				return false;
			}

			// ������� ������
			curl_close($ch);

			// ��� ��������� ������
			if (strpos($result, "ERROR_NO_SLOT_AVAILABLE")!==false)
			{
				// ���
    				if ($is_verbose) 
					echo " ERROR_NO_SLOT_AVAILABLE => try_".($i+1)." ";
				if ($is_verbose) 
					echo "waiting for $this->ttimeout seconds\n";
				sleep($this->ttimeout);
				continue;
			}
			// ������ ������ ������ ����������
			if (strpos($result, "ERROR")!==false)
			{
				// ���
    				if ($is_verbose) 
					echo "server returned error: $result\n";
				$this->last_capcha_result=false;
				return false;
			}
			// ������ ������ ������ - ��������
			if (strpos($result, 'IP_BANNED')!==false)
			{
				// ���
	       			if ($is_verbose) 
					echo "server returned banned: $result\n";
				$this->last_capcha_result=false;
				return false;
			}
			break;
		}
		
		
		// ������� captcha id
		if ($is_invoice==0)
		{
			$ex = explode("|", $result);		
			if ($is_verbose)
				echo $result."\n";
			if ($ex[0]!="OK")
			{
				// ���
       				if ($is_verbose) 
					echo "server not return captcha id: $result\n";
				$this->last_capcha_result=false;
				return false;
			}
			$captcha_id = $ex[1];
		}
		else
		{
			$ex = explode("\"", $result);		
			if ($is_verbose)
				echo $result."\n";
			if ($ex[2]!=":1,")
			{
				// ���
       				if ($is_verbose) 
					echo "server not return captcha id: $result\n";
				$this->last_capcha_result=false;
				return false;
			}
			$captcha_id = $ex[5];
		}
		$this->last_capcha_id=$captcha_id;

		// ���
    		if ($is_verbose) 
			echo "captcha sent, got captcha ID $captcha_id\n";

		// ���� ������� 1
		$waittime = 0;
		if ($is_verbose) 
			echo "waiting for $rtimeout seconds\n";
		if ($is_invoice==0)
			sleep($rtimeout);
		else
			sleep(60);

		
		// ������� ��� ����� (�����)
		while(true)
		{
			// �������� ��������� ����������� �����
			if (strpos($result, 'OK|')==false)
			{
				if ($is_invoice!=0)
					$result = file_get_contents($path.'/res_invoice.php?key='.$apikey.'&soft_id='.$this->soft_id.'&action=get&id='.$captcha_id);
				else
					$result = file_get_contents($path."/res.php?key=".$apikey."&soft_id=".$this->soft_id."&action=get&id=".$captcha_id);
			}

			// ������ ������ ������ ���������� 
			if (strpos($result, 'ERROR')!==false)
			{
				// ���
            			if ($is_verbose) 
					echo "server returned error: $result\n";
				$this->last_capcha_result=false;
				return false;
			}
			
			if (strpos($result, 'CAPCHA_NOT_READY')!==false)
			{
            			if ($is_verbose) echo "captcha is not ready yet\n";
            			$waittime += $rtimeout;
            			if ($waittime>$mtimeout) 
            			{
            				if ($is_verbose) 
						echo "timelimit ($mtimeout) hit\n";				
            				break;
            			}
        			if ($is_verbose) 
					echo "waiting for $rtimeout seconds\n";
				if ($is_invoice==0)
            				sleep($rtimeout);
				else
            				sleep(20);
				continue;
			}

			// ������� �����			
			if ($is_invoice==0)
			{
	          		$ex = explode('|', $result);
        	    		if (trim($ex[0])=='OK') 
				{
					$this->last_capcha_result=trim($ex[1]);
			   		return trim($this->last_capcha_result);
				}
			}
			else
			{
				if (strpos($result, 'status":1')!==false)
				{
					$this->last_capcha_result=$result;
					return trim($this->last_capcha_result);
				}
			}
		}
        
		// �� ���������
		$this->last_capcha_result=false;
		return false;
		
	}

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
};
?>