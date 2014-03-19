<?php

	class MainCatsController extends AppController {

		var $name = 'maincats';
		var $helpers = array('Javascript','Ajax','Html');


	function beforeFilter()
	{
		
		if( !($this->_isLoggedIn()) )
		{
			$this->Session->setFlash('You Are Not Authorized To View This Page');
			$this->redirect('/');
		}		
		
	}
	
	function index()
	{	
		$userid = $this->Session->read('user_id');
		//echo CSS ."<br>".JS."<br>".WWW_ROOT;
		$this->set('maincats', $this->Maincat->find('all', array('conditions' => array('Maincat.user_id' => $userid))));
		$this->render('index');
	}

 	function view($id = null) 
 	{
		 if($id==null)
		 {
		 	$this->Session->setFlash('Redirecting to index page');
			$this->redirect('/index');
	        
		}
		else
		{
			
			 $this->Maincat->id = $id;
			 $this->set('maincat', $this->Maincat->read());
			 $this->render('view');
		}	 
 	}
//start manish
		function add($id=null) {
		
		if ($id <> '' )
		{
  		if( $this->Maincat->find('count', array('conditions' => array('Maincat.id' => $id, 'Maincat.user_id' => $this->Session->read('user_id'))) ) <= 0 )
			{
				$this->Session->setFlash('Please enter valid ID');
				$this->redirect('/maincats/add');
			}
		}
		
		// if form is not empty
		if (!empty($this->data)) {
			
			// post is currently valid
			$postValid = TRUE;
			//if the post is not empty
						
			if(!empty($this->data['name']))
			{
				$this->data['Maincat']['name']=$this->data['name'];
				$this->data['Maincat']['url']=$this->data['url'];
				//$this->data['Maincat']['edb_name']=$this->data['edb_name'];
				//$this->data['Maincat']['tips']=$this->data['tips'];
				//$this->data['Maincat']['footer']=$this->data['footer'];
				//$this->data['Maincat']['meta_keywords']=$this->data['meta_keywords'];
				//$this->data['Maincat']['meta_desc']=$this->data['meta_desc'];
				$this->data['Maincat']['user_id']=$this->Session->read('user_id');
				// try finding a post in the database with the slug name
				$maincat = $this->Maincat->findByName($this->data['Maincat']['name']);
				// if a post has been found
				if(!empty($maincat)) 
				{
					// invalidate the slug, this will enable the error msg in the view
					$this->Maincat->invalidate('name');
					// set the slug error message
					$this->set('name_error', 'A Category with the same name already exists');
					// invalidate the post
					$postValid = FALSE;
				}
				else
				{
					if ($this->Maincat->save($this->data)) 
					{
						$this->Session->setFlash('The main category has been saved successfully');
						$this->redirect('/maincats/index');
					}
					else 
					{
						$this->Session->setFlash('Please fill all fields properly.');
					}
				}
			}
			else
			{
				// default slug error message
				$this->set('name_error', 'Please enter the category name');
			}
			// only continue if the post is valid
		}
	}
//end manish

		function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for delete main category');
			$this->redirect('/maincats/index');
		}
		if ($this->Maincat->del($id)) {
			$this->Session->setFlash('The main category deleted: id '.$id.'');
			$this->redirect('/maincats/index');
		}
	}
// delete Main category

	function edit($id = null)
	{
		if( $this->Maincat->find( 'count', array('conditions' => array('Maincat.id' => $id)) ) <= 0 )
		{
			$this->Session->setFlash('Please enter valid ID');
			$this->redirect('/maincats/index');
		}
		
		$this->Maincat->id = $id;
	
		if (empty($this->data)) 
		{
			$this->data=$this->Maincat->read();
			$this->set('category_id', $id);
			$this->set('category_name', $this->data['Maincat']['name']);
			//$this->set('category_url', $this->data['Maincat']['url']);
		}
		else
		{
			if ($this->Maincat->save($this->data))
			{	
				$this->Session->setFlash('Category has been updated.');
				$this->redirect('/maincats/');
			}
		}
		
	}

//end dete main category
}
?>
