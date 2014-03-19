<?php
class RemotePostsController extends AppController 
{

	var $name = 'remoteposts';
	var $uses="UserPlan";
	private $client;
		
		
		
	//var $components = array('RequestHandler');

  /**
		This function sends content,title(of passed article id) to form 
  */

	function beforeFilter()
	{
		
		if( !($this->_isLoggedIn()) )
		{
			$this->Session->setFlash('You Are Not Authorized To View This Page');
			$this->redirect('/users/sign_in');
		}		
		
	}
 
 
 function remoteForm($article_id=null)
 {
 	
 #echo "<pre>"; print_r(time());
	if(empty($article_id) OR !(is_numeric($article_id)))
	{
		$this->Session->setFlash('Please enter valid article id');
		$this->redirect(array('controller' => 'articles','action' => 'listings'));
	}
	
	//Checking article id exist or not
	$this->loadModel('Article');	
	if($this->Article->find( 'count', array('conditions' => array('Article.id' => $article_id)) ) <= 0 )
	{
		$this->Session->setFlash('Article ID Not Exists');
		$this->redirect('/articles/');
	}
	$this->loadModel('WpServer');
	$servers=$this->WpServer->find('all',array('fields' => array('WpServer.id','WpServer.name'),'conditions' => array('WpServer.user_id' => $this->Session->read('user_id'),'WpServer.active'=>1,'WpServer.blogspot'=>0 ))); ######  'WpServer.blogspot'=>0 is addaed By Anoop 11 Aug 2010
	
	$this->loadModel('PostedArticle');
	//$postedServerIds=$this->PostedArticle->find('all',array('fields' => array('Distinct PostedArticle.posted_id')));
    
	foreach($servers as $key => $value)
	{
		$ser=$servers[$key]['WpServer']['id'];	
		$post_servers=$this->PostedArticle->query("select wp_server_id from posted_articles where ".
											"  article_id=$article_id and wp_server_id=$ser");
		
		if(!empty($post_servers[0]['posted_articles']['wp_server_id']))	
		$posted[]=$post_servers[0]['posted_articles']['wp_server_id'];
		
	}
	if(empty($posted))
	$posted=array();
		
	//getting main category of article	
	$query="select name from maincats where id=(select maincats_id from  articles".
			" where id =$article_id);";
	$main_cat_id=$this->Article->query($query,false);

   	$this->set('category', $main_cat_id[0]['maincats']['name']);
	$this->set('servers',$servers);
	$this->set('posted',$posted);//already posted server id in a table posted_article
	$this->set('article_id',$article_id);
	
	$this->render('remote_form','modalbox');
 }//end function
 


  /**
		This function synchronizes with wp servers and client
		Based on the values get from checkboxes.
		add and deletes posts on the server as well as local table
		Table used : wp_servers and posted_articlea
  */
  function sendPost()
  {

  	extract($_POST);
  	$this->loadModel('Article');
	$this->loadModel('WpServer');
	$article=$this->Article->findById($article_id);  //get by post
	
	$title=$article['Article']['title']; // Post - Title 
	$description=$article['Article']['content']; //Post - Description    
	$meta_desc=$article['Article']['meta_desc']; //Post - Metadata
	
	$content['title'] = $title;

    //$content['categories'] = $category;  //get by post
    //$c=array($category);
     
       $content['categories'] = array($category);  //get by post
       $content['description'] = $description; 
	
		//added
		$article['Article']['meta_keywords']=trim($article['Article']['meta_keywords']);
		if($article['Article']['meta_keywords']=="")
		$content['mt_keywords']="";
		else
		$content['mt_keywords'] = $article['Article']['meta_keywords'];
		//added
	
	
	$this->loadModel('PostedArticle');
	
	
	App::import('Vendor', 'remotepost');
	//App::import('Vendor', 'phpingfm');
		
	
	// ================ start article post limit : manish ================
		$user_id=$this->Session->read('user_id');
		$plan=$this->UserPlan->query("select plans.name,plans.post_limit,user_plans.post_limit,user_plans.id from plans inner join user_plans on plans.id=user_plans.plan_id where".
								" user_plans.user_id=$user_id");
		 
		 $plan_blog_limit=$plan[0]['plans']['post_limit'];
		 $user_blog_limit=$plan[0]['user_plans']['post_limit'];
		if($plan_blog_limit!='umlimited')
		{
			$this->set('user_blog',$user_blog_limit);
			$this->set('total',$plan_blog_limit);
		
			if($user_blog_limit <=0)
			{
	  		$this->Session->setFlash("Please upgrade your plan.User article post limit has exceeded.");
			$this->redirect(array('action' => 'remoteForm',$article_id."/".time()));

			} 			
		}
 
	//================ end article post limit  : manish================
	
	//there are two cases when servers checkbox is empty
	//1 : when user has done nothing
	//2 : or user wants to delete all the posts from all the servers
	if(empty($servers))
	{
		
		//commented on feb 8 feb 2010
		//$row=$this->PostedArticle->query("select * from posted_articles");
		
		$row=$this->PostedArticle->query("select * from posted_articles where article_id=$article_id");
		
		if(empty($row))
		{
			//user has done nothing
			$this->Session->setFlash("No changes had made");
			$this->redirect(array('action' => 'remoteForm',$article_id."/".time()));		
		}
		else
		{
			//delete locale table posted_articles and delete all posts from all servers
			foreach($row as $key => $value)
			{
				$ser_id=$row[$key]['posted_articles']['wp_server_id'];
				$posted=$row[$key]['posted_articles']['posted_id'];
			    
				$wp_servers=$this->WpServer->findById($ser_id);
				$username= $wp_servers['WpServer']['wp_admin_id'];
				$password= $wp_servers['WpServer']['wp_admin_password'];	
				
				$this->client = new IXR_Client($wp_servers['WpServer']['rpc_url']);  //making client
				if($this->client->query('metaWeblog.deletePost','',"$posted",$username,$password,true))
				{
                    error_reporting(0);
					$this->PostedArticle->query("delete from posted_articles where article_id=$article_id and ".
										"  wp_server_id=$ser_id");
										
					$message.="SERVER :" .$wp_servers['WpServer']['rpc_url']." :Post Deleted.<br>";
					
				}
				else
				{
					/*
					$this->Session->setFlash($this->client->getErrorCode().":".$this->client->getErrorMessage());
					$this->redirect(array('action' => 'remoteForm',$article_id));	
					*/
					error_reporting(0);
					$message.="SERVER :" .$wp_servers['WpServer']['rpc_url'].":".
								$this->client->getErrorCode().":".$this->client->getErrorMessage()."<br>";
							
				}				
			}
			/*$this->Session->setFlash("Article Deleted from All Servers");
			$this->redirect(array('action' => 'remoteForm',$article_id));	*/
			
			$this->Session->setFlash($message);
			$this->redirect(array('action' => 'remoteForm',$article_id."/".time()));	
			
		}
	}
	
	
	//$posted_servers=$this->PostedArticle->query("select distinct wp_server_id  from posted_articles");  
	
	$posted_servers=$this->PostedArticle->query("select wp_server_id from posted_articles where ".
											"  article_id=$article_id ");
	
	
	//previously article is posted on server but now it is  unchecked.
	//means we have to delete it
	//$servers get by checkbox
	//deletes post from server and local table
	if(!empty($posted_servers))
	{
	
		foreach($posted_servers as $key => $value)
		{
			$server_id=$posted_servers[$key]['posted_articles']['wp_server_id'];
	
			$server=$this->WpServer->findById($server_id);	
			$username= $server['WpServer']['wp_admin_id'];
			$password= $server['WpServer']['wp_admin_password'];
		
			$this->client = new IXR_Client($server['WpServer']['rpc_url']);  //making client
			
			if((array_search($server_id,$servers)===FALSE))
			{
				//delete in local table and delete from server single row
			//means check box is tick off
				$post_id=$this->PostedArticle->query("select posted_id from posted_articles where article_id=$article_id and ".
										"  wp_server_id=$server_id");
				$post_id=$post_id[0]['posted_articles']['posted_id'];
			
				if($this->client->query('metaWeblog.deletePost','',"$post_id",$username,$password,true))
				{
					$this->PostedArticle->query("delete from posted_articles where article_id=$article_id and ".
										"  wp_server_id=$server_id");
										
					
				}
				else
				{
					$this->Session->setFlash($this->client->getErrorCode().":".$this->client->getErrorMessage());
					$this->redirect(array('action' => 'remoteForm',$article_id."/".time()));
						
				}				
			}
			
		}//end for	
	 }
	 
  
	
	
	//code for insert into local table and various servers selected by checkbox
	//$servers get by checkbox
		
	//$spin_count=0;

	/**************COMMENTED FOR SPIN**************************************************************************************/

	/* $permutations=$this->_spin2($content['description'], false, true);
    if($permutations>=20)
    $different=20;
    else
    $different=$permutations;
    
    for($i=1;$i<=$different;$i++)
	$sp[]= $this->_spin2($content['description'], false); */

	/**************COMMENTED FOR SPIN***************************************************************************************/
	
	
    for($i=1;$i<=NO_OF_SPIN;$i++)
	$sp[]= $this->_nested_spin($content['description'], false); 

	$ifposted=false;   //used in sending post to sns sites.cheecked posting is done or not 
    //$server_links[]=array();  //used for randomizing servers for posting to sns sites
	
	foreach($servers as $value)
	{
	    
		$server=$this->WpServer->findById($value);
		$username= $server['WpServer']['wp_admin_id'];
        $password= $server['WpServer']['wp_admin_password'];
			
		/*$row=$this->PostedArticle->query("select article_id from posted_articles where ".
						"  article_id=$article_id and wp_server_id=$value");*/
		
		$row=$this->PostedArticle->query("select article_id,posted_id from posted_articles where ".
						"  article_id=$article_id and wp_server_id=$value");
						
	
		
		
		if(empty($row))
		{
			$this->_updateLimit($article_id);
			//echo 	$content['description']."<br>";
		
		
			$this->client = new IXR_Client($server['WpServer']['rpc_url']);  //making client
			//echo $permutations;
			
			
			//print_r($sp);
			$spin_key=array_rand($sp,1);
			$content['description']=$sp[$spin_key];
			//$spinned_article[]= $this->_spin2($content['description'], false);
			//$spinned_article[]= $this->_spin2($content['description'], false);
			//$content['description']=$spinned;
			
			//echo $server['WpServer']['name'];
			//exit;
			
			if($this->client->query('metaWeblog.newPost','',$username,$password,$content,true))
			{
				
				$postedId=$this->client->getResponse();
				$this->PostedArticle->query("insert into posted_articles values($article_id,$postedId,$value,now())");
				
				//added for sending content to social networking sites
				$server_links[]=$server['WpServer']['name'];
				/*if(!$ifposted)
				{
					$this->_post_to_social_networks($sp[$spin_key],$server['WpServer']['name']);
					$ifposted=true;
				}*/
				//added for content to social network sites

	
			}
			else
			{
				$this->Session->setFlash($this->client->getErrorCode().":".$this->client->getErrorMessage());
				$this->redirect(array('action' => 'remoteForm',$article_id."/".time()));	
				
			}
		
			//added for sending post to sns
			if(!$ifposted)
			{
				$this->_post_to_social_networks($meta_desc,$server_links);
				unset($server_links);			
				$ifposted=true;
			}
			//end addtion	
			
		}
		else
		{
			$this->_synchronizations($server['WpServer']['rpc_url'],$username,$password,$row,$content,$article_id,$value,$sp);
		}
		
		
	}//end for
	//added by manish for post 
				$user_id=$this->Session->read('user_id');
				$user_plan=$this->UserPlan->findByUserId($user_id);
				$user_post_limit=$user_plan['UserPlan']['post_limit'];
				$this->UserPlan->id=$user_plan['UserPlan']['id'];
				$data['UserPlan']['post_limit']=$user_post_limit-1;
				$data['UserPlan']['id']=$user_plan['UserPlan']['id'];
				$this->UserPlan->save($data);
	//end added by manish for 
	
	$this->Session->setFlash("Operation performed successfully");
	$this->Session->write('msg2',"Operation performed successfully");
	$this->redirect(array('action' => 'remoteForm',$article_id."/".time()));	
	$this->autoRender=false;
 } //end send post 
  
  
  

  /**
		This function synchronizes post on wp_servers to our server.
		Process : If post exist in our table  but,not find in wp_server then it 
				   send post to wp_server, and updates post id in local table
  **/
  
	function _synchronizations($rpc,$username,$password,$row,$content,$article_id,$serverId,$sp)
	{
		$this->client = new IXR_Client($rpc);  //making client
		$post_id=$row[0]['posted_articles']['posted_id'];
		$spin_key=array_rand($sp,1);
		$content['description']=$sp[$spin_key];
		
		//!$this->client->query('metaWeblog.getPost',$post_id,$username,$password);
		$this->client->query('metaWeblog.getPost',$post_id,$username,$password);
		if($this->client->getErrorCode()==404)   //for detecting post exist or not ,if not exist send post and update local table
		{
			$this->client->query('metaWeblog.newPost','',$username,$password,$content,true);
			$postedId=$this->client->getResponse();
			$this->PostedArticle->query("update posted_articles set posted_id=$postedId where article_id=$article_id and wp_server_id=$serverId");
		
		}
		else
		{}
	}//end _synchronizations
	
	
	/**
			This function sends content to social networking sites.
			Used library for interacting to ping.fm
	**/
	function _post_to_social_networks($social_content,$send_url)//string,array
	{
		
		
		$key=array_rand($send_url,1);
		$url=trim($send_url[$key]);
		$social_content=trim($social_content);
		$social_content=substr($social_content,0,SPLIT_CONTENT);
		$social_content=$social_content.' '.$url;
		
		/*
		App::import('Vendor', 'phpingfm');
		//$PHPingFM = new PHPingFM(PING_API_KEY,PING_APPLICATION_KEY);
		$this->loadModel('ApiSetting');
		$api_setting=$this->ApiSetting->find( 'all', array( 'conditions' => array('ApiSetting.user_id' => $this->Session->read('user_id'),'ApiSetting.name' => 'Ping','ApiSetting.active' =>1 )) );
			;
		if(empty($api_setting))
		{
			return;
		}
		//pr($api_setting);
		//exit;
		$PHPingFM = new PHPingFM($api_setting[0]['ApiSetting']['api_key'],$api_setting[0]['ApiSetting']['api_password']);
		
		
		
		
		$result = $PHPingFM->post("microblog",$social_content);
		//pr($result);
		//exit;
		return $result;
		*/
	
	//  start added by Navneet

	$msg = $social_content;
	$this->loadModel('Article');
	$res = $this->Article->find('all', array('conditions' => array('Article.id' => $article_id)));
	$userid = $this->Session->read('user_id');
	$this->loadModel('Addednetwork');
	$nets = $this->Addednetwork->find('all', array('conditions' => array('Addednetwork.user_id' => $userid)));
	if (count($nets) != 0)
		{
			foreach($nets as $net)
			{
				switch($net['Addednetwork']['network_id'])
				{
					case 0 :
					 	break;	
					case 1 :
						$this->tweet($msg); break;	
					case 2 :
						$this->facebookStatusUpdate($msg); break;
					case 3 :
						$this->setlinkedinstatus($msg); break;
					case 4 :
						$this->setfriendsterstatus($msg); break;
					case 5 :
						$this->hi5statusupdate($msg);break;
					case 6 :
						$this->settumblerstatus($msg);break;
					case 7 :
						$this->setidenticastatus($msg);break;
					case 7 :
						$this->setshoutemstatus($msg);break;
					case 8 :
						$this->setshoutemstatus($msg);break;
				}
			}		
		}	
		
	return true;

	//end added by navneet

		
	}
  
  	
	/*
		This function updates limit of post of a user
		Table Used : plans ,user_plans
		
		Process: First check if limit is expire ,if expire then redirect showing message you exceed ur limit upgrade plan
		if not update user_plans table(post_limit)
	*/
	function _updateLimit($article_id)
	{
		/*$this->loadModel('UserPlan');
		$user_id=$this->Session->read('user_id');
		$plan=$this->UserPlan->query("select plans.name,plans.post_limit,user_plans.post_limit,user_plans.id from plans inner join user_plans on plans.id=user_plans.plan_id where ".
								" user_plans.user_id=$user_id");
		
		$plan_post_limit=$plan[0]['plans']['post_limit'];
		$user_post_limit=$plan[0]['user_plans']['post_limit'];
		if($plan_post_limit!='umlimited')
		{
			if($user_post_limit >=$plan_post_limit)
			{
				$message="Please Upgrade Your Plan.User Post Limit Is Exceeded";
				$this->Session->setFlash($message);
				$this->redirect(array('action' => 'remoteForm',$article_id));	
			}
			else
			{
				//$user_plan=$this->UserPlan->findByUserId($user_id);
				$this->UserPlan->id=$plan[0]['user_plans']['id'];
				$data['UserPlan']['post_limit']=$user_post_limit+1;
				$this->UserPlan->save($data);	
			}
		}*/
			
	}
   
 /**
		This function sends post to remote wp server .VERY VERY OLD
 */
  /*function sendPost()
  {
  
	extract($_POST);
	if(empty($username) OR empty($password))  //get by post username and password
	{
		$this->Session->setFlash('You Either Left Username or Password');
		$this->redirect(array('action' => 'remoteForm',$article_id));      
	}
	$this->loadModel('Article');
	$article=$this->Article->findById($article_id);  //get by post
	$title=$article['Article']['title'];
	$description=$article['Article']['content'];
    $this->uname=$username;
	$this->pass=$password;	
	$content['title'] = $title;
	$content['categories'] = $category;  //get by post
	$content['description'] = $description;
	
	App::import('Vendor', 'remotepost');
	$this->client = new IXR_Client($this->wpURL);  //making client
	//$imgURL = $this->uploadImage();
	$imgURL=null;
	if($this->client->query('mt.getRecentPostTitles','',$this->uname,$this->pass)) 
	{
		$titles=$this->client->getResponse();
		foreach($titles as $key => $value)
		{
			if($titles[$key]['title']==$title)
			{
				$this->Session->setFlash('Title Already Exists');
				$this->redirect(array('action' => 'remoteForm',$article_id));  //if titles exists redirect 
			}
		}
		if($this->client->query('metaWeblog.newPost','',$this->uname,$this->pass,$content,true))
		{
			$this->Session->setFlash("Article Posted Successfully");
			$postedId=$this->client->getResponse();
			$this->redirect(array('controller' => 'articles','action' => 'edit',$article_id,$postedId));	
		}
		else
		{
			$this->Session->setFlash($this->client->getErrorCode().":".$this->client->getErrorMessage());
			$this->redirect(array('action' => 'remoteForm',$article_id));	
		}
	}	
	else
	{
		$this->Session->setFlash($this->client->getErrorMessage());  //bad loging username/password message
		$this->redirect(array('action' => 'remoteForm',$article_id));
	}
  } //end send post 
*/
  /*
  function sendPost()VERY OLd
  {
  
	extract($_POST);
	if(empty($username) OR empty($password))  //get by post username and password
	{
		$this->Session->setFlash('You Either Left Username or Password');
		$this->redirect(array('action' => 'remoteForm',$article_id));      
	}
	$this->loadModel('Article');
	$article=$this->Article->findById($article_id);  //get by post
	$title=$article['Article']['title'];
	$description=$article['Article']['content'];
    $this->uname=$username;
	$this->pass=$password;	
	$content['title'] = $title;
	$content['categories'] = $category;  //get by post
	$content['description'] = $description; //get by post
	$server_id=$server; //get by post
	
	
	$this->loadModel('PostedArticle');
	$posted=$this->PostedArticle->query("select * from posted_articles where ".
	                                    " article_id=$article_id and wp_server_id=$server_id"); //gives one row										
	//print_r($posted);										
	
	
	$this->loadModel('WpServer');
	$wp_server=$this->WpServer->findById($server_id);
	$this->wpURL=$wp_server['WpServer']['name'];
	$this->wpURL=$this->wpURL."/xmlrpc.php";
	
	App::import('Vendor', 'remotepost');
	$this->client = new IXR_Client($this->wpURL);  //making client
		
	
	if(empty($posted))
	{
		if($this->client->query('metaWeblog.newPost','',$this->uname,$this->pass,$content,true))
		{
			$this->Session->setFlash("Article Posted Successfully");
			$postedId=$this->client->getResponse();
			$this->PostedArticle->query("insert into posted_articles values($article_id,$postedId,$server_id)");
			$this->Session->write('Server.name',$wp_server['WpServer']['name']);
			$this->redirect(array('controller' => 'articles','action' => 'edit',$article_id,$postedId));	
		}
		else
		{
			$this->Session->setFlash($this->client->getErrorCode().":".$this->client->getErrorMessage());
			$this->redirect(array('action' => 'remoteForm',$article_id));	
		}
	}	
	else
	{
		$post_id=$posted[0]['posted_articles']['posted_id'];
		$ser_id=$posted[0]['posted_articles']['wp_server_id'];
			
		//if post was deleted by admin in this case - first check post in wp server exist or not if post
		//exist then update else delete from client  table postted_article the row posted_id
		
		// this is not implemented : and then inserts data in posted_article and sends post to wp server
		
		if($this->client->query('metaWeblog.getPost',"$post_id",$this->uname,$this->pass))// exists
		{
			if($this->client->query('metaWeblog.editPost',"$post_id",$this->uname,$this->pass,$content,true))
			{
				$this->Session->setFlash("Article Updated In Server Successfully");
				$this->Session->write('Server.name',$wp_server['WpServer']['name']);
				$this->redirect(array('controller' => 'articles','action' => 'edit',$article_id,$post_id));	
			}
			else
			{
				$this->Session->setFlash($this->client->getErrorCode().":".$this->client->getErrorMessage());
				$this->redirect(array('action' => 'remoteForm',$article_id));	
			}
		}	
		else
		{
			if($this->client->getErrorCode()==403)  //username and password not matched in server
			{
					$this->Session->setFlash($this->client->getErrorCode().":".$this->client->getErrorMessage());
					$this->redirect(array('action' => 'remoteForm',$article_id));
			}
			
			if($this->client->getErrorCode()==403)  //post id not exists in server
			{
					$this->Session->setFlash($this->client->getErrorCode().":".$this->client->getErrorMessage());
					$this->redirect(array('action' => 'remoteForm',$article_id));
			}
			
			$this->Session->setFlash($this->client->getErrorCode().":".$this->client->getErrorMessage());
			$this->redirect(array('action' => 'remoteForm',$article_id));
			//$this->PostedArticle->query("delete from posted_articles where article_id=$article_id and wp_server_id=$ser_id");
			//$this->Session->setFlash("Post Is no longer exists in WP Server.To send Post Click on Edit/post Button");
			//$this->redirect(array('controller' => 'articles','action' => 'edit',$article_id));	
			
		}	
	 }	
	
  } //end send post 
*/

  
  
  
  
 /**
		This function used when uploading image with article
 */ 

/*
private function uploadImage()
{
$fileName = $_FILES['pic']['name'];
$fileType = $_FILES['pic']['type'];
$fileTempName = $_FILES['pic']['tmp_name'];
$fileSize = $_FILES['pic']['size'];
$fileError = $_FILES['pic']['error'];
if($fileError == UPLOAD_ERR_NO_FILE)
{
$imgURL = null;
return $imgURL;
}
else
{
if($fileError == UPLOAD_ERR_OK)
{
if($fileSize > $this->maxSize) throw new Exception('File too large!');
if(!eregi('image/',$fileType)) throw new Exception('Uploaded file is not an image!');
$fileInfo = getimagesize($fileTempName);
if(!eregi('image/',$fileInfo['mime'])) throw new Exception('Uploaded file is not an image!');
$fileName = rand(0,time()) . $fileName;
if(!move_uploaded_file($fileTempName,"$this->tempDir/$fileName")) throw new Exception('Unable to move uploaded image!');
$filePath = "$this->tempDir/$fileName";
}
}
 
$img = file_get_contents($filePath);
$encoded = new IXR_Base64($img);
$fileName = basename($filePath);
$imgData['name'] = $fileName;
$imgData['type'] = $fileInfo['mime'];
$imgData['bits'] = $encoded;
$imgData['overwrite'] = false;
if(!$this->client->query('metaWeblog.newMediaObject','',$this->uname,$this->pass,$imgData)) throw new Exception($this->client->getErrorMessage());
unlink($filePath);
$info = $this->client->getResponse();
$imgURL = $info['url'];
return $imgURL;
}
*/




}//end classs

?>
