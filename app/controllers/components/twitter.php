<?php
/**
* Twitter Component
*/
//require 'twitter/twitteroauth.php';
App::import('Vendor','twitter' ,array('file'=>'twitter/twitteroauth.php'));

class TwitterComponent extends Object { 

	var $name = 'Twitter';
	var $components = array('Session');
	var $twitterOAuth;
	
	
	public function setup($consumer_key, $consumer_secret, $flag) {
		
		// The TwitterOAuth instance
		$this->twitterOAuth = new TwitterOAuth($consumer_key, $consumer_secret);		
	}
	
	public function connect($call_back) {
		// Requesting authentication tokens, the parameter is the URL we will be redirected to
		$request_token = $this->twitterOAuth->getRequestToken($call_back);
				
		// Saving them into the session
		$this->Session->write('oauth_token', $request_token['oauth_token']);
		$this->Session->write('oauth_token_secret', $request_token['oauth_token_secret']);		
		
		return $this->twitterOAuth->http_code;
	}
	
	public function get_authorize_url($oauth_token) {
		// Let's generate the URL
    	$url = $this->twitterOAuth->getAuthorizeURL($oauth_token);
		
		return $url;
	}
	
	public function get_user_info($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret, $oauth_verifier) {
		// TwitterOAuth instance, with two new parameters
		$this->twitterOAuth = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
		
		// Let's request the access token
		$access_token = $this->twitterOAuth->getAccessToken($oauth_verifier);	
		
		if (!empty($access_token['oauth_token'])) {
		
			// Save it in a session var
			$this->Session->write('access_token', $access_token);
			
			// Let's get the user's info
			$user_info = $this->twitterOAuth->get('account/verify_credentials');
			
			return $user_info;
		} else {
			return "error";
		}
	}
}