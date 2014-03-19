<?php

include_once "constants.php";
$error_msg=""; $output_data=""; 

$profileID=urlencode($proile_id);

//$action = urlencode("Cancel") ;



$this->set("display_msg_title","Please wait while your Subscription in being updated.");

/* Construct the request string that will be sent to PayPal.
   The variable $nvpstr contains all the variables and is a
   name value pair string with & as a delimiter */
$nvpStr="&PROFILEID=$profileID&ACTION=$action";


$nvpStr = "&PWD=".urlencode($API_Password)."&USER=".urlencode($API_UserName)."&SIGNATURE=".urlencode($API_Signature).$nvpStr;

/* Make the API call to PayPal, using API signature.
   The API response is stored in an associative array called $resArray */
//$resArray=hash_call("ManageRecurringPaymentsProfileStatus",$nvpStr);

					######
					//setting the curl parameters.
				
					    $methodName ="ManageRecurringPaymentsProfileStatus";
						if(function_exists("curl_init")){
								$ch = curl_init();
								curl_setopt($ch, CURLOPT_URL,API_ENDPOINT);
								curl_setopt($ch, CURLOPT_VERBOSE, 1);
							
								//turning off the server and peer verification(TrustManager Concept).
								curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
								curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
							
								curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
								curl_setopt($ch, CURLOPT_POST, 1);
								//if USE_PROXY constant set to TRUE in Constants.php, then only proxy will be enabled.
							   //Set proxy name to PROXY_HOST and port number to PROXY_PORT in constants.php 
								if(USE_PROXY)
									curl_setopt ($ch, CURLOPT_PROXY, PROXY_HOST.":".PROXY_PORT); 
							
								//check if version is included in $nvpStr else include the version.
								if(strlen(str_replace('VERSION=', '', strtoupper($nvpStr))) == strlen($nvpStr)) {
									$nvpStr = "&VERSION=" . urlencode($version) . $nvpStr;	
								}
								
								$nvpreq="METHOD=".urlencode($methodName).$nvpStr;
								//NVPRequest for submitting to server
       // $nvpreq="METHOD=".urlencode($methodName)."&VERSION=".urlencode($version)."&PWD=".urlencode($API_Password)."&USER=".urlencode($API_UserName)."&SIGNATURE=".urlencode($API_Signature).$nvpStr;
    
								
								//setting the nvpreq as POST FIELD to curl
								curl_setopt($ch,CURLOPT_POSTFIELDS,$nvpreq);
							
								//getting response from server
								$response = curl_exec($ch); 
							
								//convrting NVPResponse to an Associative Array
								$nvpResArray=deformatNVP($response);
								$nvpReqArray=deformatNVP($nvpreq);
								//$_SESSION['nvpReqArray']=$nvpReqArray;
							
								if (curl_errno($ch)) {
									// moving to display page to display curl errors									
									  $error_msg ='<table width="400">
									  	<tr><td>Error Number:</td>
											<td>'.curl_errno($ch).'</td>
										</tr>
										<tr>
											<td>Error Message:</td>
											<td>'.curl_error($ch).'</td>
										</tr></table>';									  
								 } else {
									 //closing the curl
										curl_close($ch);
								  }	
								  $resArray =	$nvpResArray;
						}						
					   #####

/* Next, collect the API request in the associative array $reqArray
   as well to display back to the browser.
   Normally you wouldnt not need to do this, but its shown for testing */

//$reqArray=$_SESSION['nvpReqArray'];

/* Display the API response back to the browser.
   If the response from PayPal was a success, display the response parameters'
   If the response was an error, display the errors received using APIError.php.
*/
$ack = strtoupper($resArray["ACK"]);

if($ack!="SUCCESS"){
		//$_SESSION['reshash']=$resArray;
		//$location = "../APIError.php";
		//header("Location: $location");		
		
	}else{	
		if($resArray['STATUS']=="Suspend" || $resArray['STATUS']=="Cancel"){
				$user_data['User']['plan_type']="free";
				$user_data['User']['expiry_date']='';
				$user_data['User']['status']=1; //for free, payment stattus 1
		}
		$user_data['User']['id']=$this->Session->read('user_id');
		$user_data['User']['paypal_profile_status']=$resArray['STATUS'];
		$user_data['User']['paypal_profile_id']=$resArray['PROFILEID'];							
		$this->User->save($user_data);	
	}
	
	
	function deformatNVP($nvpstr)
{ 
	$intial=0;
 	$nvpArray = array();


	while(strlen($nvpstr)){
		//postion of Key
		$keypos= strpos($nvpstr,'=');
		//position of value
		$valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);

		/*getting the Key and Value values and storing in a Associative Array*/
		$keyval=substr($nvpstr,$intial,$keypos);
		$valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
		//decoding the respose
		$nvpArray[urldecode($keyval)] =urldecode( $valval);
		$nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
     }
	return $nvpArray;
}

?>