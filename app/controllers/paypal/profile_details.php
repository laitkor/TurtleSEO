<?php
require_once 'constants.php';

$output_data="";
$error_msg ="";
$display_next_button = '';

$profileID=urlencode($proile_id);

/* Construct the request string that will be sent to PayPal.
   The variable $nvpstr contains all the variables and is a
   name value pair string with & as a delimiter */
$nvpStr="&PROFILEID=$profileID";

$getAuthModeFromConstantFile = true;
//$getAuthModeFromConstantFile = false;

		$nvpHeader = "&PWD=".urlencode($API_Password)."&USER=".urlencode($API_UserName)."&SIGNATURE=".urlencode($API_Signature);

$nvpStr = $nvpHeader.$nvpStr;

/* Make the API call to PayPal, using API signature.
   The API response is stored in an associative array called $resArray */
//$resArray=hash_call("GetRecurringPaymentsProfileDetails",$nvpStr);
						//$nvpStr=$nvpstr;
					    $methodName ="GetRecurringPaymentsProfileDetails";
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
									  $_SESSION['curl_error_no']=curl_errno($ch) ;
									  $_SESSION['curl_error_msg']=curl_error($ch);
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

 
	/* Next, collect the API request in the associative array $reqArray
	   as well to display back to the browser.
	   Normally you wouldnt not need to do this, but its shown for testing */
	
	//$reqArray=$_SESSION['nvpReqArray'];
	
	/* Display the API response back to the browser.
	   If the response from PayPal was a success, display the response parameters'
	   If the response was an error, display the errors received using APIError.php.
	   */
	$ack = strtoupper($resArray["ACK"]);
			 
			 
	
			if($ack!="SUCCESS")  {
				$_SESSION['reshash']=$resArray;
				/// Displaing the errors
				$error_msg= '<font size=2 color=black face=Verdana><b></b></font>
								<br><br>									
								<b> PayPal API Error</b><br><br>										
								<table width = 400>';
				foreach($resArray as $key => $value) {    									
					$error_msg .= "<tr><td> $key:</td><td>$value</td>";						
				}										
				$error_msg .=	'</table>';	
				
				$display_msg_title ="Error";
				$display_msg_content =$resArray['L_LONGMESSAGE0'];
				$display_next_button = '';
											
			}else{
				$output_data="<table width = 400>";
				foreach($resArray as $key => $value) {    			
				  $output_data .= "<tr><td>$key:</td><td>$value</td>";
				}	
				$output_data .= "</table>";	
				
				$display_msg_title ="Paypal Subscription Details";
				$display_msg_content ='<table border="0" cellpadding="5" cellspacing="1">
										<tr><td><strong>Subscription ID:</strong>&nbsp;</td>									<td>'.$resArray['PROFILEID'].'</td></tr>';
				if(isset($resArray['STATUS']))						
					$display_msg_content .='<tr><td>&nbsp;</td></tr>
										<tr><td><strong>Status:</strong>&nbsp;</td>									<td>'.$resArray['STATUS'].'</td></tr>';
										
				if(isset($resArray['DESC']))						
					$display_msg_content .='<tr><td>&nbsp;</td></tr>	
										<tr><td><strong>Plan:</strong>&nbsp;</td>									<td>'.$resArray['DESC'].'</td></tr>';
										
				if(isset($resArray['REGULARAMT']))						
					$display_msg_content .='<tr><td>&nbsp;</td></tr>
										<tr><td><strong>Plan Price:</strong>&nbsp;</td>									<td>$'.$resArray['REGULARAMT'].'</td></tr>';
										
				if(isset($resArray['PROFILESTARTDATE']))						
					$display_msg_content .='<tr><td>&nbsp;</td></tr>
										<tr><td><strong>Start Date:</strong>&nbsp;</td>									<td>'.date("M d, Y",strtotime($resArray['PROFILESTARTDATE'])).'</td></tr>';
										
				if(isset($resArray['AUTOBILLOUTAMT']))						
					$display_msg_content .='<tr><td>&nbsp;</td></tr>
										<tr><td><strong>Auto Bill Amount:</strong>&nbsp;</td>									<td>'.$resArray['AUTOBILLOUTAMT'].'</td></tr>';
										
				if(isset($resArray['NEXTBILLINGDATE']))						
					$display_msg_content .='<tr><td>&nbsp;</td></tr>	
										<tr><td><strong>Next Billing Date:</strong>&nbsp;</td>									<td>'.date("M d, Y",strtotime($resArray['NEXTBILLINGDATE'])).'</td></tr>';
										
				//if(isset($resArray['FINALPAYMENTDUEDATE']))						
					//$display_msg_content .='<tr><td>&nbsp;</td></tr>
					//					<tr><td><strong>Final Amount Billing Date:</strong>&nbsp;</td>									<td>'.date("M d, Y",strtotime($resArray['FINALPAYMENTDUEDATE'])).'</td></tr>';	
											
				$display_msg_content .='</table>';
				if($resArray['STATUS']=="Active"){
					$display_next_button = '<img src="/img/cancel-subscription.png" name="back" alt="Cancel Subscription" onclick="window.location=\'/payments/expressCheckout/4\'" />';	
				}else{
					//$display_next_button = '<input type="button" name="back" value="Activate Subscription" onclick="window.location=\'/payments/expressCheckout/8\'" />';
				}
				
			}
			
						
	
	$this->set('output_data',$output_data); 
	$this->set('error_msg',$error_msg);	
	$this->set('display_msg_title',$display_msg_title); 
	$this->set('display_msg_content',$display_msg_content);	
	$this->set('display_next_button',$display_next_button);	
	
	function hash_call($methodName,$nvpStr)
    {
	//declaring of global variables
	global $API_Endpoint,$version,$API_UserName,$API_Password,$API_Signature,$nvp_Header, $subject;

	//setting the curl parameters.
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$API_Endpoint);
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
	
	//setting the nvpreq as POST FIELD to curl
	curl_setopt($ch,CURLOPT_POSTFIELDS,$nvpreq);

	//getting response from server
	$response = curl_exec($ch);

	//convrting NVPResponse to an Associative Array
	$nvpResArray=deformatNVP($response);
	$nvpReqArray=deformatNVP($nvpreq);
	$_SESSION['nvpReqArray']=$nvpReqArray;

	if (curl_errno($ch)) {
		// moving to display page to display curl errors
		  $_SESSION['curl_error_no']=curl_errno($ch) ;
		  $_SESSION['curl_error_msg']=curl_error($ch);
		  //$location = "APIError.php";
		  //header("Location: $location");
	 } else {
		 //closing the curl
			curl_close($ch);
	  }

	return $nvpResArray;
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
