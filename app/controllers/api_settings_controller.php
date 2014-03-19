<?php
class ApiSettingsController extends AppController {

	var $name = 'api_settings';


	function beforeFilter()
	{
		
		if( !($this->_isLoggedIn()) )
		{
			$this->Session->setFlash('You Are Not Authorized To View This Page');
			$this->redirect('/users/sign_in');
		}		
		
	}
	
	
	function index()
	{
		$this->paginate=array(
    			    'fields' => array('ApiSetting.id', 'ApiSetting.name'),
        			'limit' => 10,        
        			'order' => array(
            		'ApiSetting.id' => 'asc'
       				 ),
					'conditions'  => array('ApiSetting.user_id'  => $this->Session->read('user_id') )
		   		);
		$data=$this->paginate('ApiSetting');
		$this->set('data',$data);
	}
	
	/**
		This function adds API to table api_settings;
	*/
	
	
	function add()
	{
		
		if (!empty($this->data)) 
		{
		 if($this->data['ApiSetting']['name']=='Google_Analytics'){
		// live validation start 
 		App::import('Vendor', 'analytics');	
			try{ 
					$oAnalytics = new analytics($this->data['ApiSetting']['api_key'], $this->data['ApiSetting']['api_password']);
					$oAnalytics->setProfileById("ga:".$this->data['ApiSetting']['api_token']);
		
					$oAnalytics->setMonth(date('n'), date('Y'));
					$pgs="";
					$page_views=$oAnalytics->getVisitors();
					 
			} catch (Exception $e) { 
				//$this->Session->setFlash('<font color="red">Please enter valid API credentials</font>');
				$this->Session->write('api_message', '<font color="red">Please enter valid API credentials</font>');	
				//$this->set('msg',"Please Enter Valid API credentials");
				$this->redirect('/api_settings/add/');
			}
		}//else if($this->data['ApiSetting']['name']=='Ping'){
			
		//}	
		//live validation end			
									
		// if already added with the same name
   $apiUrl=$this->data['ApiSetting']['api_url'];
	  if($this->data['ApiSetting']['name']=='Google_Analytics'){			 
				$api=$this->ApiSetting->find('all', array('conditions' => array('ApiSetting.user_id' =>$this->Session->read('user_id'),'ApiSetting.name' =>$this->data['ApiSetting']['name'],"OR" => array("ApiSetting.api_url like" => "%$apiUrl%",)
			  )));
				
		}
		/*else if($this->data['ApiSetting']['name']=='Ping'){
		 $api=$this->ApiSetting->find('all', array('conditions' => array('ApiSetting.user_id' =>$this->Session->read('user_id'),'ApiSetting.name' =>$this->data['ApiSetting']['name'])));

		}*/	
			
			if(count($api)>0)
				{
					//$this->Session->setFlash('You Already Added Ping.fm API.');
					$this->redirect(array('action' => 'add'));
				} 
			
			$type=strtolower($this->data['ApiSetting']['name']);
			
			if($type=='google_analytics'){
			$this->data['ApiSetting']['api_token']=trim($this->data['ApiSetting']['api_token']);
			}else if($this->data['ApiSetting']['name']=='Ping'){
			$this->data['ApiSetting']['api_token']='';
			$this->data['ApiSetting']['api_url']='';
			}
			$this->data['ApiSetting']['user_id']=$this->Session->read('user_id');
			$this->data['ApiSetting']['created']=date("Y-m-d H:i:s", strtotime("now"));
			if ($this->ApiSetting->save($this->data)) 
			{
				$this->Session->setFlash('API has been added.');
				$this->redirect(array('action' => 'add'));
			}
		}
		
		//before
		//$apis=array('Ping' => 'Ping','Google_Analytics'=>'Google Analytics','Ad_Word' =>'Ad Word');
		//now
		$apis=array('Google_Analytics'=>'Google Analytics','Ping' => 'Ping.fm');
		$this->set('api_names',$apis);
	}

	/*
		Edits passed api id
		$id : api id to be edited
		Table : api_settings	
	*/
	function edit($id) 
	{
		//validating passed server id	
		$id=trim($id);
		if(!$this->_checkId($id))
		{
			$this->Session->setFlash('Please Enter Valid ID');
			$this->redirect('/api_settings/');
		}
		
		$this->ApiSetting->id = $id;
		if (empty($this->data)) 
		{
			$this->data=$this->ApiSetting->read();		
		 $this->set('NameType',$this->data['ApiSetting']['name']); 
 
		}
		else
		{
 
	// live validation
 
 if( $this->ApiSetting->find( 'count', array('conditions' => array('ApiSetting.id' => $id,'ApiSetting.user_id' =>$this->Session->read('user_id'),'ApiSetting.name' => 'Google_Analytics', )) ) > 0 ){
//"GA  case";
 App::import('Vendor', 'analytics');	
 	try{ 
			$oAnalytics = new analytics($this->data['ApiSetting']['api_key'], $this->data['ApiSetting']['api_password']);
			$oAnalytics->setProfileById("ga:".$this->data['ApiSetting']['api_token']);

			$oAnalytics->setMonth(date('n'), date('Y'));
			$pgs="";
			$page_views=$oAnalytics->getVisitors();
			 
	} catch (Exception $e) { 
	    $this->Session->setFlash('Please Enter Valid API credentials');
		$this->redirect('/api_settings/edit/'.$id);
}

}
//else{
//"Ping or Non GA case";
//} 

 			if($this->data['ApiSetting']['name']=='Ping'){
				$this->data['ApiSetting']['api_token']='';
				$this->data['ApiSetting']['api_url']='';
				$this->data['ApiSetting']['description']='';
			} 
 
			if ($this->ApiSetting->save($this->data))
			{		
				$this->Session->setFlash('API  has been updated.');
				$this->redirect('/api_settings/');
			}
		}	
		//$this->autoRender=false;
		$apis=array('Ping' => 'Ping','Google_Analytics'=>'Google Analytics','Ad_Word' =>'Ad Word');
		$this->set('api_names',$apis);
	}// end edit
	
	/**
		Deletes API from table api_settings
	**/
	function delete($id)
	{
		$id=trim($id);
		$this->ApiSetting->delete($id);
		$this->Session->setFlash('API  has been deleted.');
		$this->redirect('/api_settings/');
	}
	
 
	/**
	  Performs : UTILITY FUNCTION
	  a : checks passed api id is valid or not.
	  b : detects passed api id exists in database or not.
	*/	
	function _checkId($id)
	{
		//passed id null or string
	 	if($id==null OR !(is_numeric($id)))
		return false;
		//Checking server id exist or not in database
		if( $this->ApiSetting->find( 'count', array('conditions' => array('ApiSetting.id' => $id)) ) <= 0 )
		return false;
		
		return true;
	} //end checkId
	
}//end class
	

?>