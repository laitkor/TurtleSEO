<?php
class WpServersController extends AppController {

	var $name = 'wp_servers';
	var $paginate = array(
        'fields' => array('WpServer.id', 'WpServer.name','WpServer.rpc_url'),
        'limit' => 10,        
        'order' => array(
            'WpServer.id' => 'asc'
        )
		
    );
	
	var $helpers = array('Ajax','Javascript');
	
	
	
	function beforeFilter()
	{
		
		if( !($this->_isLoggedIn()) )
		{
			$this->Session->setFlash('<font color=red>You are not authorized to view this page</font>');
			$this->redirect('/users/sign_in');
		}		
		
	}
	
	/**
		This function list wp servers
	*/
	function index()
	{
		
		$this->paginate=array(
    			    'fields' => array('WpServer.id', 'WpServer.name','WpServer.rpc_url'),
        			'limit' => 10,        
        			'order' => array('WpServer.id' => 'desc'),
					'conditions'  => array('WpServer.user_id'  => $this->Session->read('user_id') )
		   		);
		$data=$this->paginate('WpServer');
		$this->set('blog',count($data));
		$this->set('data',$data);
	}

	
  /**
		This function adds server .
  */
	function add()
	{	
		$this->loadModel('UserPlan');
		$user_id=$this->Session->read('user_id');
		$plan=$this->UserPlan->query("select plans.name,plans.blog_limit,user_plans.blog_limit,user_plans.id from plans inner join user_plans on plans.id=user_plans.plan_id where ".
								" user_plans.user_id=$user_id");
		
		$plan_blog_limit=$plan[0]['plans']['blog_limit'];
		$user_blog_limit=$plan[0]['user_plans']['blog_limit'];
		if($plan_blog_limit!='umlimited')
		{
			$this->set('user_blog',$user_blog_limit);
			$this->set('total',$plan_blog_limit);
		
			if($user_blog_limit >=$plan_blog_limit)
			{
				$message="Please upgrade your plan. User blog limit has exceeded";
				$this->Session->setFlash($message);
				$this->redirect('/wp_servers/');
			}	
			
		}
	
		if (!empty($this->data)) 
		{
	
			$this->data['WpServer']['user_id']=$this->Session->read('user_id');
			if ($this->WpServer->save($this->data)) 
			{
			
				$this->UserPlan->id=$plan[0]['user_plans']['id'];
				$d['UserPlan']['blog_limit']=$user_blog_limit-1;
				$this->UserPlan->save($d);	
			
				$this->Session->setFlash('Blog has been added.');
				$this->redirect(array('action' => 'add'));
			}
		}
		
		
   }//end add

 
	/*
		Edits passed server id
		$id : server id to be edited
		Table : wp_servers	
	*/
	function edit($id) 
	{
		//validating passed server id	
		$id=trim($id);
		if(!$this->_checkId($id))
		{
			$this->Session->setFlash('Please enter a valid ID');
			$this->redirect('/wp_servers/');
		}
		
		$this->WpServer->id = $id;
		if (empty($this->data)) 
		{
			$this->data=$this->WpServer->read();
		}
		else
		{
			if ($this->WpServer->save($this->data))
			{		
				$this->Session->setFlash('Blog has been updated.');
				$this->redirect('/wp_servers/');
			}
		}	
		//$this->autoRender=false;
	}// end edit

	function delete($id)
	{
		$id=trim($id);
		$this->WpServer->delete($id,true);
		$this->WpServer->query("delete from posted_articles where wp_server_id=$id");	
		$this->redirect('/wp_servers/');
	}
	
	/**
		This function manages remote categories in wp servers.	
	*/
	function remote_categories()
	{
		
	}	
	
	
	/**
			This function add category in remote server
	*/
	function add_category()
	{
		if(!empty($this->data))
		{
			//pr($this->data);
			$server_id=trim($this->data['wp_server_id']);
			$cat_name=trim($this->data['cat_name']);
			
			if($server_id== "" || $cat_name == "")   //if user select blank combo or didn't enter category
			{
				$this->set('error',"Please select server or enter category name");
			}
			else
			{
				App::import('Vendor', 'remotepost');	
				if($server_id=='all')
				{
					$servers = $this->WpServer->find('all', array('fields' => array('WpServer.wp_admin_id','WpServer.wp_admin_password','WpServer.rpc_url'),'conditions'=>array('WpServer.user_id' => $this->Session->read('user_id'))));
					
					foreach($servers as $key => $value)
					{
						$this->client = new IXR_Client($servers[$key]['WpServer']['rpc_url']);
						$details['name']=$cat_name;  //used for sending parameters in newCategory
						if($this->client->query('wp.newCategory','',$servers[$key]['WpServer']['wp_admin_id'],$servers[$key]['WpServer']['wp_admin_password'],$details))
						{
							$this->client->getResponse();
							$this->set('message',"Category added successfully");
						}
						else
						{
							/*
							$message.="SERVER :" .$servers[$key]['WpServer']['rpc_url'].":".$this->client->getErrorCode().":".$this->client->getErrorMessage();
							$message.='<br>';*/
						}
					}//end for	
				}
				else
				{
					$server=$this->WpServer->findById($server_id);
					$this->client = new IXR_Client($server['WpServer']['rpc_url']);
					$details['name']=$cat_name;  //used for sending parameters in newCategory
					if($this->client->query('wp.newCategory','',$server['WpServer']['wp_admin_id'],$server['WpServer']['wp_admin_password'],$details))
					{
						$this->client->getResponse();
						$this->set('message',"Category added successfully");
					}
					else
					{	/*
						$message.="SERVER :" .$server['WpServer']['rpc_url'].":".$this->client->getErrorCode().":".$this->client->getErrorMessage();
						$message.='<br>';*/
					}
					
				}
			}//end else 
			
		} //if not empty(this->data)
		$servers=$this->WpServer->find('list',array('fields' => 'WpServer.name','conditions' => array('WpServer.user_id' => $this->Session->read('user_id'))));
		asort($servers);
		//pr($servers);
		$this->set('wp_server_ids',$servers);    //load all wp_servers in combo box from local table
		$this->render('add_category','modalbox');
	} //end function
	
	
	/**
		This function deletes category from selected wp_server and cat_id
	*/
	function delete_category()
	{
		if(!empty($this->data))
		{
			//pr($this->data);
			$server_id=trim($this->data['wp_server_id']);
			$cat_id=trim($this->data['cat_names']);
			
			if($server_id== "select" || $cat_id == "")   //if user select blank combo or didn't select category
			{
				$this->set('error',"Please select server or select category name");
			}
			else
			{
				App::import('Vendor', 'remotepost');	
				$server=$this->WpServer->findById($server_id);
				$this->client = new IXR_Client($server['WpServer']['rpc_url']);
				
				if($this->client->query('wp.deleteCategory','',$server['WpServer']['wp_admin_id'],$server['WpServer']['wp_admin_password'],$cat_id))
				{
					$this->client->getResponse();
					$this->set('message',"Category deleted successfully");
				}
				else
				{	/*
					$message.="SERVER :" .$server['WpServer']['rpc_url'].":".$this->client->getErrorCode().":".$this->client->getErrorMessage();
					$message.='<br>';*/
					$this->set('message',$this->client->getErrorMessage());

				}
			}//end else

		} //if not empty(this->data)
		$servers=$this->WpServer->find('list',array('fields' => 'WpServer.name','conditions' => array('WpServer.user_id' => $this->Session->read('user_id'))));
		asort($servers);
		$this->set('wp_server_ids',$servers);    //load all wp_servers in combo box from local table
		$this->render('delete_category','modalbox');
	}//end delete category function
	
	
	function update_cat()   //call by ajax when server combox changes(observeField)
	{
		//pr($this->data);
		$server_id=$this->data['wp_server_id'];
		//echo $server_id;
		//exit;
		if($server_id!='select')  //check if user select 'please select'
		{ 
			App::import('Vendor', 'remotepost');
			$server=$this->WpServer->findById($server_id);
			$this->client = new IXR_Client($server['WpServer']['rpc_url']);
			if($this->client->query('wp.getCategories','',$server['WpServer']['wp_admin_id'],$server['WpServer']['wp_admin_password']))
			{
				
				$categories=$this->client->getResponse();
				//pr($categories);
				//pr($categories[0]['categoryName']);
				foreach($categories as $key => $value)
				{
				
				$option[$value['categoryId']]=$value['categoryName'];
				}
				asort($option);
				$this->set('option',$option);
			}	
			else
			{}
		}
		$this->layout = 'ajax';
	}
	
	/**
	  Performs :
	  a : checks passed server id is valid or not.
	  b : detects passed server id exists in database or not.
	*/	
	function _checkId($id)
	{
		//passed id null or string
	 	if($id==null OR !(is_numeric($id)))
		return false;
		//Checking server id exist or not in database
		if( $this->WpServer->find( 'count', array('conditions' => array('WpServer.id' => $id)) ) <= 0 )
		return false;
		
		return true;
	} //end checkId


	/*************************************************************ADD PAGE SECTION********************************************************/
	/**
		This functions adds page to Wp Server	
	**/
	function add_page($id=null)
	{
				
			if(!empty($this->data))
			{
				$title=trim($this->data['title']);
				$page_desc=trim($this->data['page_desc']);
				$id=trim($this->data['wp_server_id']);
				if($title=="" || $page_desc=="" || $id=="")
				{
					$this->set('msg',"<font color='red'>Please fill form</font>");
				}
				else
				{	
				
					$this->WpServer->id = $id;
					$wp_server=$this->WpServer->read();
					$wp_server['WpServer']['rpc_url']=trim($wp_server['WpServer']['rpc_url']);
					App::import('Vendor', 'remotepost');
				
					try
					{
						$page_exists=false;
						$this->client = new IXR_Client($wp_server['WpServer']['rpc_url']);  //making client
						$content['title']=$title;
						$content['description']=$page_desc;
					
						$this->client->query('wp.getPageList','',$wp_server['WpServer']['wp_admin_id'],$wp_server['WpServer']['wp_admin_password']);
						$pages=$this->client->getResponse();
						foreach($pages as $key => $value)  //checking already exist in wp server or not.if exists then no need to add page.else add page.
						{
							if($value['page_title']==$title)
							{
								$page_exists=true;
								break;
							}
						}
						//exit;
						
						//limit setting
						$this->loadModel('UserPlan');
						$user_id=$this->Session->read('user_id');
						$plan=$this->UserPlan->query("select plans.name,plans.page_limit,user_plans.page_limit,user_plans.id from plans inner join user_plans on plans.id=user_plans.plan_id ". 										 			"  where user_plans.user_id=$user_id");
		
						$plan_page_limit=$plan[0]['plans']['page_limit'];
						$user_page_limit=$plan[0]['user_plans']['page_limit'];
						if($plan_page_limit!='umlimited')
						{
							//$this->set('user_page',$user_page_limit);
							//$this->set('total',$plan_blog_limit);
							if($user_page_limit >=$plan_page_limit)
							{
								$message="Please upgrade your plan.User page limit is exceeded";
								$this->Session->setFlash($message);
								$this->redirect('/wp_servers/');
							}	
			
						}
						//end limit setting
						if(!$page_exists)
						{
							$this->client->query('wp.newPage','',$wp_server['WpServer']['wp_admin_id'],$wp_server['WpServer']['wp_admin_password'],$content,true);
							
							//limit setting
							$this->UserPlan->id=$plan[0]['user_plans']['id'];
							$d['UserPlan']['page_limit']=$user_page_limit+1;
							$this->UserPlan->save($d);	
							//end limit setting
							//$this->Session->setFlash($message);
							//$message ="<font color=red>Page added to the server.</font>";
							//
							$this->Session->setFlash("Page added to the server.");
							$this->redirect('/wp_servers/');
						}
						else
						{
							//$message = "<font color=red>Page already exists. Please try with different page title.</font>";
							//$this->Session->setFlash($message);
							$this->Session->setFlash("<font color=red>Page already exists. Please try with different page title.</font>");
						}
					
				}catch(Exception $e){}
				
			}///end else if page submitted with title and desc
		}//end if	
		$wp_server_ids=$this->WpServer->find('list',array('fields' => 'WpServer.name','conditions' => array('WpServer.user_id' => $this->Session->read('user_id'))));
		$this->set('wp_server_ids',$wp_server_ids);
	}//END ADD PAGE
	
	
	/*************************************************************BLOG PAGE SECTION********************************************************/
	/**
		This functions adds page to Wp Server	
		takes wp_server_id from hidden text field. Because it is called from dashboard where as add_page() takes wp_server_id from drop down
	**/
	function page_add($id=null)
	{
			if(empty($id) && empty($this->data['wp_server_id']))
			{
				$this->redirect('/dashboards/');
			}
			if(empty($id))
			$s_id=$this->data['wp_server_id'];  //this is for detecting call by dashboard or form
			else
			$s_id=$id;
						
			if(!($this->_checkId($s_id)))
			{
				$this->redirect('/dashboards/');
			}	
			if(!empty($this->data))
			{
				$title=trim($this->data['title']);
				$page_desc=trim($this->data['page_desc']);
				$id=trim($this->data['wp_server_id']);
				if($title=="" || $page_desc=="" || $id=="")
				{
					$this->set('msg',"<font color='red'>Please fill form</font>");
				}
				else
				{	
				
					$this->WpServer->id = $id;
					$wp_server=$this->WpServer->read();
					$wp_server['WpServer']['rpc_url']=trim($wp_server['WpServer']['rpc_url']);
					App::import('Vendor', 'remotepost');
				
					try
					{
						$page_exists=false;
						$this->client = new IXR_Client($wp_server['WpServer']['rpc_url']);  //making client
						$content['title']=$title;
						$content['description']=$page_desc;
					
						$this->client->query('wp.getPageList','',$wp_server['WpServer']['wp_admin_id'],$wp_server['WpServer']['wp_admin_password']);
						$pages=$this->client->getResponse();
						foreach($pages as $key => $value)  //checking already exist in wp server or not.if exists then no need to add page.else add page.
						{
							if($value['page_title']==$title)
							{
								$page_exists=true;
								break;
							}
						}
						//exit;
						
						//limit setting
						$this->loadModel('UserPlan');
						$user_id=$this->Session->read('user_id');
						$plan=$this->UserPlan->query("select plans.name,plans.page_limit,user_plans.page_limit,user_plans.id from plans inner join user_plans on plans.id=user_plans.plan_id ". 										 			"  where user_plans.user_id=$user_id");
		
						$plan_page_limit=$plan[0]['plans']['page_limit'];
						$user_page_limit=$plan[0]['user_plans']['page_limit'];
						if($plan_page_limit!='umlimited')
						{
							//$this->set('user_page',$user_page_limit);
							//$this->set('total',$plan_blog_limit);
							if($user_page_limit >=$plan_page_limit)
							{
								$message="Please upgrade your plan. User page limit has exceeded";
								$this->Session->setFlash($message);
								$this->redirect('/wp_servers/');
							}	
			
						}
						//end limit setting
						if(!$page_exists)
						{
							$this->client->query('wp.newPage','',$wp_server['WpServer']['wp_admin_id'],$wp_server['WpServer']['wp_admin_password'],$content,true);
							
							//limit setting
							$this->UserPlan->id=$plan[0]['user_plans']['id'];
							$d['UserPlan']['page_limit']=$user_page_limit+1;
							$this->UserPlan->save($d);	
							//end limit setting
							
							$this->set('msg',"<font ><b>Page added to the server</b></font>");
						}
						else
						{
							$this->set('msg',"<font color='red'>Page already exists. Please try with different page title</font>");
						}
					
				}catch(Exception $e){}
				
			}///end else if page submitted with title and desc
		}//end if	
		//$wp_server_ids=$this->WpServer->find('list',array('fields' => 'WpServer.name','conditions' => array('WpServer.user_id' => $this->Session->read('user_id'))));
		if(!empty($id))
		$this->set('wp_server_id',$id);
		else
		$this->set('wp_server_id',$this->data['wp_server_id']);
	}//END BLOG PAGE
	
	
	
	
	function delete_page()
	{
		if(!empty($this->data))
		{
			//pr($this->data);
			$server_id=trim($this->data['wp_server_id']);
			$page_id=trim($this->data['page_id']);
			
			if($server_id== "select" || $page_id == "")   //if user select blank combo or didn't select category
			{
				$this->set('error',"Please select server or select category name");
			}
			else
			{
				App::import('Vendor', 'remotepost');	
				$server=$this->WpServer->findById($server_id);
				$this->client = new IXR_Client($server['WpServer']['rpc_url']);
				
				if($this->client->query('wp.deletePage','',$server['WpServer']['wp_admin_id'],$server['WpServer']['wp_admin_password'],$page_id))
				{
					$this->client->query('wp.deletePage','',$server['WpServer']['wp_admin_id'],$server['WpServer']['wp_admin_password'],$page_id);
					$this->client->getResponse();
					//$this->set('message',"Page deleted successfully");
					$this->session->setFlash("Page deleted successfully");
				}
				else
				{	/*
					$message.="SERVER :" .$server['WpServer']['rpc_url'].":".$this->client->getErrorCode().":".$this->client->getErrorMessage();
					$message.='<br>';*/
					$this->set('message',$this->client->getErrorMessage());

				}
			}//end else

		} //if not empty(this->data)
		$servers=$this->WpServer->find('list',array('fields' => 'WpServer.name','conditions' => array('WpServer.user_id' => $this->Session->read('user_id'))));
		asort($servers);
		$this->set('wp_server_ids',$servers);    //load all wp_servers in combo box from local table
	}//END DELETE PAGE
	
	
	function update_page()   //call by ajax when server combox changes(observeField)
	{
		//pr($this->data);
		$server_id=$this->data['wp_server_id'];
		//echo $server_id;
		//exit;
		if($server_id!='select')  //check if user select 'please select'
		{ 
			App::import('Vendor', 'remotepost');
			$server=$this->WpServer->findById($server_id);
			$this->client = new IXR_Client($server['WpServer']['rpc_url']);
			if($this->client->query('wp.getPageList','',$server['WpServer']['wp_admin_id'],$server['WpServer']['wp_admin_password']))
			{
				
				$pages=$this->client->getResponse();
				//pr($pages);
				//pr($categories);
				//pr($categories[0]['categoryName']);
				foreach($pages as $key => $value)
				{
				
					$option[$value['page_id']]=$value['page_title'];
				}
				//pr($option);
				asort($option);
				$this->set('option',$option);
			}	
			else
			{}
		}
		$this->layout = 'ajax';
	}
	
	
	/**
	This function is used to take user to cloudegg site
	*/
	function create_blog()
	{		}
}//end class
	

?>