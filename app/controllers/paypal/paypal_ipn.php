<?php
	include_once "constants.php";
	$error_msg=""; $output_data=""; 

					/**
					 * Get required parameters from the web form for the request
					 */
					//$paymentType =urlencode( $_POST['paymentType']);
					$paymentType =urlencode('Sale');
					$firstName = urlencode($this->data['firstName']);
					$lastName = urlencode($this->data['lastName']);
					$creditCardType = urlencode( $this->data['creditCardType']);
					$creditCardNumber = urlencode($this->data['creditCardNumber']);
					$expDateMonth = urlencode( $this->data['expDateMonth']);
					
					// Month must be padded with leading zero
					$padDateMonth = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);
					
					$expDateYear =urlencode( $this->data['expDateYear']);
					$cvv2Number = urlencode($this->data['cvv2Number']);
					$address1 = urlencode($this->data['address1']);
					$address2 = urlencode($this->data['address2']);
					$city = urlencode($this->data['city']);
					$state =urlencode( $this->data['state']);
					$zip = urlencode($this->data['zip']);
					
					$amount = $this->Session->read('Plan.price');
					$currencyCode="USD";
					
					$profileDesc = urlencode("TurtleSEO - ".ucfirst($this->Session->read('Plan.name'))." plan");
					$billingPeriod = urlencode("Month");
					//$billingPeriod = urlencode("Day");
					$billingFrequency = "1";
					$totalBillingCycles = "12";					
					//$totalBillingCycles = "2";
					$totalBillingCycles = "0";					
					
					$profileStartDate = urlencode(date("Y-m-d",mktime(0,0,0,date("m"),date("d")+1,date("Y"))) . 'T00:00:00Z'); 
					
					// Construct the request string that will be sent to PayPal.
//					   The variable $nvpstr contains all the variables and is a
//					   name value pair string with & as a delimiter 
					if(empty($proile_id) || $proile_status =="Cancel"){
					$nvpstr="&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".         $padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=$state".
					"&ZIP=$zip&COUNTRYCODE=US&CURRENCYCODE=$currencyCode&PROFILESTARTDATE=$profileStartDate&DESC=$profileDesc&BILLINGPERIOD=$billingPeriod&BILLINGFREQUENCY=$billingFrequency&TOTALBILLINGCYCLES=$totalBillingCycles&AutoBillOutstandingAmount=AddToNextBilling";
					}else{						
						$note="Updating the plan to ".ucfirst($this->Session->read('Plan.name'));
						$nvpstr="&ProfileID=$proile_id&Note=$note&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".         $padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=$state".
					"&ZIP=$zip&COUNTRYCODE=US&CURRENCYCODE=$currencyCode&DESC=$profileDesc";
					//$methodName="UpdateRecurringPaymentsProfile";
					}
					
					$getAuthModeFromConstantFile = true;
//					//$getAuthModeFromConstantFile = false;
					$nvpHeader = "&PWD=".urlencode(API_PASSWORD)."&USER=".urlencode(API_USERNAME)."&SIGNATURE=".urlencode(API_SIGNATURE);
					
														
					$nvpstr = $nvpHeader.$nvpstr; 					
					// Make the API call to PayPal, using API signature.
					//The API response is stored in an associative array called $resArray 
					//$resArray=hash_call("CreateRecurringPaymentsProfile",$nvpstr);
					######
					//setting the curl parameters.
						$nvpStr=$nvpstr;
					    $methodName =empty($proile_id)?"CreateRecurringPaymentsProfile":"UpdateRecurringPaymentsProfile";
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
					#####
					
					 //Display the API response back to the browser.
					//If the response from PayPal was a success, display the response parameters'
					//If the response was an error, display the errors received using APIError.php.
					   
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
						
						$display_msg_title ='<font color="#FF0000">Transaction Error</font>';
						$display_msg_content =$resArray['L_LONGMESSAGE0'];
						$display_next_button = '';
										
					   }else{
							$output_data="<table width = 400>";
							foreach($resArray as $key => $value) {    			
							  $output_data .= "<tr><td>$key:</td><td>$value</td>";
							}	
							$output_data .= "</table>";	
							
							$display_msg_title ="Transaction Successfull";
							$display_msg_content ="Thanks for subscribing for ".ucfirst($this->Session->read('Plan.name'))." plan. <p>&nbsp;</p>Your plan has been changed successfully.";	
							$display_next_button = '<input type="button" name="next" value="View Payment Details" onclick="window.location=\'/payments/expressCheckout/3\'" /><p>&nbsp;</p>';
														
							//Getting the Plans Details
							$plan=$this->Plan->findById($this->Session->read('Plan.id'));
							
							$user_data['User']['id']=$this->Session->read('user_id');
							//For Free Plan
							$user_data['User']['plan_type']=$plan['Plan']['name'];
														
							if(mydate_diff($this->set('plan',$user['User']['expiry_date']))){
								//$user_data['User']['expiry_date']=$this->Session->read('Plan.expiry');
							}else{
								$user_data['User']['expiry_date']=date('Y-m-d',strtotime('next month'));
							}							
							
							$user_data['User']['status']=0;
							$user_data['User']['paypal_profile_status']=$resArray['STATUS'];
							$user_data['User']['paypal_profile_id']=$resArray['PROFILEID'];							
							$this->User->save($user_data);
							
							
							//$d['UserPlan'] =array()							
							$d['UserPlan']['id']=$this->Session->read('Plan.user_plan_id');
							$d['UserPlan']['plan_id']=$plan['Plan']['id'];
							$d['UserPlan']['user_id']=$this->Session->read('user_id');
							$d['UserPlan']['price']=$this->Session->read('Plan.price');
							$d['UserPlan']['post_limit']=0;
							$d['UserPlan']['blog_limit']=0;
							$d['UserPlan']['page_limit']=0;
							//$d['UserPlan']['research_limit']=0;
							$d['UserPlan']['report_limit']=0;
							$d['UserPlan']['start_date']=date('Y-m-d');
							$this->UserPlan->save($d);	
							//$this->UserPlan->updateAll($d, array('UserPlan.user_id'=>$this->Session->read('user_id')));   .
							
							if($proile_status =="Suspend"){
								$this->redirect('/payments/expressCheckout/8');
							}
					   }				 
 
			$this->set('output_data',$output_data); 
			$this->set('error_msg',$error_msg);
			
			$this->set('display_msg_title',$display_msg_title); 
			$this->set('display_msg_content',$display_msg_content);
			$this->set('display_next_button',$display_next_button);
			
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

function mydate_diff($start, $end="NOW")
{
        $sdate = strtotime($start);
        $edate = strtotime($end);
		$timeshift=0;
        $time = $edate - $sdate;
        if($time>=0 && $time<=59) {
                // Seconds
                $timeshift = $time.' seconds ';
				 return 0;

        } elseif($time>=60 && $time<=3599) {
                // Minutes + Seconds
                $pmin = ($edate - $sdate) / 60;
                $premin = explode('.', $pmin);
                
                $presec = $pmin-$premin[0];
                $sec = $presec*60;
                
                $timeshift = $premin[0].' min '.round($sec,0).' sec ';
				 return 0;

        } elseif($time>=3600 && $time<=86399) {
                // Hours + Minutes
                $phour = ($edate - $sdate) / 3600;
                $prehour = explode('.',$phour);
                
                $premin = $phour-$prehour[0];
                $min = explode('.',$premin*60);
                
                $presec = '0.'.$min[1];
                $sec = $presec*60;

                $timeshift = $prehour[0].' hrs '.$min[0].' min '.round($sec,0).' sec ';
				 return 0;

        } elseif($time>=86400) {
                // Days + Hours + Minutes
                $pday = ($edate - $sdate) / 86400;
                $preday = explode('.',$pday);

                $phour = $pday-$preday[0];
                $prehour = explode('.',$phour*24); 

                $premin = ($phour*24)-$prehour[0];
                $min = explode('.',$premin*60);
                
                $presec = '0.'.$min[1];
                $sec = $presec*60;
                
                $timeshift = $preday[0].' days '.$prehour[0].' hrs '.$min[0].' min '.round($sec,0).' sec ';
				if( $preday[0]>10) return 1;
				return 0;

        }
        return 0;
}
?>