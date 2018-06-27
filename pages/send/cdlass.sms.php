<?php

	class SMSPost {
		
		var $SenderAddress = "" ;		
		var $Destination = "" ;
		var $Message = "" ;
		
		
		function sendSMS() {
			
			$fields = array(
				'type' => 0, 
				'dlr' => 1,
				'destination' => '' . $this->Destination  . '', 
				'source' => ''. $this->SenderAddress .'',
				'message' => ''. $this->Message . '', 
				'username' => 'echi-ksm01', 
				'password' => 'ksm01'
			);			
			
			$options = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query($fields),
				),
			);
			$context  = stream_context_create($options);
			$result = file_get_contents(base64_decode("aHR0cDovL3JzbHIuY29ubmVjdGJpbmQuY29tOjgwODAvYnVsa3Ntcy9idWxrc21z"), false, $context);
			
			$result = explode("|", trim($result)) ;
			
			$rs = array() ;
			
			$rs['status'] = $result[0] == 1701 ? 1 : 0 ;
			
			$rs['msisdn'] = isset($result[1]) ? $result[1] : 0 ;
			
			$rs['smsid'] = isset($result[2]) ? $result : 0 ;
			
			return $rs ;
						
		}
		
		
	}




?>