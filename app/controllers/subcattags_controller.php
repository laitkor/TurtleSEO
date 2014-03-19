<?php

	class SubCatTagsController extends AppController {

		var $name = 'subcattags';

	function index()
	{
		//echo CSS ."<br>".JS."<br>".WWW_ROOT;
		$this->set('subcatstag', $this->Subcattag->find('all'));
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
			
			 $this->Subcatstag->id = $id;
			 $this->set('subcatstag', $this->Subcattag->read());
			 $this->render('view');
		}	 
 	}
}
?>