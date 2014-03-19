<?php

	class SubCatsController extends AppController {

		var $name = 'subcats';

	function index()
	{
		//echo CSS ."<br>".JS."<br>".WWW_ROOT;
		$this->set('subcats', $this->Subcat->find('all'));
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
			
			 $this->Subcat->id = $id;
			 $this->set('subcat', $this->Subcat->read());
			 $this->render('view');
		}	 
 	}
}
?>