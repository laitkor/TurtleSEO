<?php

	class KeyPhraseAssignmentsController extends AppController {

		var $name = 'key_phrase_assignments';
		var $helpers = array('Javascript');
	
	
	
	/**
		This function shows table according to query fired for editing key_phrase_assignment.
	**/
	function index($article_id)
	{
	
		//checking valid article id
		if( empty($article_id) || !(is_numeric($article_id)))
		{
			$this->Session->setFlash("Please enter a valid article ID");
			$this->redirect('/articles/listings');	
		}
		
		
		
		$this->loadModel('Article');
		$this->Article->id=$article_id;
		$article=$this->Article->read();
	
		
		$data =$this->KeyPhraseAssignment->query("select p.phrase,ap.phrases_id,ap.freq,gs.month_vol,gs.raw_comp,".
									" gs.dir_comp from articles_phrases ap inner join googstats gs ".
									" on gs.phrases_id=ap.phrases_id inner join phrases p on " .
								" p.id =ap.phrases_id where gs.month_vol>0 and ap.articles_id=$article_id order by ap.freq desc");
		
		if(count($data)<=0)
		{
			$this->Session->setFlash("Entered article ID is not valid in database");
			$this->redirect('/articles/listings');	
		}
		
		//print_r($data);
		//fetching phrases_id from data array above		
		foreach($data as $key => $value)
		$phrases[]=$data[$key]['ap']['phrases_id'];
	 	 	
		//fectching phrase id from key_phrase_assignment table
	  	$assignedPhrases=$this->KeyPhraseAssignment->find('all',array( 
												'conditions' => array('KeyPhraseAssignment.articles_id !=' => $article_id),
												'fields' => array('KeyPhraseAssignment.phrases_id')) );
		foreach($assignedPhrases as  $key => $value)
		$assigned[]=$assignedPhrases[$key]['KeyPhraseAssignment']['phrases_id'];
		
		
		//checking key_phrase of article
		$ph=$this->KeyPhraseAssignment->findByArticlesId($article_id);
		$assignedPhraseId=$ph['KeyPhraseAssignment']['phrases_id'];
		
		$this->set('assignedPhraseId',$assignedPhraseId);		
	   	$this->set('phrases',$phrases);	// phrases id belongs to a article
	    $this->set('assigned',$assigned);	//assigned phrase id found in key_phrase_assignments table
		
		
		$this->set('data',$data);
		$this->set('article_id',$article['Article']['id']);
		$this->set('article_title',$article['Article']['title']);
		
	}

	function save($article_id)
	{
		//echo $article_id;
		
		if(empty($article_id))
		{
			$this->Session->setFlash('Please enter a valid ID');
			$this->redirect('/articles/listings');
		}
		
		if(isset($_POST['phr'][0]))
		$phrase_id=(int)$_POST['phr'][0];
		else
		$phrase_id="blankCheckBox";
		
		//getting if phrase id is assigned to a article
		$ph=$this->KeyPhraseAssignment->findByArticlesId($article_id);
	
		if($ph)
		$assigned=(int)$ph['KeyPhraseAssignment']['phrases_id'];
		else
		$assigned="notAssigned";
		
		
		if(($assigned != 'notAssigned') && ($phrase_id != 'blankCheckBox'))
		{
			if($phrase_id==$assigned)
			$message="No changes Has  Made";
			
			else  //update
			{
 			$this->KeyPhraseAssignment->query("update key_phrase_assignments  set phrases_id=$phrase_id where ".
											"  articles_id=$article_id");												
			$message="Key phrase has been successfully updated";	
			}
		
		$this->Session->setFlash($message ." for article ID : $article_id");
		$this->redirect('/articles/listings');

		}
		
		else if( ($assigned != 'notAssigned') && ($phrase_id == 'blankCheckBox') )
		{
			//delete
		$this->KeyPhraseAssignment->query("delete from key_phrase_assignments where articles_id=$article_id");	

		$this->Session->setFlash("Key phrase has been deleted for article ID : $article_id");
		$this->redirect('/articles/listings');

		}
		else if( ($assigned == 'notAssigned') && ($phrase_id != 'blankCheckBox'))
		{
			//insert
			$this->KeyPhraseAssignment->query("insert into key_phrase_assignments(articles_id,phrases_id)".
											"  values($article_id,$phrase_id);"	);
		
		$this->Session->setFlash("Key phrase has been assigned for article ID : $article_id");
		$this->redirect('/articles/listings');

		}	
		else if(($assigned == 'notAssigned') && ($phrase_id == 'blankCheckBox'))
		{
			$this->Session->setFlash("No changes has been made");
			$this->redirect('/articles/listings');
		}
		else{}
		
		//$this->autoRender=false;
	}//end save
 	
}//end class
?>