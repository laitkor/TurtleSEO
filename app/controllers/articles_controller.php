<?php
class ArticlesController extends AppController {

	var $name = 'articles';
	var $helpers = array('Html','Ajax','Javascript');
	
	
	var $paginate = array(
        'fields' => array('Article.id', 'Article.title'),
        'limit' => 10,        
        'order' => array(
            'Article.id' => 'asc'
        )
    );
	
	function beforeFilter()
	{
		
		if( !($this->_isLoggedIn()) )
		{
			$this->Session->setFlash('You are not authorized to view this page');
			$this->redirect('/users/sign_in');
		}		
		
	}
	 
    function post_data()
	{}
	
	function facebook_post()
	{
		$this->set('ids',$this->Article->find('list' , array('fields' => 'Article.id')));
		$this->render('facebook_post');
	}

  /**
		This function adds article .
  */

  function add($id=null)
  {	
  	if ($id <> "" )
	{
  	if( $this->Article->find( 'count', array('conditions' => array('Article.id' => $id, 'Article.user_id' => $this->Session->read('user_id'))) ) <= 0 )
		{
			$this->Session->setFlash('Please enter valid ID');
			$this->redirect('/articles/add/');
		}
	}
		
    //fetching main categories
	$this->loadModel('Maincat');
	$this->set('data',$this->Maincat->find('list' , array('fields' => 'Maincat.name'),array('conditions' => array('Maincat.user_id' => $this->Session->read('user_id') ) ) ) );  //main categories
  	
    //fetching author names
     $this->loadModel('Author');
     $this->set('authorName',$this->Author->find('list' , array('fields' => 'Author.name')));  //available authors from table
  		
	if (!empty($this->data)) 
	{
		
		
	/*
		if((!isset($this->data['Article']['subcats_id']))  or  (!isset($this->data['Article']['subcattags_id'])))
		{
			$this->Session->setFlash('Please Select Sub Category And Sub Category Tags');
			$this->redirect(array('action' => 'add'));
		}
        */
		$this->data['Article']['user_id']=$this->Session->read('user_id');
		
       if($this->Article->save($this->data)) 
		{
			
	     $this->Session->setFlash('Article has been added.');

//added by manish
	$get_id=$this->Article->id;
	$this->redirect('/articles/edit/'.$get_id);
//end added by manish
			
		}
	}
}
 
 
  
  
  
  /*
  function add()
  {	
  
	$this->loadModel('Maincat');
	$this->set('data',$this->Maincat->find('list' , array('fields' => 'Maincat.name')));  //main categories
  	
	if (!empty($this->data)) 
	{
		if((!isset($this->data['Article']['subcats_id']))  or  (!isset($this->data['Article']['subcattags_id'])))
		{
			$this->Session->setFlash('Please Select Sub Category And Sub Category Tags');
			$this->redirect(array('action' => 'add'));
		}
        
        
        //if((!isset($this->data['Article']['subcats_id']))  AND  (!isset($this->data['Article']['subcattags_id'])))
		//{
			//$this->Session->setFlash('Please Select Sub Category And Sub Category Tags');
			//$this->redirect(array('action' => 'add'));
		//}
        
        
       // if((empty($this->data['Article']['subcats_id'])) AND (empty($this->data['Article']['subcattags_id'])))
	//	{
		//	$this->Session->setFlash('Please Select Sub Category And Sub Category Tags');
		//	$this->redirect(array('action' => 'add'));
		//}
	
		$this->loadModel('Author');
		$this->Author->set( $this->data );
		$this->Article->set( $this->data );
	
		if ($this->Author->validates() AND  $this->Article->validates()) 
		{
			$author=$this->Author->save($this->data);
			$this->data['Article']['authors_id'] = $this->Author->id;
			if ($this->Article->save($this->data)) 
			{
				$this->Session->setFlash('Article Has Been Added.');
				$this->redirect(array('action' => 'add'));
			}
		}
		
	}
 }//end add
*/
 
   
   /**
   		This function list all articles 
		in the follwing format:
		Article ID  Title
		1			title1
		2			title2
		....
   */
   function listings()
   {
   	 if(!empty($this->params['named']['page']))
	 {
	 	$page=$this->params['named']['page'];
		$page=($page*10)-10;
	 	$this->set('sno',$page);
	 }
	 else
	 $this->set('sno',0);
	 
   	  $this->paginate=array(
        		'fields' => array('Article.id', 'Article.title'),
        		'limit' => 10,        
        		'order' => array(
           		 'Article.id' => 'asc'
        			),
					'conditions'  => array('Article.user_id'  => $this->Session->read('user_id') )
	  			);
 	 
	 $data=$this->paginate('Article');
	 $this->set('data',$data);
   }
   
   function testAjax()
   {
   	  
   }
   
   function autoComplete() 
   {
		$this->loadModel('Author');
		$this->set('posts', $this->Author->find('all', array(
				'conditions' => array(
					'Author.name LIKE' => $this->data['Author']['name'].'%'
				),
				'fields' => array('name')
		)));
		$this->layout = 'ajax';
	}
   
   function index()
   {
   
	if(!empty($this->params['named']['page']))
	 {
	 	$page=$this->params['named']['page'];
		$page=($page*10)-10;
	 	$this->set('sno',$page);  
	 }
	 else
	 $this->set('sno',0);
	 
   	  $this->paginate=array(
        		'fields' => array('Article.id', 'Article.title'),
        		'limit' => 10,        
        		'order' => array(
           		 'Article.id' => 'desc'
        			),
					'conditions'  => array('Article.user_id'  => $this->Session->read('user_id') )
	  			);
 	 
	 $data=$this->paginate('Article');
	 $this->set('data',$data);
		
    }//end index
	
	

	//shows preview of article
	function preview($id = null) //id is article id
	{
		if($id==null)
		{
			if($id==null OR !(is_numeric($id)) )
			{
				$this->Session->setFlash('Please Enter Valid ID OR ENTER ID');
				$this->redirect('/articles/');
			}	
		}
		
		if($id != null )
		{
			$this->Article->id = $id;
			$articleData = $this->Article->read();
			
			$author_id=$articleData['Article']['authors_id'];
			
			//fetching author detail
			$this->loadModel('Author',$author_id);
			$authorData=$this->Author->read();
			
			
			//fetching related article detail
			$this->loadModel('RelatedArticle');
			$relatedArticle=$this->RelatedArticle->findByMainArticleId($id);
		    $relatedArticle=explode(',',$relatedArticle['RelatedArticle']['related_article_ids']);	
			foreach($relatedArticle as $ids)
			{
				$this->Article->id=$ids;
				$article = $this->Article->read();
				$rel_art[]=$article['Article']['title'];
			}
			
			//fetching recommmended article detail
			$this->loadModel('RecommendedArticle');
			$recommendedArticle=$this->RecommendedArticle->findByMainArticleId($id);
		    $recommendedArticle=explode(',',$recommendedArticle['RecommendedArticle']['recommended_article_ids']);	
			foreach($recommendedArticle as $ids)
			{
				$this->Article->id=$ids;
				$article = $this->Article->read();
				$rec_art[]=$article['Article']['title'];
			}
			//sending value to view
			$this->set('related_article',$rel_art);
			$this->set('recommended_article',$rec_art);
			$this->set('article',$articleData );
 			$this->set('author',$authorData );
 			$this->render('preview','window');
		}	
		
	}//END preview()

	
	/*function view($id) 
	{
		$this->Article->id = $id;
		$this->set('article', $this->Article->read());
	}*/


	//shows forms for editing and save values
	function edit($id = NULL,$posted_id=NULL) 
	{

		// Validation 
	 	if($id==null OR !(is_numeric($id)) )
		{
			$this->Session->setFlash('Please enter valid ID');
			$this->redirect('/articles/');
		}	
		
		//Checking article id exist or not
		if( $this->Article->find( 'count', array('conditions' => array('Article.id' => $id)) ) <= 0 )
		{
			$this->Session->setFlash('Please enter valid ID');
			$this->redirect('/articles/');
		}
		
		if( $this->Article->find( 'count', array('conditions' => array('Article.id' => $id, 'Article.user_id' => $this->Session->read('user_id'))) ) <= 0 )
		{
			$this->Session->setFlash('Please enter valid ID');
			$this->redirect('/articles/');
		}
		
    	$this->_loadRelatedArticles($id);
		$this->_loadRecommendedArticles($id);

		$this->Article->id = $id;
			
	
		if (empty($this->data)) 
		{
			$this->data=$this->Article->read();
			$this->set('article_id',$id);
			$this->loadModel('Maincat');
			$this->set('data_maincats',$this->Maincat->find('list' , array('fields' => 'Maincat.name'),array('conditions' => array('Maincat.user_id' => $this->Session->read('user_id')))));  //main categories
			$this->set('selected_cat',$this->data['Article']['maincats_id']);

			//getting author detail
			$this->loadModel('Author');
			$this->Author->id = $this->data['Article']['authors_id'];
			$author_detail=array($this->Author->field('name'),$this->Author->field('bio'));
			$this->set('author_detail',$author_detail);
		}
		else
		{
		 
		    $this->data['Article']['maincats_id']=$_POST['maincatsid'];
	
	   if(empty($this->data['Article']['content'])) 
		{
		    $this->data=$this->Article->read();
			$this->set('article_id',$id);
			$this->loadModel('Maincat');
			$this->set('data_maincats',$this->Maincat->find('list' , array('fields' => 'Maincat.name'),array('conditions' => array('Maincat.user_id' => $this->Session->read('user_id')))));  //main categories
			$this->set('selected_cat',$this->data['Article']['maincats_id']);
			
			$content_error="Please enter Description"; 
			$this->set('content_error',$content_error);		 
		} else if ($this->Article->save($this->data))
			{	
					
			    $this->_updatePost($id);
				$this->Session->setFlash('Article has been updated.');
				$this->redirect('/articles/edit/'.$id);
			}
			else
			{
				
				$this->set('article_id',$id);
			}
		}
		
		//$this->set('main_cat',$maincat);
		$this->d=$this->Article->read();
		
		//getting main cat name
		$this->loadModel('Maincat');
		$this->Maincat->id=$this->d['Article']['maincats_id'];
		$maincat=$this->Maincat->read();
		//getting main cat name
		$this->set('main_cat',$maincat['Maincat']['name']);	
		$this->set('main_cat_id',$maincat['Maincat']['id']);
	}//END editing and saving


	/**
		This function show author bio used with ajax call.
		This functions considers author name is unique as
		it is specified in database as unique.
	**/

	function authorBio()
	{

		$author_name=$this->data['Author']['name'];       //get from serialize
		
		//getting author detail
		$this->loadModel('Author');
		$name=$this->Author->findByName($author_name);
		$bio=$name['Author']['bio'];
		$this->set('bio',$bio);
		$this->layout='ajax';
	}
	
	function article_desc()
	{	
		//var_dump($this->data);

		$id=$this->data['id'];       //get from serialize

		$desc=$this->Article->findById($id);
		$con=$desc['Article']['title'];
		$this->set('con',$con);
		$this->layout='ajax';
	}
	
	/**
			This function load related articles
	*/
	function _loadRelatedArticles($id=null)  //$id ia current article id
	{
	
	
		$this->loadModel('RelatedArticle');
		$relatedArticle=$this->RelatedArticle->findByMainArticleId($id);
		$rel_ids=$relatedArticle['RelatedArticle']['related_article_ids'];
		$this->set('relatedArticle',explode(",", $rel_ids));		
		
	}
		
		
	/**
			This function load recommended articles
	*/
	function _loadRecommendedArticles($id=null)  //$id ia current article id
	{
		$this->loadModel('RecommendedArticle');
		$recommendedArticle=$this->RecommendedArticle->findByMainArticleId($id);
		$rel_ids=$recommendedArticle['RecommendedArticle']['recommended_article_ids'];
		$this->set('recommendedArticle',explode(",", $rel_ids));		
		
	}
			
	

	/**
		This functions performs loading of various
		 categories(main,sub,subcats) in their respective combos	
	*/	
	function _loadCategories($article_id)
	{
		//maincats values
		//select sc.id from subcats sc inner join articles a  on (sc.id = a.subcats_id) where a.id=3;
		$query="select id from maincats where id=(select maincats_id from subcats".
				" where id =(select articles.subcats_id  from articles where  id=$article_id));";
		$main_cat_id=$this->Article->query($query,false);
		$this->loadModel('Maincat');
		$this->set('data',$this->Maincat->find('list' , array('fields' => 'Maincat.name')));  //main categories
	   	$this->set('curr_main_id', $main_cat_id[0]['maincats']['id']);
		
		//subcats values
		$this->loadModel('Subcat');
		$this->set('sub_cat',$this->Subcat->find('list' , 
					array('fields' => 'Subcat.name',
					'conditions' => array('Subcat.maincats_id' => $main_cat_id[0]['maincats']['id']))));  
		
		$this->Article->id=$article_id;
		$this->set('curr_sub_id', $this->Article->field('subcats_id'));
		
		//subcattags values
		$this->loadModel('Subcattag');
		$this->set('sub_cattag',$this->Subcattag->find('list' , 
					array('fields' => 'Subcattag.name',
					'conditions' => array('Subcattag.subcats_id' => $this->Article->field('subcats_id')))));  
		$this->set('curr_subcat_id', $this->Article->field('subcattags_id'));
		
	}//END LOAD CATEGORY	
	
	/**
			This function updates article in all wp servers
			which has post		
	*/
	function _updatePost($article_id)
	{
		//getting main category of article
		$query="select name from maincats where id=(select maincats_id from  articles".
			" where id =$article_id);";
		$main_cat_id=$this->Article->query($query,false);
	
	
			
	
		$article=$this->Article->findById($article_id);
		$content['title'] = $article['Article']['title'];
		$content['categories'] = array($main_cat_id[0]['maincats']['name']);  
		$content['description'] = $article['Article']['content']; 
		
		//added
		$article['Article']['meta_keywords']=trim($article['Article']['meta_keywords']);
		if($article['Article']['meta_keywords']=="")
		$content['mt_keywords']="  ";
		else
		$content['mt_keywords'] = $article['Article']['meta_keywords'];
		//added
	
		$this->loadModel('PostedArticle');
		$this->loadModel('WpServer');
		App::import('Vendor', 'remotepost');
		
		
		
		
		$row=$this->PostedArticle->query("select * from posted_articles where article_id=$article_id");
		/*$row=$this->PostedArticle->query("select * from posted_articles  inner join articles  on posted_articles.article_id=articles.id where articles.user_id=".$this->Session->read('user_id'." and posted_articles"));*/

        if(!empty($row))
		{
			//**************Spinning Articles***************//
			
			/*$permutations=$this->_spin2($content['description'], false, true);
			for($i=1;$i<=$permutations;$i++)
			$sp[]= $this->_spin2($content['description'], false);
			*/
            
       /* 	$permutations=$this->_spin2($content['description'], false, true);
			if($permutations>=20)
            $different=20;
            else
            $different=$permutations;
            
            for($i=1;$i<=$different;$i++)
			$sp[]= $this->_spin2($content['description'], false);
	*/		
            
			
			for($i=1;$i<=NO_OF_SPIN;$i++)
			$sp[]= $this->_nested_spin($content['description'], false); 

			
            
			//*********************************************//
			foreach($row as $key => $value)
			{
				$ser_id=$row[$key]['posted_articles']['wp_server_id'];
				$posted=$row[$key]['posted_articles']['posted_id'];
			    
				$wp_servers=$this->WpServer->findById($ser_id);
				$username= $wp_servers['WpServer']['wp_admin_id'];
				$password= $wp_servers['WpServer']['wp_admin_password'];	
				
				$this->client = new IXR_Client($wp_servers['WpServer']['rpc_url']);  //making client
				
				$spin_key=array_rand($sp,1);
				$content['description']=$sp[$spin_key];
                
                if(!$this->client->query('metaWeblog.editPost',"$posted",$username,$password,$content,true))
				{
					//if error ->   header(header already sent by mess) error is showing 
					//$mess.=$wp_servers['WpServer']['rpc_url'].":".$this->client->getErrorCode().":".
						//	$this->client->getErrorMessage()."<br>";
						
					$this->Session->setFlash($wp_servers['WpServer']['rpc_url'].":"
											.$this->client->getErrorCode().":".$this->client->getErrorMessage());
					$this->redirect('/articles/');	
				}
			}
		}	
		
	} //end updating posted article
	
	function updateSubcategory()
	{
		
		// print_r($this->data);
		//$this->params['form']['select']  ///is the current selected maincat id from combo
		$this->loadModel('Subcat');
		$this->set('sub_cat',$this->Subcat->find('list' , 
					array('fields' => 'Subcat.name',
					'conditions' => array('Subcat.maincats_id' => $this->params['form']['select']))));  
		$this->layout='ajax';
	}
	
	function updateSubcattags()
	{
		//echo "calling";
		//print_r($this->data['Article']['subcats_id']);  //is the current seleceted subcat id from combo
		
		$this->loadModel('Subcattag');
		$this->set('sub_cattag',$this->Subcattag->find('list' , 
					array('fields' => 'Subcattag.name',
					'conditions' => array('Subcattag.subcats_id' => $this->data['Article']['subcats_id']))));  
		$this->layout='ajax';			
	}
	
	
	/**
			view of Related Article			
	*/

	function relatedArticle($article_id)
	{
		$art_ids=$this->Article->query("select id from articles where id != $article_id");
		$rel_ids=$this->Article->query("select related_article_ids from related_articles where main_article_id = $article_id");
		
		//fetching related articles id
		if(count($rel_ids)>0)
		{
		$rel_ids=$rel_ids[0]['related_articles']['related_article_ids'];
		$rel_ids=explode(",",$rel_ids);
		}
		else
		$rel_ids=array();
		//fetching articles id
		foreach($art_ids as $key => $value)
		{
			foreach($value as $id)
			{
				foreach($id as $v)
				$articles[]=$v;
			}
		} 
		
		$this->set("articlesID",$articles);
		$this->set("relID",$rel_ids);
		$this->set("id",$article_id);
	
		$this->render('related_article');
	}
	
	/**
		 Edition of related Article	
	*/
	function editRelatedArticle($article_id)
	{
		extract($_POST);
		
		//added because throwing warning when none checkbox is selected
		if(empty($rel_article))
		$rel_ids='';
		else
		$rel_ids=implode(",",$rel_article);
      /*////////////////************************//////////////////////////*/
	  
		$this->loadModel('RelatedArticle');
  		$available = $this->RelatedArticle->find('count', 
							array('conditions' => array('RelatedArticle.main_article_id' => $article_id)));
  		
  		if($available>0)
		$this->Article->query("update related_articles set related_article_ids='$rel_ids' where main_article_id=$article_id");
		else
		$this->Article->query("insert into related_articles values('',$article_id,1,'$rel_ids')");
		$this->set('article_id',$article_id);
		//$this->redirect('/articles/edit/'.$article_id);
		
   }//end editRelatedArticle
	
	
	/**
			View of Recommended Article			
	*/

	function recommendedArticle($article_id)
	{
		$art_ids=$this->Article->query("select id from articles where id != $article_id");
		$rel_ids=$this->Article->query("select  recommended_article_ids ".
									"  from recommended_articles where main_article_id = $article_id");
		
		//fetching related articles id
		if(count($rel_ids)>0)
		{
		$rel_ids=$rel_ids[0]['recommended_articles']['recommended_article_ids'];
		$rel_ids=explode(",",$rel_ids);
		}
		else
		$rel_ids=array();
		
		
		//fetching articles id
		foreach($art_ids as $key => $value)
		{
			foreach($value as $id)
			{
				foreach($id as $v)
				$articles[]=$v;
			}
		} 
		
		$this->set("articlesID",$articles);
		$this->set("relID",$rel_ids);
		$this->set("id",$article_id);
	
		$this->render('recommended_article');
	}
	
	/**
		 Edition of Recommended Article
	*/
	function editRecommendedArticle($article_id)
	{
		extract($_POST);
		
		//added because throwing warning when none checkbox is selected
		if(empty($rel_article))
		$rel_ids='';
		else
		$rel_ids=implode(",",$rel_article);
      /*////////////////************************//////////////////////////*/
	
		$this->loadModel('RecommendedArticle');
  		$available = $this->RecommendedArticle->find('count', 
							array('conditions' => array('RecommendedArticle.main_article_id' => $article_id)));
  		
		if($available>0)
		$this->Article->query("update recommended_articles set ".
		          " recommended_article_ids ='$rel_ids' where main_article_id=$article_id");
		else
		$this->Article->query("insert into recommended_articles values('',$article_id,1,'$rel_ids')");
		$this->set('article_id',$article_id);
		//$this->redirect('/articles/edit/'.$article_id);
		
   }	
	
/**
		This function handles navigation controls viz. PREVIOUS NEXT
		sends navigation array to ctp according to operation pre,next,or both
*/	
function _previousNext($article_id)
{
	//pr($this->Session->read($user_id));
	//exit;
    $conditions=array(
				'fields' => array('Article.id'),
				'order' => array('Article.id' => 'asc'),
				'conditions' =>array('Article.user_id' => $this->Session->read('user_id'))
				
				);
	$ids=$this->Article->find("all",$conditions);
	
	//print_r($ids[1]['Article']['id']);
	
	$row=count($ids);
	if($row==1)        //if there is only one record
	{
		$this->set('navigation',array('op' => 'no'));
		return	;	
	}

	foreach($ids as $key => $value)
	{
		//first record
		if($ids[$key]['Article']['id']==$article_id AND $key==0)
		{
			//next;$key++ 's value
			$nex=$key+1;
			$next_id=$ids[$nex]['Article']['id'];
			$navigation=array('op' => 'next','id' => $next_id);
			$this->set('navigation',$navigation);
			break;
		}
		
		//last record
		else if($ids[$key]['Article']['id']==$article_id AND $key==(count($ids)-1) )
		{
			//pre; //$key
			$pre=$key-1;
			$pre_id=$ids[$pre]['Article']['id'];
			$navigation=array('op' => 'previous','id' => $pre_id);
			$this->set('navigation',$navigation);
			break;
		}
		//in between the records
		else if($ids[$key]['Article']['id']==$article_id)
		{
			//echo $key;
			//pre next;
			//key--,key++
			$pre=$key-1;
			$nex=$key+1;
			$pre_id=$ids[$pre]['Article']['id'];
			$next_id=$ids[$nex]['Article']['id'];
			$navigation=array('op' => 'both','previous' => $pre_id,'next' => $next_id);
			$this->set('navigation',$navigation);
			break;
		}
		else{}
		
		
	} //end for
	
}//end function

function delete($id)
	{
		if ($id <> "" )
		{
  			if( $this->Article->find( 'count', array('conditions' => array('Article.id' => $id, 'Article.user_id' => $this->Session->read('user_id'))) ) <= 0 )
			{
				$this->Session->setFlash('Please enter valid ID');
				$this->redirect('/articles/add/');
			}
		}
		$id=trim($id);
		$user_id=$this->Session->read('user_id');
		$this->loadModel('UserPlan');
		$plan_data=$this->UserPlan->findByUserId($user_id);
		$this->UserPlan->id = $plan_data['UserPlan']['id'];
		if ($plan_data['UserPlan']['post_to_del'] > 0 )
		{
			$d['UserPlan']['post_to_del']=$plan_data['UserPlan']['post_to_del'] - 1;
			$d['UserPlan']['post_limit'] = $plan_data['UserPlan']['post_limit'] + 1;
			$this->UserPlan->save($d);
		}	
		$this->Article->delete($id,true);
		$this->Article->query("delete from posted_articles where article_id=$id");			
		$this->Session->setFlash('Article has been deleted.');
		$this->redirect('/dashboards/');
	}


}//end class

?>
