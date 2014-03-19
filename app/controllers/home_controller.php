<?php
class HomeController extends AppController {

	var $name = 'home';
	var $uses='';
    

  /**
		This is a base function for showing home page contents .
  */
  
	function index()
	{
		$this->render('home');
	}	
	
	function faq()
	{
		$this->render('faq');
	}	
	
	function terms_conditions($layout=null)
	{
		if(isset($layout) && $layout=='modal')
		$this->render('terms_conditions','modalbox');
		else
		$this->render('terms_conditions');
		
	}
	
	function privacy_policy()
	{
		$this->render('privacy_policy');
	}
	
	function terms_conditions_modal()
	{
		$this->render('terms_conditions_modal','modalbox');
	}

}//end class

?>