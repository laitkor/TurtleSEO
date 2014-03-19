<?php
class AlexaComponent extends Object 
{

	/**
		This function collect basic information from alexa
		makes request to alexa server and parse xml file.
		and returns  array after passing file
		$url=yahoo.com
	*/
	
	function site_info($url)
	{
			define("ACTION", "UrlInfo");
			define("RESPONSE_GROUP", "Rank,ContactInfo,LinksInCount,SiteData");
			$awis_url = $this->_generate_url($url);
			$this->result = $this->_make_http_request($awis_url);
			$this->_setParser();
			return $this->results;
	}//end function
	
	function _setParser()
	{
		// Parse XML and display results
		$this->current_tag = "";
		$this->results="";
		$this->xml_parser  =  xml_parser_create("");
		xml_set_object($this->xml_parser, $this); 
		xml_parser_set_option($this->xml_parser, XML_OPTION_CASE_FOLDING, false);
		xml_set_element_handler($this->xml_parser, "_start_tag", "_end_tag");
		xml_set_character_data_handler($this->xml_parser, "_contents");
		//pr($this->result['url']);
		xml_parse($this->xml_parser, $this->result, true);
		xml_parser_free($this->xml_parser);
		
	}
	
	function _contents($parser, $con)
	 {
	 
		switch ($this->current_tag) {
        case "aws:PhoneNumber":
		                $this->results['phonenumber'] .= $con;
                break;
        case "aws:OwnerName":
		                $this->results['ownername'] .= $con;
                break;
        case "aws:Email":
		                $this->results['email'] .= $con;
                break;
        case "aws:Street":
		                $this->results['street'] .= $con;
                break;
        case "aws:City":
		                $this->results['city'] .= $con;
                break;
        case "aws:State":
		                $this->results['state'] .= $con;
                break;
        case "aws:PostalCode":
		                $this->results['postalcode'] .= $con;
                break;
        case "aws:Country":
		                $this->results['country'] .= $con;
                break;
        case "aws:LinksInCount":
		                $this->results['linksincount'] .=  $con;
                break;
        case "aws:Rank":
		                $this->results['rank'] .=  $con;
						
						$this->rank[]=$con;  //added for traffic history xml reading
                break;
				
		case "aws:Symbol":
		               $this->results['symbol'] .=  $con;
                break;
	
		case "aws:Title":
		               $this->results['title'] .=  $con;
        		break;		
	
		case "aws:Description":
		               $this->results['description'] .=  $con;
        		break;		
	
		case "aws:OnlineSince":
		               $this->results['online_since'] .=  $con;
        		break;		
		
		case "aws:Url":
					$this->links[]=$con;
		                //$this->results['url'] .=  $con.";";    //splitting multiple urls
		               //$this->results[] .=  $con.";";    //splitting multiple urls

                break;		
  		
		case "aws:Date":
				$this->dates[]=$con;
			break;
		
		case "aws:PerMillion":
				$this->per_million[]=$con;
			break;
		case "aws:PerUser":
				$this->per_user[]=$con;
			break;

  	 	 }
	}//end function	

	function _start_tag($parser, $name) 
	{
	    $this->current_tag = $name;
	}

	function _end_tag()
	{
		$this->current_tag = '';
	}


// Returns the AWS url to get AWIS information for the given site

	function _generate_url($site_url) 
	{
        $timestamp =  $this->_generate_timestamp();
        $site_enc = urlencode($site_url);
        $timestamp_enc = urlencode($timestamp);
        $signature_enc = urlencode($this->_calculate_RFC2104HMAC(ACTION . $timestamp, SECRET_ACCESS_KEY));
	
	   	return SERVICE_ENDPOINT
        . "AWSAccessKeyId=".ACCESS_KEY_ID
        . "&Action=".ACTION
        . "&ResponseGroup=".RESPONSE_GROUP
        . "&Timestamp=$timestamp_enc"
        . "&Signature=$signature_enc"
        . "&Url=$site_enc";
	}
	
	

	// Calculate signature using HMAC: http://www.faqs.org/rfcs/rfc2104.html
	function _calculate_RFC2104HMAC ($data, $key) {
    return base64_encode (
        pack("H*", sha1((str_pad($key, 64, chr(0x00))
        ^(str_repeat(chr(0x5c), 64))) .
        pack("H*", sha1((str_pad($key, 64, chr(0x00))
        ^(str_repeat(chr(0x36), 64))) . $data))))
     );
	}

	// Timestamp format: yyyy-MM-dd'T'HH:mm:ss.SSS'Z'

	function _generate_timestamp () {
    return gmdate("Y-m-d\TH:i:s.\\0\\0\\0\\Z", time());
	}

	// Make an http request to the specified URL and return the result

	function _make_http_request($url)
	{
       $ch = curl_init($url);
       curl_setopt($ch, CURLOPT_TIMEOUT, 4);
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       $result = curl_exec($ch);
       curl_close($ch);
       return $result;
	}

}//end class















	
	
	
	
	/*function rank_checker()
	{
		App::import('Vendor', 'nusoap/nusoap');
		// Create the client instance
		$client = new nusoap_client('http://awis.amazonaws.com/AWSAlexa/AWSAlexa.wsdl', true);

		// Check for an error
		$err = $client->getError();

		if ($err) {
		   // Display the error
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
	    // At this point, you know the call that follows will fail
		}
		
		// Create the proxy
		$proxy = $client->getProxy();

		// Call the SOAP method
		$sign=$this->_generate_signature('UrlInfo');
		$time=$this->_generate_timestamp();
		$site_enc = urlencode('www.yahoo.com');
		 
		$security=array('AWSAccessKeyId'=>ACCESS_KEY_ID,'Signature' =>$sign,'Timestamp' =>$time);
		$request = array($security,
						'Url'        => $site_enc,
						'ResponseGroup'  => 'Rank',
		
						);

	//$proxy->($request);
	$result = $proxy->UrlInfo($request);
		
		var_dump($result);
		
		// Check for a fault

		if ($proxy->fault) {

	    echo '<h2>Fault</h2><pre>';
	    print_r($result);
	    echo '</pre>';
		} else {   //start else
		   // Check for errors
		   $err = $proxy->getError();
			if ($err) {
	        // Display the error
	        echo '<h2>Error</h2><pre>' . $err . '</pre>';
		    } else {
		       // Display the result
		        echo '<h2>Result</h2><pre>';
		        print_r($result);
			    echo '</pre>';
			   }
		} //end else

		// Display the request and response
		echo '<h2>Request</h2>';
		echo '<pre>' . htmlspecialchars($proxy->request, ENT_QUOTES) . '</pre>';
		echo '<h2>Response</h2>';
		echo '<pre>' . htmlspecialchars($proxy->response, ENT_QUOTES) . '</pre>';
	
		// Display the debug messages
		echo '<h2>Debug</h2>';
		echo '<pre>' . htmlspecialchars($proxy->debug_str, ENT_QUOTES) . '</pre>';
		//$this->render('rank_checker');
		
	}//end function
	
	function _generate_timestamp () {
    $timestamp=gmdate("Y-m-d\TH:i:s.\\0\\0\\0\\Z", time());
	$timestamp_enc = urlencode($timestamp);
	return $timestamp_enc;
	}
	
	function _generate_signature($action)
	{
		$timestamp=gmdate("Y-m-d\TH:i:s.\\0\\0\\0\\Z", time());
	    $signature_enc = urlencode($this->calculate_RFC2104HMAC($action . $timestamp, SECRET_ACCESS_KEY));
	  	return $signature_enc;
	}

	function calculate_RFC2104HMAC ($mix, $key) {
    return base64_encode (
        pack("H*", sha1((str_pad($key, 64, chr(0x00))
        ^(str_repeat(chr(0x5c), 64))) .
        pack("H*", sha1((str_pad($key, 64, chr(0x00))
        ^(str_repeat(chr(0x36), 64))) . $mix))))
     );
	}
	
	*/
		
	

?>