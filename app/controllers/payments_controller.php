<?php
/**
 * $Id: things_controller.php 3 2006-11-08 20:19:09Z thepaper $
 */

class PaymentsController extends AppController
{
    var $name = 'payments';
	var $uses = "User";
	var $components=array('Paypal');
     
	 
	function _get($var)
	{
    	return isset($this->params['url'][$var])? $this->params['url'][$var]: null;
	}
    
	
	function index()
	{	//echo "http://".$_SERVER['SERVER_NAME']."/";
		//exit;
		$this->redirect("/payments/expressCheckout/1");			
	}
	
	
	/*function expressCheckout($step=1)
	{
		//ini_set('display_errors',1);
		//error_reporting(1);
		
		$amt=$this->_detectPlan();
		//$this->Ssl->force();
		$this->set('step',$step);
		//first get a token
		if ($step==1)
		{
			file_put_contents(CONTROLLERS.'tmp.txt',$this->Session->read('user_id'));
		
			// set
			//$paymentInfo['Order']['theTotal']= .01;
			$this->Session->write('amt',$amt);
			$paymentInfo['Order']['theTotal']= $amt;
			
			//$paymentInfo['Order']['theTotal']= .01;
			
			$paymentInfo['Order']['returnUrl']= "http://".$_SERVER['SERVER_NAME']."/payments/expressCheckout/2/";
			$paymentInfo['Order']['cancelUrl']= "http://".$_SERVER['SERVER_NAME']."/dashboards/";
						
			// call paypal
			$result = $this->Paypal->processPayment($paymentInfo,"SetExpressCheckout");
			//pr($result);
			//exit;
			$ack = strtoupper($result["ACK"]);
			//Detect Errors
			if($ack!="SUCCESS")
			$error = $result['L_LONGMESSAGE0'];
			else 
			{
				// send user to paypal
				$token = urldecode($result["TOKEN"]);
				$payPalURL = PAYPAL_URL.$token;
				$this->redirect($payPalURL);
			}
		}
		
		//next have the user confirm
		elseif($step==2)
		{
			//we now have the payer id and token, using the token we should get the shipping address
			//of the payer. Compile all the info into the session then set for the view.
			//Add the order total also
			$result = $this->Paypal->processPayment($this->_get('token'),"GetExpressCheckoutDetails");
			//pr($result);
			$result['PAYERID'] = $this->_get('PayerID');
			$result['TOKEN'] = $this->_get('token');
			$result['ORDERTOTAL'] = $amt;
			$ack = strtoupper($result["ACK"]);
		
			//Detect errors
			if($ack!="SUCCESS"){
			$error = $result['L_LONGMESSAGE0'];
			$this->set('error',$error);
			}
			else {
				$this->Session->write('result',$result);
				$this->set('result',$this->Session->read('result'));
				
				/*
				 * Result at this point contains the below fields. This will be the result passed 
				 * in Step 3. I used a session, but I suppose one could just use a hidden field
				 * in the view:[TOKEN] [TIMESTAMP] [CORRELATIONID] [ACK] [VERSION] [BUILD]  [PAYERID]
				 * [PAYERSTATUS]  [FIRSTNAME][LASTNAME] [COUNTRYCODE] [SHIPTONAME] [SHIPTOSTREET]
				 * [SHIPTOCITY] [SHIPTOSTATE] [SHIPTOZIP] [SHIPTOCOUNTRYCODE] [SHIPTOCOUNTRYNAME]
				 * [ADDRESSSTATUS] [ORDERTOTAL]
				 */
			//}
		//}
		/*/show the confirmation
		elseif($step==3)
		{
			$result = $this->Paypal->processPayment($this->Session->read('result'),"DoExpressCheckoutPayment");
			//Detect errors
			$ack = strtoupper($result["ACK"]);
			if($ack!="SUCCESS"){
			$error = $result['L_LONGMESSAGE0'];
			$this->set('error',$error);
			}
			else {
				 $this->_updateUser($this->Session->read('result'));	
				$this->set('result',$this->Session->read('result'));
			}
		}
	
	} //end function*/
	
	//This function is uede to add the IPN payment Module
	function expressCheckout($step=1){		
		$this->set('step',$step);		
		$this->loadModel('User');
		$this->loadModel('Plan');
		$this->loadModel('UserPlan');
		
		if($this->Session->read('user_id')){			
			$user=$this->User->findById($this->Session->read('user_id'));		
			//print_r($user);
			$proile_id = $user['User']['paypal_profile_id'];
			$proile_status = $user['User']['paypal_profile_status'];
			switch($step){			
				case "1": // The profile fom is shown here, so that user can fill its details. Then its profile will be created.			
					$this->set('user_name',$user['User']['name']);
					$this->set('address',$user['User']['postal_address']);
					$this->set('state',$user['User']['state']);
					$this->set('city',$user['User']['city']);
					$this->set('country',$user['User']['country']);
					$this->set('zip_code',$user['User']['zip_code']);				
					break;	
				case 2: // Now the form is posted by the user after filling up the form.
					//print_r($this->data); //die;
					include_once "paypal/paypal_ipn.php";						
					break;	
				case 3: //to view the profile details
					$proile_id = $user['User']['paypal_profile_id'];
					include_once "paypal/profile_details.php";
					break;	
				case 4: //To suspend the recuring profile
					$proile_id = $user['User']['paypal_profile_id'];
					$action = urlencode("Suspend") ;
					include_once "paypal/changestatus.php";
					$this->redirect('/payments/expressCheckout/3');
					break;
				case 5: //To pay by Paypal Pro
					$this->set('plan_name',ucfirst($this->Session->read('Plan.name')));
					$this->set('amount',$this->Session->read('Plan.price'));
					$this->set('invoice_id',time());					
					break;	
				case 6: //Return from Paypal Pro
					print_r($_REQUEST);					
					$this->set('display_msg_title',"Transaction Successfull");
					$this->set('display_msg_content',"Thanks for subscribing for ".ucfirst($this->Session->read('Plan.name'))." plan. <p>&nbsp;</p>Your plan has been changed successfully.");
					break;	
				case 7: //Cancel by Paypal Pro
					$this->set('display_msg_title',"Transaction Fails");
					$this->set('display_msg_content',"You had cancel the transaction. <p>&nbsp;</p>");
					break;
				case 8: //To activate the recuring profile
					$proile_id = $user['User']['paypal_profile_id'];
					$action = urlencode("Reactivate") ;
					include_once "paypal/changestatus.php";
					$user_data['User']['paypal_profile_status']=$resArray['STATUS'];
					$user_data['User']['paypal_profile_id']=$resArray['PROFILEID'];							
					$this->User->save($user_data);
					$this->redirect('/payments/expressCheckout/3');
					break;																	
			}
		}else{
				//redirecting to login				
				$this->Session->setFlash('Please login');
				$this->redirect('/users/sign_in/');
				exit();
		}
	}
	//This is the function to interact with Paypal fur sving the subscription
	function ipnUpdate(){
		 $this->Paypal->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';  
			 // Paypal is calling page for IPN validation...
   
		  // It's important to remember that paypal calling this script.  There
		  // is no output here.  This is where you validate the IPN data and if it's
		  // valid, update your database to signify that the user has payed.  If
		  // you try and use an echo or printf function here it's not going to do you
		  // a bit of good.  This is on the "backend".  That is why, by default, the
		  // class logs all IPN data to a text file.
		  
		  if ($this->Paypal->validate_ipn()) {
			  
			 // Payment has been recieved and IPN is verified.  This is where you
			 // update your database to activate or process the order, or setup
			 // the database with the user's order details, email an administrator,
			 // etc.  You can access a slew of information via the ipn_data() array.
	  
			 // Check the paypal documentation for specifics on what information
			 // is available in the IPN POST variables.  Basically, all the POST vars
			 // which paypal sends, which we send back for validation, are now stored
			 // in the ipn_data() array.
	  
			 // For this example, we'll just email ourselves ALL the data.
			 $subject = 'Instant Payment Notification - Recieved Payment';
			 $to = 'anoop.srivastava@laitkorc.com';    //  your email
			 $body =  "An instant payment notification was successfully recieved\n";
			 $body .= "from ".$this->Paypal->ipn_data['payer_email']." on ".date('m/d/Y');
			 $body .= " at ".date('g:i A')."\n\nDetails:\n";
			 
			 foreach ($this->Paypal->ipn_data as $key => $value) { 
			 	$body .= "\n$key: $value"; 
			 }
			 
			 if( mail($to, $subject, $body)){
					$this->set("message",$body);				 
			 }else{
			   	    $this->set("message","Error");				 
			 }
		  }
	}
	
	function  _updateUser($result)
	{
		$this->loadModel('User');
		$this->User->id=$this->Session->read('user_id');
		
		$data['User']['join_date']=date('Y-m-d');
		$data['User']['expiry_date']=date('Y-m-d',strtotime('next month'));
		$data['User']['status']=1;
		$this->User->save($data);
		
		$this->loadModel('Transaction');
		$d['Transaction']['user_id']=$this->Session->read('user_id');
		$d['Transaction']['created']=date("Y-m-d H:i:s", strtotime("now"));
		$d['Transaction']['amt']=$result['ORDERTOTAL'];
		$d['Transaction']['status']=1;
		$this->Transaction->save($d);

		//$user_id=file_get_contents(CONTROLLERS.'tmp.txt');
		//$user_id=trim($user_id);
		
		
	}

	/*
		This function detects plan of user and return $amt if user is other than free type. IF user account type is free redirects to dashboard
	*/
	function _detectPlan()
	{
		$this->loadModel('UserPlan');
		$user_id=$this->Session->read('user_id');
		//$user_status=$this->Session->read('user_status');
		
		$plan=$this->UserPlan->query("select plans.name,plans.price,plans.description from plans inner join user_plans on plans.id=user_plans.plan_id where user_plans.user_id=$user_id");
		if(strtolower($plan[0]['plans']['name'])!='free')
		{
			//$this->set('plan_name',$plan[0]['plans']['name']);
			//$this->set('amt',$plan[0]['plans']['price']);
			return $plan[0]['plans']['price'];
		}
		else
		{
			$this->Session->setFlash('You selected a free plan. No need to make payment. Please change plan first.');
			$this->redirect('/dashboards/');
		}
	
	}//end _detectPlan
	
}//end class
?>