<?php
session_start();
class UsersController extends AppController
{ 

		var $name = 'users';
		var $helpers = array('Javascript','Ajax');
		var $components=array('Email','Recaptcha','SwiftMailer','Twitter');
		
	function index()
	{
		$this->edit();
		//$this->render('index');
	}
	/**
		This function is used to sign up user.
	**/
	function sign_up()
	{	
 	
		$userid = $this->Session->read('user_id');
		if(isset($userid))
		{	
			$this->Session->setFlash('<font color=green>You already have an account.</font>');
			$this->redirect('/dashboards/index/');
		}
		$this->loadModel('Plan');
		$this->loadModel('UserPlan');

	
	include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';

	$securimage = new Securimage();
		if (isset($_POST['captcha_code']) && $securimage->check($_POST['captcha_code']) == false) {
	// the code was incorrect
	// you should handle the error so that the form processor doesn't continue

	// or you can use the following code if there is no validation or you do not know how
	echo "The security code entered was incorrect.<br /><br />";
	echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
	exit;
	}
		if(!empty($this->data))
		{
			//	print_r($this->params['form']);exit;
			//if(!$this->Recaptcha->valid($this->params['form']))
			if(false)
			{
  				//$this->set("error_msg","Please enter correct words in captcha.");
			}
			//pr($this->data);
			else
			{
				$plan_id=$this->data['User']['plan_type'];
				$this->Plan->id=$plan_id ; //setting id of plan
				$plan=$this->Plan->read('name');
				if(strtolower($plan['Plan']['name']) != 'free')
				{	
					$this->data['User']['expiry_date']=date('Y-m-d',strtotime('next month'));
					$this->data['User']['status']=0;  //
				}
				else
				{
					$this->data['User']['expiry_date']='';
					$this->data['User']['status']=1;   //for free payment stattus 1
				}
				$this->data['User']['plan_type']=$plan['Plan']['name'];  //then passing value to data for saving
				$this->data['User']['join_date']=date('Y-m-d');
				$this->data['User']['role_id']=1;  //this is static now,in later will change
				//$this->data['User']['status']=0;   //status is 0(user payment .we this to detect user has make payment or not ) 
				$this->data['User']['verified']=0;  //used for verification
				
				$plan=$this->Plan->findById($plan_id);
				if ($this->User->save($this->data)) 
				{
					$user_id=$this->User->id;
					$d['UserPlan']['user_id']=$user_id;
					$d['UserPlan']['plan_id']=$plan_id;
					$d['UserPlan']['start_date']=date('Y-m-d');
					$d['UserPlan']['created']=date("Y-m-d H:i:s", strtotime("now"));
					$d['UserPlan']['post_limit']=$plan['Plan']['post_limit'];
					$d['UserPlan']['blog_limit']=$plan['Plan']['blog_limit'];
					$d['UserPlan']['page_limit']=$plan['Plan']['page_limit'];
					$d['UserPlan']['research_limit']=$plan['Plan']['report_limit'];
					$d['UserPlan']['report_limit']=$plan['Plan']['report_limit'];
					//add manish for adding 
					$this->UserPlan->save($d);
					$this->_adminMail($user_id,array('name' => $this->data['User']['name'],'email' => $this->data['User']['email'],'answer' => $this->data['User']['security_answer']),$to);
					//$this->Session->setFlash('Account is successfully created. Login to gain access.');
				$this->Session->setFlash('Account is successfully created. You will receive confirmation mail within 24 Hrs. ');
					
					$this->redirect('/users/sign_in');
				}
			}	
		}//end empty	
		
		
		$plans=$this->Plan->find('list',array('fields' => 'Plan.name'));
		$plans['select']="Select Plans";
		$this->set('plans',$plans);
		$this->render('sign_up');

	}

	/**
		This function sends mail to admin for verifying user for confirmation.
		(string)$id :user id
		(array)$user :user detail
	*/
	function _adminMail($id,$user,$to)
	{	
		$encoded_id= base64_encode($id);
		$bcc ="admin@turtleseo.info";
		$to='patricia.appelquist@laitkor.com';		
		//$this->Email->reset();
		$this->Email->from = 'admin@turtleseo.info';
		//$this->Email->from = 'turtleSEO <no-reply@turtleseo.com>';
		$this->Email->to   = $to;
		$this->Email->return   = $to;	
		$this->Email->subject = 'Verify User '.$user['name'];
		$this->Email->template = 'toadmin'; 
		//$message="";
	   $this->Email->sendAs = 'html';
	  
	   $this->set('id', $id);
	   $this->set('user', $user);
	   $this->set('encoded_id', $encoded_id);
	   /* SMTP Options */	 
	   //$this->Email->smtpOptions = array(			 			
//			'host' => 'ssl://smtp.gmail.com',	
//			'auth' => false,		
//			'port'=>'465',			
//			'timeout'=>'30',
//					
//			//'username'=>'mitsu17206@gmail.com',
////			'password'=>'m2n1shlko'		    
//	   );				
	   //$this->Email->delivery = 'smtp';	
	   // $this->Email->delivery = 'mail';	
	   
	   $arr= $this->Email->__renderTemplate($this->Email->__wrap(null));
	   
	   $meassage = "";
	   foreach($arr as $line){
		   $meassage .= $line;
	   }	
	   /* Set delivery method */
	   //$this->Email->send();	
	  $this->phpMailerFunc($to,'Verify User '.$user['name'],'turtleSEO','no-reply@turtleseo.com',$meassage,$bcc);   		
	}

		
	//Custom function is used to send the mail
	function phpMailerFunc($to,$sub,$from,$from_email,$body,$bcc="")
	{	
		App::import('Vendor', 'smtp');	
		App::import('Vendor','phpmailer');	
				
		$mail = new PHPMailer();  // create a new object
		$mail->IsSMTP(); // enable SMTP
		$mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true;  // authentication enabled
		$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
		$mail->Host = "smtp.gmail.com";
		$mail->Port =465; 
		//$mail->Username = 'mitsu17206@gmail.com';  
//		$mail->Password = 'm2n1shlko';    
        $mail->Username = 'admin@turtleseo.info';  
		$mail->Password = 'm2n1shlko1250';   
		$mail->From = $from_email;
		$mail->FromName = $from;
		$mail->Subject = $sub;
		$mail->IsHTML(true);
		$mail->Body = $body;
		$mail->AddAddress($to);
		
		if(!empty($bcc))	$mail->AddBCC($bcc);
		
		if(!$mail->Send()) {
			return false; 
		} else {
			return true;
		}
	}
	/**
		This function verifies user.
		send mail to user
		update verified field of users table to 1 ;
		verified:1 means  user is verified
	*/
	function verify($encoded_userid=null)
	{
		if(empty($encoded_userid))
		{	
			$this->Session->setFlash('<font color=red>Please provide a valid ID</font>');
			$this->redirect('/');
		}
		$encoded_id= base64_decode($encoded_userid);
		$record = $this->User->find('all', array('conditions' => array('User.id' => $encoded_id)));
		if(count($record)==0)
		{
			$this->Session->setFlash('<font color=red>ID not valid</font>');
			$this->redirect('/');
		}	
		else
		{
			$bcc='admin@turtleseo.info';
			$this->User->id=$encoded_id;
			$user_data['User']['verified']=1;
			$this->User->save($user_data);
			$this->Email->from    = 'Admin <admin@turtleseo.info>';
			$this->Email->to = 'turtleSEO <'.$record[0]['User']['email'].'>'; 
			$this->Email->subject = 'turtleSEO : Verified';
			$email=base64_encode($record[0]['User']['email']);
			$password=base64_encode($record[0]['User']['password']);
			$this->Email->template = 'verify'; 
			//Send as 'html', 'text' or 'both' (default is 'text')	
			$this->Email->sendAs = 'html'; // because we like to send pretty mail
			//Set view variables as normal
			$this->set('record', $record);
			$this->set('email', $email);
			$this->set('password', $password);
			
			/* SMTP Options */
			$this->Email->smtpOptions = array(
								'port'=>'465', 
								'timeout'=>'30',
								'host' => 'ssl://smtp.gmail.com',
								'username'=>'mitsu17206@gmail.com',
								'password'=>'m2n1shlko'
					);
			
			/* Set delivery method */
			//$this->Email->delivery = 'smtp';
			
			//Do not pass any args to send()
			//$this->Email->send();
			 $arr= $this->Email->__renderTemplate($this->Email->__wrap(null));
	   
			   $meassage = "";
			   foreach($arr as $line){
				   $meassage .= $line;
			   }	
			   /* Set delivery method */
			   //$this->Email->send();	
		 $this->phpMailerFunc($record[0]['User']['email'], 'turtleSEO : Verified','Admin','admin@turtleseo.info',$meassage,$bcc);   		
			
		    //$this->set('smtp-errors', $this->Email->smtpError);
 
			/*
			$this->SwiftMailer->smtpType = 'tls';
			$this->SwiftMailer->smtpHost = 'smtp.gmail.com';
			$this->SwiftMailer->smtpPort = 465;
			$this->SwiftMailer->smtpUsername = 'responsemee@gmail.com';
			$this->SwiftMailer->smtpPassword = '12344321';
			
			$this->SwiftMailer->sendAs = 'html';
			$this->SwiftMailer->from = 'turtleSEO <somebody@example.com>';
			$this->SwiftMailer->fromName = 'turtleSEO';
			$this->SwiftMailer->to = $record[0]['User']['email'];
	
			//Set view variables as normal
			$this->set('record', $record);
			$this->set('email', $email);
			$this->set('password', $password);
	
			try {
			if(!$this->SwiftMailer->send('verify', 'My subject')) {
			$this->log("Error sending email");
			}
			}
			catch(Exception $e) {
			pr($e->getMessage());
			exit;
			//$this->log("Failed to send email: ".$e->getMessage());
			} */
			
			$this->Session->setFlash('User verifed successfully.');
			$this->redirect('/');
		}
	}
	
	function sign_in()
	{	
		if(!empty($this->data))
		{
			$email=trim($this->data['email']);
			$password=trim($this->data['password']);
			$record = $this->User->find('all', array('conditions' => array('User.email' => $email,'User.password' => $password,'User.verified' => 1,'User.status' => 1)));
			if(count($record)==0)
			$this->set('message','<font color=red>Please enter correct email and password.</font>');
			else
			{
				
				$this->Session->write('user_email',$email);
				//admin secure code
				$codes=md5('sQG6_5Hg9S06o55SV4YSeWt3S6');
				if($email='admin@turtleseo.info' && $record[0]['User']['name']=='admin'){
				    $this->Session->write('isAdmin','true');
					$this->Session->write('secureCode',$codes);
				}
				//this is used globally in default(for displaying name of user);
				$this->Session->write('name',$record[0]['User']['name']);    	//this is used globally in default(for displaying name of user in header);
				$this->Session->write('user_id',$record[0]['User']['id']);    	//this is used globally in wp_servers for server manipulation
				$this->Session->write('user_status',$record[0]['User']['status']); 	//this is used globally dashboard_controller for checking user has made payment if user is other thnan free
			   $this->Session->write('user_plantype',$record[0]['User']['plan_type']);	 //used in pages controller for sending  upgrade plan link to proper place					
				$this->redirect('/dashboards/');
			}
			//pr($this->data);
		}
		$this->render('sign_in');
	}
	
	/**
		This function is used from user's verification email to directly sign_in user to their 
		dashboard.
		@params : email,password(base64 encoded)
	*/
/**
* connect with twitter for sign in
*
*/	
	function twitter_connect() {
		$this->Twitter->setup(CONSUMER_KEY, CONSUMER_SECRET, true); 
		
		$response = $this->Twitter->connect('https://turtleseo.com/users/sign_in_twitter'); 
		
		//print_r($response);die();
		
		if ($response == 200) {
			$url = $this->Twitter->get_authorize_url($this->Session->read("oauth_token"));
			$this->redirect($url);
		}
		
		$this->autoRender = false;			
	}
	
/**
* Sign in with twitter account details
*
*/	
	function sign_in_twitter() { 
	
		$oauth_verifier = $this->params['url']['oauth_verifier'];		
		$oauth_token = $this->Session->read('oauth_token');
		$oauth_token_secret = $this->Session->read('oauth_token_secret');
				
		if(!empty($oauth_verifier) && !empty($oauth_token) && !empty($oauth_token_secret)){
			// We've got everything we need
		} else {
			// Something's missing, go back to sign in
			$this->redirect('/users/sign_in/');
		}
		
		$user_details = $this->Twitter->get_user_info(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret, $oauth_verifier);
		
		if ($user_details == "error") {
			echo "Error";
		} else {
			$user_details = $this->objectToArray($user_details);
			print_r($user_details);
			
			die();
			
			// get twitter id
			$twitter_id = $user_details['id'];
			
			// check if user already signed up with twitter
			$record = $this->User->find('all', array('conditions' => array('User.twitter_id' => $twitter_id)));
			
			//print_r($record);
			
			if(count($record)==0) {
				// redirect to profile page
				$this->redirect('/users/profile/');
			} else {
				// auto sign in
				$this->sign_in_auto($record[0]['User']['email']);
			}	
		}			
		
		$this->autoRender = false;		
	}
/**
* Profile page for additional details in sign up
*
*/	
	
	function profile() {
		if(!empty($this->data)) {
			$this->User->save($this->data);
			$user_id=$this->User->id;
			
			$record = $this->User->find('all', array('conditions' => array('User.id' => $user_id)));
			// auto sign in
			$this->sign_in_auto($record[0]['User']['email']);			
		}
	}
	
/**
* Auto Sign in using twitter/Facebook
*
*/		
	function sign_in_auto($email) { //echo $email; die();
		$record = $this->User->find('all', array('conditions' => array('User.email' => $email)));
		if(count($record)==0) {
		
			$this->Session->setFlash('<font color=red>Please enter correct email and password.</font>');
			$this->redirect('/users/sign_in/');
		} else {
			
			$this->Session->write('user_email',$email);			//this is used globally in default(for displaying name of user);
			$this->Session->write('name',$record[0]['User']['name']);    	//this is used globally in default(for displaying name of user in header);
			$this->Session->write('user_id',$record[0]['User']['id']);    	//this is used globally in wp_servers for server manipulation
			$this->Session->write('user_status',$record[0]['User']['status']); 	//this is used globally dashboard_controller for checking user has made payment if user is other thnan free
			//$this->Session->write('user_plantype',$record[0]['User']['plan_type']);	 //used in pages controller for sending  upgrade plan link to proper place					
			$this->redirect('/dashboards/');
		}
		
		$this->autoRender = false;		
	}
	
/**
* Converts Object into Array
*
*/	
	function objectToArray($object)
	{
		$array=array();
		foreach($object as $member=>$data)
		{
			$array[$member]=$data;
		}
		return $array;
	}
	
	function sign_in_directly($email,$password)
	{		
		$email=trim($email);
		$password=trim($password);
		
		$email=base64_decode($email);		
		$password=base64_decode($password);		

		$record = $this->User->find('all', array('conditions' => array('User.email' => $email,'User.password' => $password,'User.verified' => 1)));
		if(count($record)==0)
		{
			$this->Session->setFlash('<font color=red>Please enter correct email and password.</font>');
			$this->redirect('/users/sign_in/');
		}
		else
		{
			
			$this->Session->write('user_email',$email);			//this is used globally in default(for displaying name of user);
			$this->Session->write('name',$record[0]['User']['name']);    	//this is used globally in default(for displaying name of user in header);
			$this->Session->write('user_id',$record[0]['User']['id']);    	//this is used globally in wp_servers for server manipulation
			$this->Session->write('user_status',$record[0]['User']['status']); 	//this is used globally dashboard_controller for checking user has made payment if user is other thnan free
			//$this->Session->write('user_plantype',$record[0]['User']['plan_type']);	 //used in pages controller for sending  upgrade plan link to proper place					
			$this->redirect('/dashboards/');
		}
	}
	
	/**
		Destroys  completes session variable and redirect to home page
	*/
	function sign_out()
	{
	  $this->Session->destroy();
	  $this->redirect('/');

	}
 	
	
	/*
		This function used to edit user's profile
	*/
		
	function edit()
	{
		$this->User->id = $this->Session->read('user_id');
		if (empty($this->data)) 
		$this->data = $this->User->read();
		else
		{
			/*image upload*/
			$file = $this->data['File']['image'];
			$this->imageupload($file);	
			
			if ($this->User->save($this->data))
			{
				$this->Session->write('name',$this->data['User']['name']);
				$this->Session->setFlash('Your profile has been edited');
				$this->redirect('/dashboards/');
			}
		}
		
	}//end function
	
	/*
		This function sends user's password in their mail.
	*/
	function forgot_password()
	{
		if(!empty($this->data['email']))
		{
			$email=trim($this->data['email']);	
			$user=$this->User->findByEmail($email);
			
			if($email=="")
			$this->set('mess','Please enter email ');
		
			else if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email))
			$this->set('mess','Please enter valid email');
			
			else if(!empty($user))
			{
				
				$this->Email->from    = 'turtleSEO <admin@turtleseo.com>';
				$this->Email->to      = $email;	
				$this->Email->subject = 'Password Recovery';
			
				if($this->Email->send('Your password is :'.$user['User']['password']))
				$this->set('mess','Your password has been sent to your email account');
				else
				$this->set('mess','There is some server problem in sending mail. Please try later');
				//mail($email,'TurtleSEO: Password Recovery','Your Password IS :'.$user['User']['password'],$headers);
				
			}
			else
			{
				$this->set('mess','Email not found in our database.');
			}
		}
		else
		{
			$this->set('mess','Please enter email.');
		}
		$this->render('sign_in');
	}
	
	/**
		Used for changing user plan
		Table : users, user_plans,plans
		Process : 
		Change plan_id field according to selected plan and set various limit(post,blog) to 0.
		Change plan_type field of users table and set expiry_date field of user according to selected plan
		For Plan of Free type no expiry date is set.Other Plans has expiry date set. 
	*/
	function change_plan()
	{
		$this->loadModel('Plan');
		$this->loadModel('UserPlan');
		//$user_plan=$this->Session->read('user_plantype');
		$user_id=$this->Session->read('user_id');
		
		//pr($user_plan);
		if(!empty($this->data))
		{
	 
			$this->User->id=$user_id;
			
			$plan_data=$this->UserPlan->findByUserId($user_id);
			$this->UserPlan->id=$plan_data['UserPlan']['id'];
			$plan=$this->Plan->findById($this->data['plan_type']);
			$user_data['User']['plan_type']=$plan['Plan']['name'];
			$blog_1=$plan['Plan']['blog_limit'];
			$post_1=$plan['Plan']['post_limit'];
			$report_1=$plan['Plan']['report_limit'];
			$page_1=$plan['Plan']['page_limit'];
			//$user_data['User']['status']=0;
			if(strtolower($plan['Plan']['name']) != 'free')
			{
				$user_data['User']['expiry_date']=date('Y-m-d',strtotime('next month'));
				$user_data['User']['status']=0;
			}
			else
			{
				$user_data['User']['expiry_date']='';
				$user_data['User']['status']=1;
			}
			$this->User->save($user_data);
			$this->UserPlan->user_id=$user_id;
			$d['UserPlan']['plan_id']=$this->data['plan_type'];
			$d['UserPlan']['post_limit']=0;
			$d['UserPlan']['blog_limit']=0;
			$d['UserPlan']['page_limit']=0;
			$d['UserPlan']['report_limit']=0;
			$d['UserPlan']['start_date']=date('Y-m-d');
			$this->UserPlan->save($d);
		
			//$this->UserPlan->query('delete from reports where user_id='.$this->Session->read('user_id'));
			$this->set('mess',"Plan changed successfully");		
		}
		//removing user_plan type from plans array	
		$plans=$this->Plan->find('list',array('fields' => 'Plan.name'));
		$user=$this->User->findById($user_id);
		$key=array_search($user['User']['plan_type'],$plans);
		unset($plans[$key]);
		$plans['select']="Select Plans";
		$this->set('plans',$plans);	
		
		$this->render('change_plan');	
	}
	/**********************************************
	 This function is uset to the new plan of user
	 Author	:	Laitkor
	 Date	:19 June 2010	
	**********************************************/
	function setUpplan($curr_plan="free"){
		$this->loadModel('Plan');
		$this->loadModel('UserPlan');
		if($this->_check_login())
		{
			//If form is posted
			if(!empty($this->data))
			{
				$user_id=$this->Session->read('user_id');
				$this->User->id=$user_id;
							
				//Getting user plan details
				//$curr_plan_data = $this->UserPlan->query("SELECT plans.id FROM plans WHERE plans.name LIKE '$curr_plan'");				
				$curr_plan_data = $this->UserPlan->query("SELECT * FROM plans WHERE plans.name LIKE '$curr_plan'");				
				//Storing in Session
				$this->Session->write('Plan.curr_id', $curr_plan_data[0]['plans']['id']);	
				$this->Session->write('Plan.curr_name', $curr_plan);
				$this->Session->write('Plan.expiry', date('Y-m-d',strtotime('next month')));	
								
				//Getting the Plans Details
				$plan=$this->Plan->findById($this->data['id']);
				
				// Not for Free Plan
				if($plan['Plan']['price']>0){				
					$this->Session->write('Plan.id', $plan['Plan']['id']);							
					$this->Session->write('Plan.name', $plan['Plan']['name']);							
					$this->Session->write('Plan.price', $plan['Plan']['price']);
					//redirecting to Payment Gateway
					$this->Session->setFlash('Please proceed for payment');
					$this->redirect('/payments/expressCheckout/1');							
				}
				
				//For Free Plan
				$user_data['User']['id']=$this->Session->read('user_id');
				$user_data['User']['plan_type']=$plan['Plan']['name'];
				$user_data['User']['expiry_date']='';
				$user_data['User']['status']=1; //for free, payment stattus 1
				$user_data['User']['paypal_profile_status']='Suspend';
				$this->User->save($user_data);
				
				$plan_data=$this->UserPlan->findByUserId($user_id);
				$this->UserPlan->id = $plan_data['UserPlan']['id'];
				$d['UserPlan']['post_to_del']=$plan_data['UserPlan']['post_limit'] + $plan_data['UserPlan']['post_to_del'];
				$d['UserPlan']['blog_to_del']=$plan_data['UserPlan']['blog_limit'] + $plan_data['UserPlan']['blog_to_del'];
				$d['UserPlan']['page_to_del']=$plan_data['UserPlan']['page_limit'] + $plan_data['UserPlan']['page_to_del'];
				$d['UserPlan']['research_to_del']=$plan_data['UserPlan']['report_limit']+$plan_data['UserPlan']['research_to_del'];
				$d['UserPlan']['report_to_del']=$plan_data['UserPlan']['report_limit'] + $plan_data['UserPlan']['report_to_del'];
				
				$d['UserPlan']['plan_id']=$this->data['id'];
				$d['UserPlan']['start_date']=date('Y-m-d');
				$d['UserPlan']['post_limit']=$plan['Plan']['post_limit'];
				$d['UserPlan']['blog_limit']=$plan['Plan']['page_limit'];
				$d['UserPlan']['page_limit']=$plan['Plan']['page_limit'];
				$d['UserPlan']['research_limit']=$plan['Plan']['report_limit'];
				$d['UserPlan']['report_limit']=$plan['Plan']['report_limit'];
				//$d['UserPlan']['post_limit']=$plan['Plan']['post_limit']-$d['UserPlan']['post_to_del'];
				//$d['UserPlan']['blog_limit']=$plan['Plan']['blog_limit']-$d['UserPlan']['blog_to_del'];
				//$d['UserPlan']['page_limit']=$plan['Plan']['page_limit']-$d['UserPlan']['page_to_del'];
				//$d['UserPlan']['research_limit']=$plan['Plan']['report_limit']-$d['UserPlan']['report_to_del'];
				//$d['UserPlan']['report_limit']=$plan['Plan']['report_limit']-$d['UserPlan']['report_to_del'];				
				
				$this->UserPlan->save($d);
				
				$user=$this->User->findById($this->Session->read('user_id'));	
				if(!empty($user['User']['paypal_profile_id']) && $user['User']["paypal_profile_status"]=="Active")
				{
					//redirecting to dashboard
					$this->Session->setFlash('Subscription had been cancelled successfully!');
					$this->redirect('/payments/expressCheckout/4');
				}
				
				//redirecting to dashboard
				$this->Session->setFlash('Your plan changed successfully');
				$this->redirect('/dashboards/');
			}	
		}
	}
	
	function upgrade_plan()
	{
		$this->loadModel('Plan');
		$this->loadModel('UserPlan');
		
		if($this->_check_login())
		{
			
			if(!empty($this->data))
			{
				$user_id=$this->Session->read('user_id');
				$this->User->id=$user_id;
				
				$plan_data=$this->UserPlan->findByUserId($user_id);
				$this->UserPlan->id=$plan_data['UserPlan']['id'];
				
				$plan=$this->Plan->findById($this->data['id']);
				
				$user_data['User']['plan_type']=$plan['Plan']['name'];
				//$user_data['User']['status']=0;
				if(strtolower($plan['Plan']['name']) != 'free')
				{
					$user_data['User']['expiry_date']=date('Y-m-d',strtotime('next month'));
					$user_data['User']['status']=0;
				}
				else
				{
					$user_data['User']['expiry_date']='';
					$user_data['User']['status']=1; //for free, payment stattus 1
				
				}
				$this->User->save($user_data);
				
				$d['UserPlan']['plan_id']=$this->data['id'];
				$d['UserPlan']['post_limit']=0;
				$d['UserPlan']['blog_limit']=0;
				$d['UserPlan']['page_limit']=0;
				$d['UserPlan']['research_limit']=0;
				$d['UserPlan']['report_limit']=0;
				$d['UserPlan']['start_date']=date('Y-m-d');
				$this->UserPlan->save($d);
				
				//redirecting to dashboard
				$this->Session->setFlash('Your plan changed successfully');
				$this->redirect('/dashboards/');
			}
		}	
	}
	/*
		Show plans + displays updrade plan according to plan type of user.
		if user plan type is free link is next to 'silver,gold' , if user type is silver link is next to 'gold'
	*/
	function plans()
	{
	if($this->_check_login())
		{	
		//fetching plan_ids for silver ,gold and sending it to view.This will be used in upgrade/degrade plan 
		$this->loadModel('Plan');
		$this->loadModel('UserPlan');
		
		$plan=$this->Plan->find('all',array('fields' =>array('Plan.name','Plan.id','Plan.blog_limit','Plan.page_limit','Plan.post_limit','Plan.report_limit')));
		$plan_limits=array(); 
		foreach($plan as $key => $value)
		{			
			
			if( strtolower($plan[$key]['Plan']['name'])=='silver'){
				$this->set('silver',$plan[$key]['Plan']['id']);
				$i='silver';
				$plan_limits[$i]['blog_limit']=$plan[$key]['Plan']['blog_limit'];
				$plan_limits[$i]['page_limit']=$plan[$key]['Plan']['page_limit'];
				$plan_limits[$i]['post_limit']=$plan[$key]['Plan']['post_limit'];
				$plan_limits[$i]['report_limit']=$plan[$key]['Plan']['report_limit'];
			}
			if( strtolower($plan[$key]['Plan']['name'])=='gold'){
				$this->set('gold',$plan[$key]['Plan']['id']);
				$i='gold';
				$plan_limits[$i]['blog_limit']=$plan[$key]['Plan']['blog_limit'];
				$plan_limits[$i]['page_limit']=$plan[$key]['Plan']['page_limit'];
				$plan_limits[$i]['post_limit']=$plan[$key]['Plan']['post_limit'];
				$plan_limits[$i]['report_limit']=$plan[$key]['Plan']['report_limit'];
			}
			if( strtolower($plan[$key]['Plan']['name'])=='free'){
				$this->set('free',$plan[$key]['Plan']['id']);	
				$i='free';
				$plan_limits[$i]['blog_limit']=$plan[$key]['Plan']['blog_limit'];
				$plan_limits[$i]['page_limit']=$plan[$key]['Plan']['page_limit'];
				$plan_limits[$i]['post_limit']=$plan[$key]['Plan']['post_limit'];
				$plan_limits[$i]['report_limit']=$plan[$key]['Plan']['report_limit'];			
			}
		}
		$this->set('plan_limits',$plan_limits);
		
		//fetching current plan_type of user
		$user=$this->User->findById($this->Session->read('user_id'));
		$this->set('plan',$user['User']['plan_type']);	
		if($user['User']['plan_type']!="free"){
			list($y,$m,$d)=split('-',$user['User']['expiry_date']);	
			$this->set('plan_expires','<div style="color:#FF9900; width:400; float:right;"><b>Expires On: '.date("M d, Y",mktime(0,0,0,$m,$d,$y)).'</b></div>');		
		}
		//fetching current_plan details viz. blog_limit,page_limit,post_limit
		$user_id=$this->Session->read('user_id');

		//commented by Navneet
		//$user_plan=$this->UserPlan->query("select 				              plans.name,plans.blog_limit,plans.blog_limit,plans.post_limit,plans.page_limit,plans.report_limit,user_plans.id,user_plans.blog_limit,user_plans.page_limit,user_plans.post_limit,user_plans.report_limit,user_plans.id from plans inner join user_plans on plans.id=user_plans.plan_id where user_plans.user_id=$user_id");
		
		$user_plan=$this->UserPlan->query("select 				              plans.name,plans.blog_limit,plans.blog_limit,plans.post_limit,plans.page_limit,plans.report_limit,user_plans.id,user_plans.blog_limit,user_plans.page_limit,user_plans.post_limit,user_plans.report_limit,user_plans.blog_to_del,user_plans.post_to_del,user_plans.page_to_del,user_plans.report_to_del,user_plans.id from plans inner join user_plans on plans.id=user_plans.plan_id where user_plans.user_id=$user_id");
		
/*		$this->set('blog_limit',($user_plan[0]['user_plans']['blog_limit']-$user_plan[0]['user_plans']['blog_to_del']));						
		$this->set('post_limit',($user_plan[0]['user_plans']['post_limit']-$user_plan[0]['user_plans']['post_to_del']));						
		$this->set('page_limit',($user_plan[0]['user_plans']['page_limit']-$user_plan[0]['user_plans']['page_to_del']));						
		$this->set('report_limit',($user_plan[0]['user_plans']['report_limit']-$user_plan[0]['user_plans']['report_to_del']));
*/		
		$this->set('blog_limit',$user_plan[0]['user_plans']['blog_limit']);						
		$this->set('post_limit',$user_plan[0]['user_plans']['post_limit']);						
		$this->set('page_limit',$user_plan[0]['user_plans']['page_limit']);						
		$this->set('report_limit',$user_plan[0]['user_plans']['report_limit']);
		
		$this->set('blog_to_del',$user_plan[0]['user_plans']['blog_to_del']);						
		$this->set('post_to_del',$user_plan[0]['user_plans']['post_to_del']);						
		$this->set('page_to_del',$user_plan[0]['user_plans']['page_to_del']);						
		$this->set('report_to_del',$user_plan[0]['user_plans']['report_to_del']);
			
		$this->Session->write('Plan.user_plan_id', $user_plan[0]['user_plans']['id']);					
		
		//getting plan cost 
		//order by asc so that we can correct price for silver,gold in indexing
		$plan_cost=$this->UserPlan->query('select name,price from plans order by price asc ');
		//pr($plan_cost);
		//exit;
		$this->set('silver_cost',$plan_cost[1]['plans']['price']);	
		$this->set('gold_cost',$plan_cost[2]['plans']['price']);	
		//pr($user_plan);
		
		$this->render('plans');
	}	
	
	}
	
	function research()
	{
		$user=$this->User->findById($this->Session->read('user_id'));
		$this->set('plan_name',ucfirst($user['User']['plan_type']));
	}
	
	function tell_friend()
	{
		if($this->_check_login())
		{
			if(!empty($this->data))
			{
				$this->set('frndsname',$this->data['friend_name']);
				$this->set('frndsemail',$this->data['friend_email']);
				$this->set('comment',$this->data['comment']);
				if(!$this->Recaptcha->valid($this->params['form']))
				{
  					$this->set("error_msg","Please enter correct words in captcha.");
				}
				else
				{	
					$this->Email->from    = $this->data['name']."<".$this->data['email'].">";
					$this->Email->to      = $this->data['friend_email'];		
					$this->Email->subject = 'Something Interesting';
				$msg= "Hi ". $this->data['friend_name'].",<br><br> I found some interesting features and thought they would benefit you. <br>Sign up for free, at http://turtleseo.com and explore great features.<br><br>".$this->data['comment']."<br><br>--<br>Thanks,<br>".$this->data['name'];
					$this->Email->sendAs = 'html';
					if($this->Email->send($msg))
					{
					$this->Session->setFlash('Mail sent successfully');
					$this->set('frndsname',"");
					$this->set('frndsemail',"");
					$this->set('comment',"");
					}
					else
					$this->Session->setFlash('There is some server problem in sending mail. Please try later');
				}	
			}
		}
	
		$this->User->id=$this->Session->read('user_id');
		$user=$this->User->read();
		$this->set('name',$user['User']['name']);
		$this->set('email',$user['User']['email']);
	    $this->render('tell_friend');
	}
	
	/**
		This function send mail to admin 
		with description of query and user details
	**/
	function support()
	{
		
		if($this->_check_login())
		{
			if(!empty($this->data))
			{
				$this->set('des',$this->data['desc']);
				$this->set('qtype',$this->data['query_type']);
				if(!$this->Recaptcha->valid($this->params['form']))
				{
  					$this->set("error_msg","Please enter correct words in Captcha.");
				}
				else
				{	
			 
					$this->User->id=$this->Session->read('user_id');
					$user=$this->User->read();
					
					$to='support@turtleseo.com';
					$this->Email->from    = "Support <".$user['User']['email'].">";
					$this->Email->to      = $to;
					$this->Email->subject = 'turtleSEO:Support mail from '.$user['User']['name'];
				
					$message="<p><strong>ID :".$user['User']['id']."</strong></p>
							<p><strong>Name : ".$user['User']['name']."</strong></p>
							<p><strong>Email :".$user['User']['email']." </strong></p>
							<p><strong>Current Plan :".$user['User']['plan_type']." </strong></p>
							<p><strong>Query Type :".$this->data['query_type']."</strong></p>
							<p><strong>Description :".$this->data['desc']." </strong></p>";
							
							
					$this->Email->sendAs = 'html';
					if($this->Email->send($message))
					{
					$this->Session->setFlash('Query registered successfully. You will get reply within 24 hrs.');
					$this->set('des',"");
					$this->set('qtype',"");
					}
					else
					$this->Session->setFlash('There is some server problem in sending mail. Please try later.');
				}	
			}
		}
		$this->render('support');
	}
	
	
	function _check_login()
	{
		if( !($this->_isLoggedIn()) )
		{
			$this->Session->setFlash('You are not authorized to view this page');
			$this->redirect('/users/sign_in');
		}		
		return true;
	}
	
	function networks() {
	if($this->_check_login())
		{
		$this->loadModel('Network');
		//$this->set('networks', $this->Network->query("SELECT `network_name` FROM `networks`;"));
		//$this->set('networks', $this->Network->find('all'));
		//$networks = $this->Network->find('all', array('fields' => array('Network.network_name')));
		$networks = $this->Network->find('all');
		$this->set('networks', $networks);
		//$this->render('networks');
		$userid = $this->Session->read('user_id');
		$this->loadModel('Addednetwork');
		$addednetworks = $this->Addednetwork->find('all', array('conditions' => array('Addednetwork.user_id' => $userid)));
		$this->set('addednetworks', $addednetworks);
		}
	}
	
	function changecredentials($id) {
		if($this->_check_login())
		{
		//validating passed network id	
		$id=trim($id);
		$this->set('id', $id );
		$this->loadModel('Network');
		$res = $this->Network->find('first', array('conditions' => array('Network.network_id' => $id)));
		$this->set('network', $res );
		if(!$this->_checkId($id))
		{
			$this->Session->setFlash('Entered Network ID invalid');
			$this->redirect('/users/networks /');
		}
		$userid = $this->Session->read('user_id');
		$this->loadModel('Addednetwork');
		if (!empty($this->data))
		{
			$username = $this->data['username'];
			$password = $this->data['password'];
			$res = $this->Addednetwork->query("UPDATE `addednetworks` SET `network_username`='$username', `network_password`='$password' WHERE `user_id` = $userid AND `network_id` = $id");
			$this->Session->setFlash('Credentials have been changed.');
			$this->redirect(array('controller' => 'users', 'action' => 'networks'));
		}
		$this->render('changecredentials','modalbox');	
		}
	}
	
	function _checkId($id)
	{
		//passed network id null or string
	 	if($id == null OR !(is_numeric($id)))
		return false;
		//Checking server id exist or not in database
		$userid = $this->Session->read('user_id');
		$this->loadModel('Addednetwork');
		if( $this->Addednetwork->find('count', array('conditions' => array('Addednetwork.user_id' => $userid, 'Addednetwork.network_id' => $id))) <= 0 )
		return false;
		
		return true;
	}
	
	function delete($id) {
		$userid = $this->Session->read('user_id');
		$this->loadModel('Addednetwork');
		$id=trim($id);
		$this->Addednetwork->query("delete from addednetworks where network_id=$id and user_id=$userid");	
		$this->Session->setFlash('Network has been deleted.');
		$this->redirect('/users/networks');
	}

 
		
	function post_status()
	{
	//added
	$wrong_credential=false;
	//added
	if($this->_check_login())
		{
		$userid = $this->Session->read('user_id');
		$this->loadModel('Addednetwork');
		$this->set('addednetworks', $this->Addednetwork->find('all', array('conditions' => array('Addednetwork.user_id' => $userid))));
		if(!empty($this->data))
		{
			$nets = $this->data['Usernetworks'];
			$msg = trim($this->data['message']);
			if (count($nets) <> 0 && $msg <> '')
			{
				foreach($nets as $net)
				{
					switch($net)
					{
					case 0 :
					 	break;	
					case 1 :
						$this->tweet($msg); break;
					case 2 :
					//edited
						if($this->facebookStatusUpdate($msg)=='wrong')
						{
							$this->Session->setFlash("Not able to post.Something went wrong.");
							$this->redirect('/users/post_status');
							$wrong_credential=true;
						}
						else
						$wrong_credential=false;
						break;
						
					//edited
						
						//$this->facebookStatusUpdate($msg); break;
					
					case 3 :
						$this->setlinkedinstatus($msg); break;
					case 4 :
						$this->setfriendsterstatus($msg); break;
					case 5 :
						$this->hi5statusupdate($msg);break;
					case 6 :
						$this->settumblerstatus($msg);break;
					case 7 :
						$this->setidenticastatus($msg);break;
					case 8 :
						$this->setshoutemstatus($msg);break;
					}
				}
				//editd
				if($wrong_credential)
				$this->Session->setFlash("Please enter correct credentials.");
				else
				//edited
				$this->Session->setFlash("Mesasge posted successfully!");
			}
			else
				$this->Session->setFlash("Please select a network and/or enter some message!");
			}
		$this->render('post_status','modalbox');
		}
	}
	
// ========== added by manish for admin =======
	
		function usersdetaild($id = NULL) {
	     if(!($this->_isLoggedIn()) )
		  {
			$this->Session->setFlash('You are not authorized to view this page.');
			$this->redirect('/users/sign_in');
	      }		
		 $this->loadModel('User');
		 $all_users_details=$this->User->find('all', array('conditions' => array("User.email <>" => "admin@turtleseo.info")));
		 
		 
		 
		 $this->set('all_users_details',$all_users_details );
 
			if($id){ 
				$id=trim($id);  
				$this->User->query("delete from addednetworks where user_id=$id");
				$this->User->query("delete from user_plan where user_id=$id");	
				$this->User->query("delete from reports where user_id=$id");
				$this->User->query("delete from wp_servers where user_id=$id");
				$this->User->query("delete from api_settings where user_id=$id");
				$this->User->query("delete from users where id=$id");	
				
				$this->Session->setFlash('User has been deleted.');
				$this->redirect('/users/usersdetaild');
		   } 
		
	}
	
	 function users_plandetails($id = NULL) {
		   
		    if(!($this->_isLoggedIn()) )
		    {
			  $this->Session->setFlash('You are not authorized to view this page.');
			  $this->redirect('/users/sign_in');
	        }
		   elseif($this->Session->read('isAdmin')!='true')
		   {
			$this->Session->setFlash('You are not authorized to view this page.');
			$this->redirect('/users/dashboard');
	       }
			 $this->loadModel('User');
			 $all_users_details=$this->User->find('all', array('conditions' => array("User.email <>" => "admin@turtleseo.info")));
			 $this->set('all_users_details',$all_users_details);

	}
	
	 function edit_user_details($id) {
	   if(!($this->_isLoggedIn()) )
		  {
			$this->Session->setFlash('You are not authorized to view this page.');
			$this->redirect('/users/sign_in');
	      }
	if($this->Session->read('isAdmin')!='true')
		  {
		    unset($_SESSION);
			$this->Session->setFlash('You are not authorized to view this page.');
			$this->redirect('/users/sign_in');
	      }
		$this->User->id = $id;
		if (empty($this->data)) 
		$this->data = $this->User->read();
		else
		{
			$file = $this->data['File']['image'];
			$this->imageupload($file,$id);	
			
			if ($this->User->save($this->data))
			{
				$this->Session->setFlash('Users details are updated successfully.');
			    $this->redirect('/users/usersdetaild');
			}
		}
		
 
	 
	}
	
	
	function limit_details()
	{
		$this->loadModel('Plan');
		$this->loadModel('UserPlan');
		$user_id=$this->Session->read('user_id');
		$plan=$this->Plan->query("select blog_limit,page_limit,report_limit,post_limit from plans where name='free'");
		
		 
	$user_plan=$this->UserPlan->query("select 				              plans.name,plans.blog_limit,plans.blog_limit,plans.post_limit,plans.page_limit,plans.report_limit,user_plans.id,user_plans.blog_limit,user_plans.page_limit,user_plans.post_limit,user_plans.report_limit,user_plans.id from plans inner join user_plans on plans.id=user_plans.plan_id where user_plans.user_id=$user_id");
		
/*		$this->set('blog_limit',($user_plan[0]['user_plans']['blog_limit']-$user_plan[0]['user_plans']['blog_to_del']));						
		$this->set('post_limit',($user_plan[0]['user_plans']['post_limit']-$user_plan[0]['user_plans']['post_to_del']));						
		$this->set('page_limit',($user_plan[0]['user_plans']['page_limit']-$user_plan[0]['user_plans']['page_to_del']));						
		$this->set('report_limit',($user_plan[0]['user_plans']['report_limit']-$user_plan[0]['user_plans']['report_to_del']));
*/		
			
		//pr($plan);exit;
		
		$this->set('total_blog_limit',$plan[0]['plans']['blog_limit']);						
		$this->set('total_post_limit',$plan[0]['plans']['post_limit']);						
		$this->set('total_page_limit',$plan[0]['plans']['page_limit']);						
		$this->set('total_report_limit',$plan[0]['plans']['report_limit']);
	
		$this->set('used_blog_limit',$user_plan[0]['user_plans']['blog_limit']);						
		$this->set('used_post_limit',$user_plan[0]['user_plans']['post_limit']);						
		$this->set('used_page_limit',$user_plan[0]['user_plans']['page_limit']);						
		$this->set('used_report_limit',$user_plan[0]['user_plans']['report_limit']);
	
		
		$this->render('limit_details','modalbox');
	}
	//=============================================
	
	
	
}
 
//end class users
?>
