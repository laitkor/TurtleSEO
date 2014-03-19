<?php

class DashboardsController extends AppController
{ 

		var $name = 'dashboards';
		var $uses='';
		var $helpers = array('Javascript','Ajax');
		//var $components=array('Breadcrumb');	
	
	
	function beforeFilter()
	{
		
		if( !($this->_isLoggedIn()) )
		{
			$this->Session->setFlash('You are not authorized to view this page.');
			$this->redirect('/users/sign_in');
		}		
		
	}
	


	
	/**
		This function is used to sign up user to their dashboard.
	**/
	function index()
	{	
	// ============= To check if its admin =============
	$checkAdmin=$this->Session->read('isAdmin');
	$adminCode=$this->Session->read('secureCode');
	$realcode=md5('sQG6_5Hg9S06o55SV4YSeWt3S6');
	if($checkAdmin=='true' && $realcode==$adminCode){
	    $this->set('show_admin_tab',1);
	}
	 // ============= end check if its admin =============
	 
		$this->loadModel('UserPlan');
		$this->loadModel('User');
		
		$user_id=$this->Session->read('user_id');
		
		//$user_status=$this->Session->read('user_status');
		$user=$this->User->findById($user_id);
		$user_status=$user['User']['status'];
		if($user_status!=1)
		{
			$plan=$this->UserPlan->query("select plans.name,plans.price,plans.description from plans inner join user_plans on plans.id=user_plans.plan_id where user_plans.user_id=$user_id");
	
			if(strtolower($plan[0]['plans']['name']) != strtolower('free'))
			{	
				$plan_name=ucfirst($plan[0]['plans']['name']);
				$this->set('plan_name',$plan_name);
				//$this->set('disable','true');  // manish 
				//$this->redirect('/dashboards/');	
				//$this->render('pagesplans');
			}
		}
		
		//getting blog detail
		$this->loadModel('WpServer');
		$servers=$this->WpServer->find('all',array('fields' => array('WpServer.id','WpServer.name'),'conditions' => array('WpServer.user_id' => $this->Session->read('user_id'),'WpServer.active'=>1),'limit' => 3,'order' => array('WpServer.id' => 'desc')));
		$this->set('servers',$servers);
		//pr($servers[0]['WpServer']['name']);exit;
		//getting post detail
		$this->loadModel('Article');
		$posts=$this->Article->find('all',array('fields' => array('Article.id','Article.title'),'conditions' => array('Article.user_id' => $this->Session->read('user_id')),'limit' => 3,'order' => array('Article.id' => 'desc')));
		$this->set('posts',$posts);
		
		//getting reports
		$this->loadModel('Report');
		$reports = $this->Report->find('all', array('conditions' => array('Report.user_id' => $this->Session->read('user_id')),'order'=>array('Report.date_created DESC'),'limit' => 3 ));						   
		
		$this->set('reports',$reports);
		
		$this->render('index');
	}

	
	
	
 	
}//end class
?>
