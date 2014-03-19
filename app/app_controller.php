<?php
/* SVN FILE: $Id: app_controller.php 7296 2008-06-27 09:09:03Z gwoo $ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.cake.libs.controller
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 7296 $
 * @modifiedby		$LastChangedBy: gwoo $
 * @lastmodified	$Date: 2008-06-27 02:09:03 -0700 (Fri, 27 Jun 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		cake
 * @subpackage	cake.cake.libs.controller
 */
class AppController extends Controller
{
	
	var $components=array('Breadcrumb','Paypal');		
	
	function beforeRender()
	{
		$breadcrumb=$this->Breadcrumb->setBreadcrumb($this->params['url']['url']);
		//pr($breadcrumb);
		$counter=0;
		$crumb="<p align='left' style='padding-bottom:18px;'>";
		foreach($breadcrumb as $key => $value)
		{
			$counter=$counter+1;
			if($value[0]=='home')
			{
				$value[0]='Dashboard';
				$value[1]='/dashboards';
			}
			
			if($value[0]=='maincats')
			{
				$value[0]='Categories';
				$value[1]='/maincats';
			}
			
			if(count($breadcrumb)!=$counter)
			$crumb.="<a style='color:#fff;' href='$value[1]'>".ucfirst($value[0])."  </a>&nbsp;<span style='color:#fff'> > </span>&nbsp;"; 
			else
			$crumb.="<a style='color:#fff' href='$value[1]'>".ucfirst($value[0])."</a>";
			
		}
		$crumb.="</p>";					
		$this->set('crumb', $crumb);
	}
	
	/*function _spin2($string, $seedPageName = true, $calculate = false, $openingConstruct = '{{', $closingConstruct = '}}')
	{
		# Choose whether to return the string or the number of permutations
		$return = 'string';
		if($calculate)
		{
			$permutations   = 1;
			$return         = 'permutations';
		}

		# If we have nothing to spin just exit (don't use a regexp)
		if(strpos($string, $openingConstruct) === false)
		{
			return $$return;
		}
   
		if(preg_match_all('!'.$openingConstruct.'(.*?)'.$closingConstruct.'!s', $string, $matches))
		{
			# Optional, always show a particular combination on the page
			if($seedPageName)
			{
				mt_srand(crc32($_SERVER['REQUEST_URI']));
			}

			$find       = array();
			$replace    = array();

			foreach($matches[0] as $key => $match)
			{
				$choices = explode('|', $matches[1][$key]);

				if($calculate)
				{
					$permutations *= count($choices);
				}
				else
				{
					$find[]     = $match;
					$replace[]  = $choices[mt_rand(0, count($choices) - 1)];
				}
			}
		
			if(!$calculate)
			{
				# Ensure multiple instances of the same spinning combinations will spin differently
				$string = $this->_str_replace_first($find, $replace, $string);
			}
		
		}
		return $$return;
	}  //end _spin2

	
	# Similar to str_replace, but only replaces the first instance of the needle
	function _str_replace_first($find, $replace, $string)
	{
		# Ensure we are dealing with arrays
		if(!is_array($find))
		{
			$find = array($find);
		}

		if(!is_array($replace))
		{
			$replace = array($replace);
		}

		foreach($find as $key => $value)
		{
			if(($pos = strpos($string, $value)) !== false)
			{
				# If we have no replacement make it empty
				if(!isset($replace[$key]))
				{
					$replace[$key] = '';
				}
				$string = mb_substr($string, 0, $pos).$replace[$key].mb_substr($string, $pos + mb_strlen($value));
			}
		}	
		return $string;
	}//_str_replace_first

*/

/*****************************************END OLD VERSION*********************************************/



	
	/**
		This function performs nested spinning of a article
	**/
	
	function _nested_spin($string, $seedPageName = true, $openingConstruct = '{{', $closingConstruct = '}}')
	{
    # If we have nothing to spin just exit
    if(strpos($string, $openingConstruct) === false)
    {
        return $string;
    }

    # Find all positions of the starting and opening braces
    $startPositions = $this->strpos_all($string, $openingConstruct);
    $endPositions   = $this->strpos_all($string, $closingConstruct);

    # There must be the same number of opening constructs to closing ones
    if($startPositions === false OR count($startPositions) !== count($endPositions))
    {
        return $string;
    }

    # Optional, always show a particular combination on the page
    if($seedPageName)
    {
        mt_srand(crc32($_SERVER['REQUEST_URI']));
    }

    # Might as well calculate these once
    $openingConstructLength = mb_strlen($openingConstruct);
    $closingConstructLength = mb_strlen($closingConstruct);

    # Organise the starting and opening values into a simple array showing orders
    foreach($startPositions as $pos)
    {
        $order[$pos] = 'open';
    }
    foreach($endPositions as $pos)
    {
        $order[$pos] = 'close';
    }
    ksort($order);

    # Go through the positions to get the depths
    $depth = 0;
    $chunk = 0;
    foreach($order as $position => $state)
    {
        if($state == 'open')
        {
            $depth++;
            $history[] = $position;
        }
        else
        {
            $lastPosition   = end($history);
            $lastKey        = key($history);
            unset($history[$lastKey]);

            $store[$depth][] = mb_substr($string, $lastPosition + $openingConstructLength, $position - $lastPosition - $closingConstructLength);
            $depth--;
        }
    }
    krsort($store);

    # Remove the old array and make sure we know what the original state of the top level spin blocks was
    unset($order);
    $original = $store[1];

    # Move through all elements and spin them
    foreach($store as $depth => $values)
    {
        foreach($values as $key => $spin)
        {
            # Get the choices
            $choices = explode('|', $store[$depth][$key]);
            $replace = $choices[mt_rand(0, count($choices) - 1)];

            # Move down to the lower levels
            $level = $depth;
            while($level > 0)
            {
                foreach($store[$level] as $k => $v)
                {
                    $find = $openingConstruct.$store[$depth][$key].$closingConstruct;
                    if($level == 1 AND $depth == 1)
                    {
                        $find = $store[$depth][$key];
                    }
                    $store[$level][$k] = $this->_nested_str_replace_first($find, $replace, $store[$level][$k]);
                }
                $level--;
            }
        }
    }

    # Put the very lowest level back into the original string
    foreach($original as $key => $value)
    {
        $string = $this->_nested_str_replace_first($openingConstruct.$value.$closingConstruct, $store[1][$key], $string);
    }

    return $string;
}

# Similar to str_replace, but only replaces the first instance of the needle
function _nested_str_replace_first($find, $replace, $string)
{
    # Ensure we are dealing with arrays
    if(!is_array($find))
    {
        $find = array($find);
    }

    if(!is_array($replace))
    {
        $replace = array($replace);
    }

    foreach($find as $key => $value)
    {
        if(($pos = strpos($string, $value)) !== false)
        {
            # If we have no replacement make it empty
            if(!isset($replace[$key]))
            {
                $replace[$key] = '';
            }

            $string = mb_substr($string, 0, $pos).$replace[$key].mb_substr($string, $pos + mb_strlen($value));
        }
    }

    return $string;
}

# Finds all instances of a needle in the haystack and returns the array
function strpos_all($haystack, $needle)
{
    $offset = 0;
    $i      = 0;
    $return = false;
   
    while(is_integer($i))
    {  
        $i = strpos($haystack, $needle, $offset);
       
        if(is_integer($i))
        {
            $return[]   = $i;
            $offset     = $i + mb_strlen($needle);
        }
    }

    return $return;
}

/**
	This function checks validatity of users ie user is login or not.
	@return true/false
*/
function _isLoggedIn()
{
	//pr($this->Session->read());
	//exit;
	$email=$this->Session->read('user_email');	
	if(!empty($email))
	return true;
	else
	return false;
}

//manish : 25 june : to check if user has blogged remained or not

function isBucketFull()
{
	$user_id=$this->Session->read('user_id');
 
}

//end function

/*****************************************Functions For Social Networks*********************************************/

	function facebookStatusUpdate($status){
			
			$userid = $this->Session->read('user_id');
			// set facebook credentials
			$this->loadModel('Addednetwork');
			$addednetworks = $this->Addednetwork->find('all', array('conditions' => array('Addednetwork.user_id' => $userid, 'Addednetwork.network_id' => 2)));
			$facebookLogin = $addednetworks[0]['Addednetwork']['network_username'];
            $facebookPassword = $addednetworks[0]['Addednetwork']['network_password'];
		 
	  		// do login to facebook
  			$curl = curl_init();
  			curl_setopt($curl, CURLOPT_URL, "https://login.facebook.com/login.php?m&next=http://m.facebook.com/home.php");
  			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	  		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  			curl_setopt($curl, CURLOPT_POST, 1);
  			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	  		curl_setopt($curl, CURLOPT_POSTFIELDS, "email=" . $facebookLogin . "&pass=" . $facebookPassword . "&login=Log In");
  			curl_setopt($curl, CURLOPT_ENCODING, "");
  			curl_setopt($curl, CURLOPT_COOKIEJAR, getcwd() . '/cookies_facebook.cookie');
			$curl_data = curl_exec($curl);
  			curl_close($curl);
 
			// do get post url
  			$urlPost = substr($curl_data, strpos($curl_data, "action=") + 8);
  			$urlPost = substr($urlPost, 0, strpos($urlPost, "\""));
	  		$urlPost = "http://m.facebook.com" . $urlPost;
 
  			// do get some parameters for updating the status
  			$fbDtsg = substr($curl_data, strpos($curl_data, "name=\"fb_dtsg\""));
			$fbDtsg = substr($fbDtsg, strpos($fbDtsg, "value=") + 7);
  			$fbDtsg = substr($fbDtsg, 0, strpos($fbDtsg, "\""));
 
  			$postFormId = substr($curl_data, strpos($curl_data, "name=\"post_form_id\""));
  			$postFormId = substr($postFormId, strpos($postFormId, "value=") + 7);
  			$postFormId = substr($postFormId, 0, strpos($postFormId, "\""));
 
  			// do update facebook status
  			$curl = curl_init();
  			curl_setopt($curl, CURLOPT_URL, $urlPost);
  			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
  			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  			curl_setopt($curl, CURLOPT_POST, 1);
  			curl_setopt($curl, CURLOPT_POSTFIELDS, "fb_dtsg=" . $fbDtsg . "&post_form_id=" . $postFormId . "&status=" . $status . "&update=Update Status");
  			curl_setopt($curl, CURLOPT_ENCODING, "");
  			curl_setopt($curl, CURLOPT_COOKIEFILE, getcwd().'/cookies_facebook.cookie');
  			curl_setopt($curl, CURLOPT_COOKIEJAR, getcwd().'/cookies_facebook.cookie');
  			$curl_data = curl_exec($curl);
 			curl_close($curl);
 			//$this->Session->setFlash("Posted on Facebook!");
			if (file_exists (getcwd().'/cookies_facebook.cookie'))
				unlink(getcwd().'/cookies_facebook.cookie');
			return true;
        }
		
		function setlinkedinstatus($status) 
		{
			$userid = $this->Session->read('user_id');
			// set linkedin credentials
			$this->loadModel('Addednetwork');
			$addednetworks = $this->Addednetwork->find('all', array('conditions' => array('Addednetwork.user_id' => $userid, 'Addednetwork.network_id' => 3)));
			$username = $addednetworks[0]['Addednetwork']['network_username'];
            $password = $addednetworks[0]['Addednetwork']['network_password'];
 
			// login to linkedin
		  	$curl = curl_init();
 		 	curl_setopt($curl, CURLOPT_URL, "https://m.linkedin.com/session");
 		 	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
  			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);	
  			curl_setopt($curl, CURLOPT_POST, 1);
  			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_POSTFIELDS, "login=" . $username . "&password=" . $password . "&commit=Sign+In");
			curl_setopt($curl, CURLOPT_ENCODING, "");
			curl_setopt($curl, CURLOPT_COOKIEJAR, getcwd().'/cookies_linkedin.cookie');
			$curlData = curl_exec($curl);
			curl_close($curl);
 
		 	// update linkedin status
  			$curl = curl_init();
  			curl_setopt($curl, CURLOPT_URL, "http://m.linkedin.com/network_updates");
  			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
  			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  			curl_setopt($curl, CURLOPT_POST, 1);
  			curl_setopt($curl, CURLOPT_POSTFIELDS, "status=$status&commit=Save");
  			curl_setopt($curl, CURLOPT_ENCODING, "");
  			curl_setopt($curl, CURLOPT_COOKIEFILE, getcwd().'/cookies_linkedin.cookie');
  			curl_setopt($curl, CURLOPT_COOKIEJAR, getcwd().'/cookies_linkedin.cookie');
  			$curlData = curl_exec($curl);
  			curl_close($curl);
 			//$this->Session->setFlash("Posted On LinkedIn!");
			if (file_exists (getcwd().'/cookies_linkedin.cookie'))
				unlink(getcwd().'/cookies_linkedin.cookie');
			return true;
		}
				
		function tweet($status)
		{
		 	$userid = $this->Session->read('user_id');
			$this->loadModel('Addednetwork');
			$addednetworks = $this->Addednetwork->find('all', array('conditions' => array('Addednetwork.user_id' => $userid, 'Addednetwork.network_id' => 1)));
			$username = $addednetworks[0]['Addednetwork']['network_username'];
            $password = $addednetworks[0]['Addednetwork']['network_password'];
			if ($status)
			{
				$tweetUrl = 'http://www.twitter.com/statuses/update.xml';
				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, "$tweetUrl");
				curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 2);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_POST, 1);
				curl_setopt($curl, CURLOPT_POSTFIELDS, "status=$status");
				curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");
				$result = curl_exec($curl);
				$resultArray = curl_getinfo($curl);
				
				//if ($resultArray['http_code'] == 200)
				//$this->Session->setFlash('Posted on Twitter!');
				//else
				//$this->Session->setFlash('Could not post Tweet to Twitter right now. Try again later.');
				curl_close($curl);
				return true;
			}
		}
		
		function setfriendsterstatus($message)
		{
			
			$userid = $this->Session->read('user_id');
			// set friendster credentials
			$this->loadModel('Addednetwork');
			$addednetworks = $this->Addednetwork->find('all', array('conditions' => array('Addednetwork.user_id' => $userid, 'Addednetwork.network_id' => 4)));
			$username = $addednetworks[0]['Addednetwork']['network_username'];
            $password = $addednetworks[0]['Addednetwork']['network_password'];
			
			// login to friendster
  			$curl = curl_init();
  			curl_setopt($curl, CURLOPT_URL, "http://m.friendster.com/login/doLogin");
  			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
  			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  			curl_setopt($curl, CURLOPT_POST, 1);
  			curl_setopt($curl, CURLOPT_POSTFIELDS, "btnLogIn=Log In&email=" . $username . "&password=" . $password);
  			curl_setopt($curl, CURLOPT_ENCODING, "");
  			curl_setopt($curl, CURLOPT_COOKIEJAR, getcwd() . '/cookies_friendster.cookie');
  			$curlData = curl_exec($curl);
  			curl_close($curl);
 
  			// update friendster shoutout
  			$curl = curl_init();
  			curl_setopt($curl, CURLOPT_URL, "http://m.friendster.com/hp/editshoutout");
  			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
  			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  			curl_setopt($curl, CURLOPT_POST, 1);
  			curl_setopt($curl, CURLOPT_POSTFIELDS, "btnSend=Post&shoutout=" . $message);
  			curl_setopt($curl, CURLOPT_ENCODING, "");
  			curl_setopt($curl, CURLOPT_COOKIEFILE, getcwd() . '/cookies_friendster.cookie');
  			curl_setopt($curl, CURLOPT_COOKIEJAR, getcwd() . '/cookies_friendster.cookie');
  			$curlData = curl_exec($curl);
 			$resultArray = curl_getinfo($curl);
			//if ($resultArray['http_code'] == 200)
			//	$this->Session->setFlash("Posted on friendster!");
			//else
			//	$this->Session->setFlash('Could not post friendster right now. Try again later.');
			curl_close($curl);
			if (file_exists (getcwd().'/cookies_friendster.cookie'))
				unlink(getcwd().'/cookies_friendster.cookie');
			return true;
		}
		
		function hi5statusupdate($status) {
			$userid = $this->Session->read('user_id');
			// set HI5 credentials
			$this->loadModel('Addednetwork');
			$addednetworks = $this->Addednetwork->find('all', array('conditions' => array('Addednetwork.user_id' => $userid, 'Addednetwork.network_id' => 5)));
			$username = $addednetworks[0]['Addednetwork']['network_username'];
            $password = $addednetworks[0]['Addednetwork']['network_password'];
			$apikey = "a49331_3559726d7d4f95ad30081";
			$authclient = new SoapClient("http://api.hi5.com/hi5auth.wsdl");

    		$result = $authclient->auth_plain(array("username" => $username, "password" => $password, "api_key" => $apikey));
		    $obj = (array) $result;
			$object = (array) $obj['auth_plainResponse'];
			$authtoken = $object['_'];
			$HI5userid = $object['userId'];
    		$postdata = "Hi5AuthToken=$authtoken&userId=$HI5userid&status=$status";
			
			$curl = curl_init();
  			curl_setopt($curl, CURLOPT_URL, "http://api.hi5.com/rest/status/setStatus");
  			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
  			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  			curl_setopt($curl, CURLOPT_POST, 1);
  			curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
  			curl_setopt($curl, CURLOPT_ENCODING, "");
  			curl_setopt($curl, CURLOPT_COOKIEJAR, getcwd() . '/cookies_hi5.cookie');
  			$curlData = curl_exec($curl);
  			curl_close($curl);
			//if (!$curlData)
			//	$this->Session->setFlash("Posted on hi5!");
			//else
			//	$this->Session->setFlash('Could not post on hi5 right now. Try again later.');
			if (file_exists (getcwd().'/cookies_hi5.cookie'))
				unlink(getcwd() . '/cookies_hi5.cookie');
			return true;
		}
	
		function settumblerstatus($post_body)
		{
			$userid = $this->Session->read('user_id');
			// set tumblr credentials
			$this->loadModel('Addednetwork');
			$addednetworks = $this->Addednetwork->find('all', array('conditions' => array('Addednetwork.user_id' => $userid, 'Addednetwork.network_id' => 6)));
			$tumblr_email = $addednetworks[0]['Addednetwork']['network_username'];
            $tumblr_password = $addednetworks[0]['Addednetwork']['network_password'];
			
			// Data for new record
			$post_type  = 'regular';
			$post_title = '';
			
			// Prepare POST request
			$request_data = http_build_query(
		    array(
        		'email'     => $tumblr_email,
		        'password'  => $tumblr_password,
        		'type'      => $post_type,
		        'title'     => $post_title,
        		'body'      => $post_body,
		        'generator' => 'API example'
    			)
			);
			//$request_data = "email=$tumblr_email&password=$tumblr_password&type=$post_type&title=$post_title&body=$post_body&generator=API example";
			
			// Send the POST request (with cURL)
			$c = curl_init('http://www.tumblr.com/api/write');
			curl_setopt($c, CURLOPT_POST, true);
			curl_setopt($c, CURLOPT_POSTFIELDS, $request_data);
			curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($c);
			$status = curl_getinfo($c, CURLINFO_HTTP_CODE);
			curl_close($c);

			// Check for success
			//if ($status == 201) {
		    //$this->Session->setFlash("Posted on tumbler");
			//else
    		//$this->Session->setFlash("Could not post on tumbler this time.");
			return true;
		}
		
		function setidenticastatus($status)
		{
			$userid = $this->Session->read('user_id');
			// set identica credentials
			$this->loadModel('Addednetwork');
			$addednetworks = $this->Addednetwork->find('all', array('conditions' => array('Addednetwork.user_id' => $userid, 'Addednetwork.network_id' => 7)));
			$nickname = $addednetworks[0]['Addednetwork']['network_username'];
            $password = $addednetworks[0]['Addednetwork']['network_password'];
			
			$url = "http://identi.ca/api/statuses/update.xml";
							
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, "status=$status");
			curl_setopt($curl, CURLOPT_USERPWD, "$nickname:$password");
			$result = curl_exec($curl);
			$resultArray = curl_getinfo($curl);
			//if ($resultArray['http_code'] == 200)
			//$this->Session->setFlash('Posted on identi.ca!');
			//else
			//$this->Session->setFlash('Could not post on identi.ca right now.');
			curl_close($curl);
			return true;
		}
		
		function setshoutemstatus($status)
		{
			$userid = $this->Session->read('user_id');
			// set identica credentials
			$this->loadModel('Addednetwork');
			$addednetworks = $this->Addednetwork->find('all', array('conditions' => array('Addednetwork.user_id' => $userid, 'Addednetwork.network_id' => 8)));
			$username = $addednetworks[0]['Addednetwork']['network_username'];
            $password = $addednetworks[0]['Addednetwork']['network_password'];
			$network_subdomain = $addednetworks[0]['Addednetwork']['network_subdomain'];
			$url = "http://" .$network_subdomain . ".shoutem.com/api/twitter/1.0/statuses/update.xml";
					
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, "status=$status");
			curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");
			$result = curl_exec($curl);
			$resultArray = curl_getinfo($curl);
			//print_r ($result);
			//if ($resultArray['http_code'] == 200)
			//$this->Session->setFlash('Posted on shoutem!');
			//else
			//$this->Session->setFlash('Could not post shoutem right now. Try again later.');
				
			curl_close($curl);
			return true;
		}

/*************************************End Functions For Social Networks*********************************************/		

/*********************************added by Navneet :::::: For Photo Upload******************************************/
	function imageupload($file)
	{			
		if (isset($file))
		{	
			// list of permitted file types, this is only images but documents can be added 
			$permitted = array('image/gif','image/jpeg','image/pjpeg','image/png'); 
			$folder_url = realpath('../../app/webroot/img/user_images/') . '/';
			// assume filetype is false 
			$typeOK = false; 
			 
			switch($file['error']) 
			{ 
				case 0: 
				// check filetype is ok 
				foreach($permitted as $type) 
				{ 
					if($type == $file['type']) 
					{ 
						$typeOK = true; 
						break; 
					} 
				}
				// check filename already exists 
				if($typeOK)
				{ 
					// replace spaces with underscores 
					$ext = trim(substr($file['name'],strrpos($file['name'],".")+1,strlen($file['name'])));
					$filename = $this->Session->read('user_id').'.'.$ext; 
					// create full filename 
					$url = $folder_url.$filename; 
					// upload the file 
					if (is_uploaded_file($file['tmp_name']))
					{
						if (move_uploaded_file($file['tmp_name'], $url))
							$this->Session->setFlash('Photo uploaded successfully');
						else	
							$this->Session->setFlash('Photo uploading failed');
					}	
				}
				break;
				case 3:  
                // an error occured  
                $this->Session->setFlash('Error uploading photo. Please try again.');  
                break;  		 
				case 4:
				$this->Session->setFlash('No file Selected for photo');  
				break;
				default:  
                // an error occured  
                $this->Session->setFlash('System error uploading photo. Contact site administrator.');
			}
		}
	}	
/******************End added by Navneet :::::: Photo Upload**********************/

}//end class
?>