<?php
class AuthorsController extends AppController {

	var $name = 'authors';
	var $uses = array('Author');
	//var $helpers = array('Html', 'Javascript', 'Ajax');
	// var $components = array( 'RequestHandler' );
	
	/*var $components = array('Security');
	 function beforeFilter() {
        $this->Security->loginOptions = array(
            'type'=>'basic',
            'realm'=>'MyRealm'
        );
        $this->Security->loginUsers = array(
            'john'=>'johnspassword',
            'jane'=>'janespassword'
        );
        $this->Security->requireLogin();
    }
    */
	var $helpers = array('Html','Ajax','Javascript');
	//var $components = array('RequestHandler');
	
   
    function index()
	{
       	$aRes = $this->Author->find();
		pr($aRes);
		exit();
    }
}
?>