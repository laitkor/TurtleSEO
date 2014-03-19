<?php

class ResearchController extends AppController {

	var $name = 'research';
	var $uses='';
	var $helpers=array('Javascript','Ajax');
	var $components = array('Googlepagerank','Alexa'); 
	function beforeFilter()
	{
		
		if( !($this->_isLoggedIn()) )
		{
			$this->Session->setFlash('You are not authorized to view this page');
			$this->redirect('/users/sign_in');
		}		
		
	}

  /**
		This function makes report and provide functionality for user to dowload report as pdf:manish
  */
  
	function index()
	{
 		//error_reporting(0);	
		$this->loadModel('User');
		$this->loadModel('UserPlan');
		$this->loadModel('Plan');
		$this->loadModel('Report');
		$user_id=$this->Session->read('user_id');
	    $plan=$this->UserPlan->query("select plans.name,plans.report_limit,user_plans.report_limit,user_plans.id from plans inner join user_plans on "." plans.id=user_plans.plan_id where user_plans.user_id=$user_id");
    	$plan_limit=$plan[0]['plans']['report_limit'];
		$user_limit=$plan[0]['user_plans']['report_limit'];
		
		
		$this->set('plan_limit',$plan_limit);
		$this->set('user_limit',$plan_limit-$user_limit);
		
		//showing link for report			 
		$record = $this->Report->find('all', array('conditions' => array('Report.user_id' => $this->Session->read('user_id')),'order'=>array('Report.date_created DESC') ));
		$report_name=array();
		$created=array();
		$id=array();
		if(count($record)>0)
		{
			foreach($record as $key => $value)
			{
				$report_name[]=$record[$key]['Report']['name'];
				$created[]=$record[$key]['Report']['date_created'];
				$id[]=$record[$key]['Report']['id'];
			}
		}	
		$this->set('report_name',$report_name); 
		$this->set('created',$created);
		$this->set('id',$id);
		//end showing link for report
		
       if(!empty($this->data))
		{
		//start manish
		
		if($user_limit == 0)
		{
			$message="Please upgrade your plan. Your report limit has exceeded";
			$this->Session->setFlash($message);
			$this->redirect('/research');
		}	
		
		//end manish
			if(trim($this->data['domain'])=="")
			{
				$this->set('mess',"Please enter domain");
			}
			else
			{

				$this->data['domain']=str_replace('http://','',$this->data['domain']);
				$this->data['domain']=str_replace('www.','',$this->data['domain']);
				 	
				$domain=$this->data['domain'];
				$tool=$this->data['tool'];
				if(strpos($domain,'http://')===false) $domain='http://'.$domain;
				switch ($tool)
				{
					
   					 case 'speed_checker':
					 		$info=$this->_speed_checker($domain);
							//pr($info);
							//exit;
							unlink(CONTROLLERS.'check.pdf');
							App::import('Vendor', 'fpdf/fpdf');
							$pdf=new FPDF();
							$pdf->AddPage();
							//$pdf->Image(WWW_ROOT.'/img/header.jpg',10,8,33);
							$pdf->Image($this->find_image(),160,8,33);
							$pdf->SetFont('Arial','B',12);
							$pdf->Cell(40,10,'WebSite Speed ');
							$pdf->Ln();
							$pdf->Ln();
							$pdf->Ln();
							$pdf->MultiCell(190,10,'The website speed report shows the duration that your website takes to load. Suppose your website\'s total size is 35.85 KB and it takes 1.36 seconds to load then the average speed of your website would be 0.04 seconds per KB. If your web site does not load in under 8 seconds on a dial-up connection (56k modem) then a large percentage of your website visitors will leave your site and access another that loads faster than yours. The speed of your website has a direct impact on the number of website visitors that convert into a sale or an enquiry.');
							$pdf->Ln();
							$pdf->Cell(40,10,"Domain : ".$domain);
							$pdf->Ln();
							$pdf->Cell(40,10,"File Size : " .$info['size']);
							$pdf->Ln();
							$pdf->Cell(40,10,"Page Load Time : " .$info['time']);
							$pdf->Output(CONTROLLERS.'check.pdf','F');
							header('Content-type: application/pdf');
							header('Content-Disposition: attachment; filename="speed_checker.pdf"');
							readfile(CONTROLLERS.'check.pdf');			
							$pdf->Output(CONTROLLERS.'check.pdf','F');
							header('Content-type: application/pdf');
							header('Content-Disposition: attachment; filename="keyword_density.pdf"');
							readfile(CONTROLLERS.'check.pdf');			
							exit;								
							break;
							
   					 case 'keyword_density':
					 		
       						$info=$this->_density($domain);
							//pr(count($info['res_counts_1']));
							//exit;
							App::import('Vendor', 'fpdf/fpdf');
							$pdf=new FPDF();
							$pdf->AddPage();
							//$pdf->Image(WWW_ROOT.'/img/header.jpg',10,8,33);
							$pdf->Image($this->find_image(),160,8,33);
							$pdf->SetFont('Arial','B',12);
							$pdf->Cell(40,10,'Keyword Density Analyzer');
							$pdf->Ln();
							$pdf->Ln();
							$pdf->Ln();
							$pdf->MultiCell(190,10,'Keyword density is the ratio or percentage of keywords contained within the total number of words that can be indexed within a web page. Keyword density percentage helps you to achieve optimum keyword density for a set of key terms. The most recommended keyword density ratio is within the range of 2-8%. Keyword density should to be balanced, if it is too low then the result would not be optimum and if it is too high then your paged can be flagged for keyword spamming.
Keyword Density = (Keywords) / (Total words) (8) / (400) = 0.02 = 2%.');
							$pdf->Ln();
							$pdf->Cell(40,10,"Domain : ".$domain);
							$pdf->Ln();
							$pdf->Cell(40,10,"Total Words : ".count($info['res_counts_1']));
							//$pdf->Cell(40,10,"2 Word Phrases : ".count($info['res_counts_2']));
							//$pdf->Cell(40,10,"3 Word Phrases : ".count($info['res_counts_3']));
							$pdf->Ln();
							//Colors, line width and bold font
   

							//Header
							$header=array('Word','Count','Density(%)');
							foreach($header as $col)
				        	$pdf->Cell(60,7,$col,1);
    						$pdf->Ln();
							//End Header
							
							//data
							$res_counts_1=$info['res_counts_1'];
							$nrWords=$info['nrWords'];
							$nr_total=count($res_counts_1);
							$x=1;$i=0;
							foreach($res_counts_1 as $k=>$t)
							{
								$density=$t*100/$nrWords;
								$density=number_format($density, 2);
								$data[]=array($k,$t,$density);
							}	
							 //Data
							foreach($data as $row)
							{
								foreach($row as $col)
									$pdf->Cell(60,6,$col,1);
								$pdf->Ln();
							}

				   			$pdf->Ln();
							$pdf->Cell(60,10,"2 Word Phrases : ".count($info['res_counts_2']));
							$pdf->Ln();
							
							//Header
							$header=array('Phrase','Count','Density(%)');
							foreach($header as $col)
				        	$pdf->Cell(60,7,$col,1);
    						$pdf->Ln();
							//End Header
							
							$data="";			
							$res_counts=$info['res_counts_2'];
							$nrWords=$info['nrWords'];
							$nr_total=count($res_counts);
							$x=1;$i=0;
							foreach($res_counts as $k=>$t)
							{
								$density=$t*100/$nrWords;
								$density=number_format($density, 2);
								$data[]=array($k,$t,$density);
							}	
							 //Data
							foreach($data as $row)
							{
								foreach($row as $col)
									$pdf->Cell(60,6,$col,1);
								$pdf->Ln();
							}
							
							$pdf->Ln();
							$pdf->Cell(60,10,"3 Word Phrases : ".count($info['res_counts_3']));
							$pdf->Ln();
							
							//Header
							$header=array('Phrase','Count','Density(%)');
							foreach($header as $col)
				        	$pdf->Cell(60,7,$col,1);
    						$pdf->Ln();
							//End Header
							
							$data="";					
							$res_counts=$info['res_counts_3'];
							$nrWords=$info['nrWords'];
							$nr_total=count($res_counts);
							$x=1;$i=0;
							foreach($res_counts as $k=>$t)
							{
								$density=$t*100/$nrWords;
								$density=number_format($density, 2);
								$data[]=array($k,$t,$density);
							}	
							 //Data
							foreach($data as $row)
							{
								foreach($row as $col)
									$pdf->Cell(60,6,$col,1);
								$pdf->Ln();
							}
						
							$pdf->Output(CONTROLLERS.'check.pdf','F');
							header('Content-type: application/pdf');
							header('Content-Disposition: attachment; filename="keyword_densities.pdf"');
							readfile(CONTROLLERS.'check.pdf');			
							exit;								
							break;
						
    				case 'domain_locator':
							$info=$this->_location_checker($domain);
							//unlink(CONTROLLERS.'check.pdf');
							App::import('Vendor', 'fpdf/fpdf');
							$pdf=new FPDF();
							$pdf->AddPage();
							//$pdf->Image(WWW_ROOT.'/img/header.jpg',10,8,33);
							$pdf->Image($this->find_image(),160,8,33);
							$pdf->SetFont('Arial','B',12);
							$pdf->Cell(40,10,'Domain Locator ');
							$pdf->Ln();
							$pdf->Cell(40,10,"Domain : ".$domain);
							$pdf->Ln();
							foreach($info as $key => $value)
							{
								$value=trim($value);
								if($value=="")$value= "N/A" ;
								$pdf->Cell(40,10,strtoupper($key) ." : ".$value);
								$pdf->Ln();
									
							}
							$pdf->Output(CONTROLLERS.'check.pdf','F');
							header('Content-type: application/pdf');
							header('Content-Disposition: attachment; filename="domain_locator.pdf"');
							readfile(CONTROLLERS.'check.pdf');			
							exit;								
							break;
					case 'header_analyzer':
        				$info=$this->_header_analyze($domain);
						App::import('Vendor', 'fpdf/fpdf');
						$pdf=new FPDF();
						$pdf->AddPage();
						//$pdf->Image(WWW_ROOT.'/img/header.jpg',10,8,33);
						$pdf->Image($this->find_image(),160,8,33);
						$pdf->SetFont('Arial','B',12);
						$pdf->Cell(40,10,'Header Finder ');
						$pdf->Ln();
						$pdf->Ln();
						$pdf->SetFont('Arial','B',12);
						$pdf->Cell(40,10,"Domain : ".$domain);
						$pdf->Ln();
						foreach($info as $key => $value)
						{	
							if(is_integer($key))
							{
								$pdf->Cell(40,10,"Server Response : " . $value);
								$pdf->Ln();
							}
							else
							{
								(is_array($value)) ? $v=$value[0] : $v=$value;
								$pdf->Cell(40,10,$key." : ". $v);
								$pdf->Ln();
							}	
						}
						$pdf->Ln();
						$pdf->SetFont('Arial','B',9);
						$pdf->MultiCell(190,7,'200 OK - The request has succeeded. The information returned with the response is dependent on the method used in the request.
301 Moved Permanently -The requested resource has been assigned a new permanent URI and any future references to this resource SHOULD use one of the returned URIs.
302 Found - The requested resource resides temporarily under a different URI. Since the redirection might be altered on occasion, the client SHOULD continue to use the Request-URI for future requests.
304 Not Modified- If the client has performed a conditional GET request and access is allowed, but the document has not been modified, the server SHOULD respond with this status code. The 304 response MUST NOT contain a message-body, and thus is always terminated by the first empty line after the header fields.
307 Temporary Redirect -The requested resource resides temporarily under a different URI. Since the redirection MAY be altered on occasion, the client SHOULD continue to use the Request-URI for future requests. This response is only cacheable if indicated by a Cache-Control or Expires header field.
404 Not Found - The server has not found anything matching the Request-URI. No indication is given of whether the condition is temporary or permanent.
410 Gone - The requested resource is no longer available at the server and no forwarding address is known. This condition is expected to be considered permanent.');
						$pdf->Output(CONTROLLERS.'check.pdf','F');
						header('Content-type: application/pdf');
						header('Content-Disposition: attachment; filename="header_analyzer.pdf"');
						readfile(CONTROLLERS.'check.pdf');			
						exit;								
						break;
					case 'back_links':
						$url=parse_url($domain);
						$this->_link(0,trim($url['host']));
						break;
					case 'domain_availability':
        				$info=$this->_domain_check($domain);
						App::import('Vendor', 'fpdf/fpdf');
						$pdf=new FPDF();
						$pdf->AddPage();
						//$pdf->Image(WWW_ROOT.'/img/header.jpg',10,8,33);
						$pdf->Image($this->find_image(),160,8,33);
						$pdf->SetFont('Arial','B',5);
						$pdf->Cell(40,10,'Domain Availability');
						$pdf->Ln();
						$pdf->Cell(40,10,"Domain : ".$domain);
						$pdf->Ln();
						$pdf->Cell(40,10,"Result : " . $info);
						$pdf->Output(CONTROLLERS.'check.pdf','F');
						header('Content-type: application/pdf');
						header('Content-Disposition: attachment; filename="domain_availability.pdf"');
						readfile(CONTROLLERS.'check.pdf');			
						exit;								
						break;	
					case 'rank':
						// Send to google.com and get the PageRank
        				 $rank=$this->Googlepagerank->GetPR($domain); 
						 if($rank==0)
						 $this->set('rank','Not Indexed In Google Yet.') ;
						 else
						 $this->set('rank',$rank) ;
						 $this->render("index");
						break;
					
					case 'report':

							App::import('Vendor', 'htmldoc');
							$url=parse_url($domain);
							$domain = trim($url['host']);
							//un- commented date 14 june 10 start manish alexa data
						 	$result=$this->Alexa->site_info($domain);
							(!empty($result['rank'])) ? $alexa_rank=$result['rank'] : $alexa_rank='N/A';
							(!empty($result['title'])) ? $alexa_title=$result['title'] : $alexa_title='N/A';
							(!empty($result['online_since'])) ? $online_since=$result['online_since'] : $online_since='N/A';
							(!empty($result['linksincount'])) ? $alexa_backlinks=$result['linksincount'] : $alexa_backlinks='N/A';
						 	//un- commented date 14 june 10 end manish
							
							//google page rank
							 $rank=$this->Googlepagerank->GetPR($domain); 
							($rank===0) ? $google_rank='Not Yet Indexed' : $google_rank=$rank;
							
							//yahoo_backlinks
							$yahoo_url="http://boss.yahooapis.com/ysearch/se_inlink/v1/".
							"$domain?appid=".YAHOO_API_KEY."&format=xml&count=20&start=0";
							$result = $this->_make_http_request($yahoo_url);
							$d=new SimpleXMLElement($result);
							$total_links=$d->resultset_se_inlink['totalhits'];	
							(!empty($total_links)) ? $yahoo_backlinks=$total_links : $yahoo_backlinks='N/A';
						
							//website_speed_checker
							$result=$this->_speed_checker('http://'.$domain);
							(!empty($result['size'])) ? $html_size=$result['size'] : $html_size='N/A';
							(!empty($result['time'])) ? $website_speed=$result['time'] : $website_speed='N/A';
							if(!empty($result['size']))
							$average_speed=round( ((1/$result['size'])*$result['time']),2 )." Sec";
							else
							$average_speed='N/A';
							
							//domain locator
							$info=$this->_location_checker('http://'.$domain);
							foreach($info as $key => $value)
							{
								if(strtoupper($key)=="IP" || strtoupper($key)=="COUNTRY NAME" || strtoupper($key)=="CITY")
								{
									$value=trim($value);
									if($value=="")
									$domain_locator[]= "N/A" ;
									else
									$domain_locator[]=$value;
								}
									
							}
							
							//keyword density
							$info=$this->_density('http://'.$domain);
							$res_counts_1=$info['res_counts_1'];
							$nrWords=$info['nrWords'];
							$nr_total=count($res_counts_1);
							$density=array();
							foreach($res_counts_1 as $k=>$t)
							{
								$den=$t*100/$nrWords;
								$den=number_format($den,2);
								$words[]=$k;
								$density[]=$den;
							}
							 sort($density);
							(!empty($density[0])) ? $keyword1=$words[0]." - ".$density[0]."%" : $keyword1='';
							(!empty($density[1])) ? $keyword2=$words[1]." - ".$density[1]."%"  : $keyword2='';
							(!empty($density[2])) ? $keyword3=$words[2]." - ".$density[2]."%"  : $keyword3='';
								
							$html=file_get_contents(WWW_ROOT.'final.html');
							//$html=file_get_contents(CONTROLLERS.'research_report.html');
							
							//google analytics data
							
								App::import('Vendor', 'analytics');
								App::import('Vendor', 'gdchart');
								$this->loadModel('ApiSetting');
/*								$api=$this->ApiSetting->find('all', array('conditions' => array('ApiSetting.name' => 'Google_Analytics',
											ApiSetting.user_id' =>$this->Session->read('user_id'), 'ApiSetting.active' =>1 ) ));*/
						       $raw_url=$this->data['domain'];
							   $url2=str_replace('http://','',$raw_url);
							   if(isset($url2) && $url2!='')
	   						   $url2=str_replace('www.','',$url2); 
	 
							   $api=$this->ApiSetting->find('all', array('conditions' => array(
								'ApiSetting.name' => 'Google_Analytics',
								'ApiSetting.user_id' =>$this->Session->read('user_id'),
								'ApiSetting.active' =>1,
								"OR" => array("ApiSetting.api_url like" => "%$url2%",)
							 )));
					 
								if(count($api)>0)
								{		
									$oAnalytics = new analytics($api[0]['ApiSetting']['api_key'], $api[0]['ApiSetting']['api_password']);
									$oAnalytics->setProfileById("ga:".$api[0]['ApiSetting']['api_token']);
						
									$oAnalytics->setMonth(date('n'), date('Y'));
								    $pgs="";
							        $page_views=$oAnalytics->getPageviews();
									$getVisitors=$oAnalytics->getVisitors();
								    $getBrowsers=$oAnalytics->getBrowsers();
									$getVisitsPerHour=$oAnalytics->getVisitsPerHour();
									$getReferrers=$oAnalytics->getReferrers();  // tables
									$getSearchWords=$oAnalytics->getSearchWords(); // tables
									$getScreenResolution=$oAnalytics->getScreenResolution(); // table
									
								    foreach($page_views as $key => $value)
								    $pgs.=$value.",";
								    $pgs= substr($pgs,0,strlen($pgs)-1); //removing last comma
				   			        $ch_tit=date('M-Y');
							   	   //$chart="<img src=http://chart.apis.google.com/chart?cht=bvs&chtt=$ch_tit&chs=800x200&chd=t:$pgs&chf=b0,lg,0,FFE7C6,0,76A4FB,1 />";	
									$max_range=max($page_views);
									$lineChart = new gLineChart(500,500);
									$lineChart->addDataSet($page_views);
									$lineChart->setLegend(array("Page Views"));
									$lineChart->setColors(array("ff3344"));
									$lineChart->setVisibleAxes(array('x','y'));
									$lineChart->setDataRange(0,$max_range);
									$lineChart->addAxisRange(0, 1, 31, 1);
									$lineChart->addAxisRange(1, 0, $max_range);
									$lineChart->setGridLines(33,10);
							  	  	$chart="<img src='".$lineChart->getUrl()."' />";
									
									/* added by manish start */
								  foreach($getVisitors as $key1 => $value1)
								    $pgs1.=$value1.",";
								    $pgs1= substr($pgs1,0,strlen($pgs1)-1); //removing last comma
				   			        $ch_tit1=date('M-Y');	
									$max_range1=max($getVisitors);
									$lineChart1 = new gLineChart(500,500);
									$lineChart1->addDataSet($pgs1);
									$lineChart1->setLegend(array("Visiters"));
									$lineChart1->setColors(array("ff3344"));
									$lineChart1->setVisibleAxes(array('x','y'));
									$lineChart1->setDataRange(0,$max_range1);
									$lineChart1->addAxisRange(0, 1, 31, 1);
									$lineChart1->addAxisRange(1, 0, $max_range1);
									$lineChart1->setGridLines(33,10);
							  	  	$chart1="<img src='".$lineChart1->getUrl()."' />";	
								 
								  
								 //-=======================================================
								 
								 foreach($getVisitsPerHour as $key2 => $value2)
								    $pgs2.=$value2.",";
								    $pgs2= substr($pgs2,0,strlen($pgs2)-1); //removing last comma
				   			        $ch_tit2=date('M-Y');	
									$max_range2=max($getVisitsPerHour);
									$lineChart2 = new gLineChart(500,500);
									$lineChart2->addDataSet(array($pgs2));
									$lineChart2->setLegend(array("Visits Per Hour"));
									$lineChart2->setColors(array("ff3344"));
									$lineChart2->setVisibleAxes(array('x','y'));
									$lineChart2->setDataRange(0,$max_range2);
									$lineChart2->addAxisRange(0, 1, 31, 1);
									$lineChart2->addAxisRange(1, 0, $max_range2);
									$lineChart2->setGridLines(33,10);
							  	  	$chart2="<img src='".$lineChart2->getUrl()."' />";
								  
							  //-=======================  getBrowsers ================================
									  
			                        $tabl1="<table  width='550' border='1' bordercolor='#000000' cellpadding='3' cellspacing='0'>";
									 $tabl1.="<tr bgcolor='#999999'><td><b>Browser</b></td><td  width:60px;'><b>Hits</b></td></tr>";
									 foreach($getBrowsers as $keyz3=>$valuez3){  
									    $tabl1.="<tr><td>".$keyz3."</td><td>".$valuez3."</td></tr>";
									 }
									 $tabl1.="</table>";
 					         /*  ******************  getReferrers    ************************** */
  
			                       $tabl2="<table  width='550' border='1' bordercolor='#000000' cellpadding='3' cellspacing='0'>";
									 $tabl2.="<tr bgcolor='#999999'><td><b>Referring Search Enginer/Sites</b></td><td><b>Hits</b></td></tr>";
									 foreach($getReferrers as $keyz4=>$valuez4){  
									    $tabl2.="<tr><td>".$keyz4."</td><td>".$valuez4."</td></tr>";              }
									 $tabl2.="</table>";									 
							  /* ****************** end getReferrers **************************  */
							 /*  ******************  getSearchWords    ************************** */
							        $tabl3="<table width='550' border='1' bordercolor='#000000' cellpadding='3' cellspacing='0'>";
									 $tabl3.="<tr bgcolor='#999999'><td><b>KeyWords</b></td><td><b>Search</b></td></tr>";
									  foreach($getSearchWords as $keyz5=>$valuez5){  
									    $tabl3.="<tr><td>".$keyz5."</td><td>".$valuez5."</td></tr>";               
									 }
									 $tabl3.="</table>";	
							  /*  ****************** end SearchWords **************************  */
						 
					$vFinalReport="<h4>Page Views</h4>".$chart;
					$vFinalReport.="<h4  style='page-break-before:always;'>Visiters Details</h4>".$chart1;
					$vFinalReport.="<h4>Visits/Hours Details</h4>".$chart2; 
					$vFinalReport.="<h4 style='page-break-before:always;'>Browser Details</h4>".$tabl1."<br>";
					$vFinalReport.="<h4>Referring Search Enginer/Sites Details</h4>".$tabl2."<br>";
					$vFinalReport.="<h4  style='page-break-before:always;'>Search Keyword Details</h4>".$tabl3;
 
							 
		
    						      /* added by manish end */
									
							
								}
								else
								{
									$vFinalReport=" Google Analytics API details not available";
								}			
							 // $paa=WWW_ROOT."img/header.jpg";
							 					
								$imgurl = $this->find_image();
								$paa=$this->Session->read('name');
		//'{{google_chart2}}','{{google_chart3}}','{{google_chart4}}','{{google_chart5}}','{{google_chart6}}',
		//$keyword2,$keyword3,$chart,$chart1,$chart2,$chart3,$chart4,$chart5,$chart6,					
					 $find=array('{{path}}','{{domain}}','{{company_name}}','{{google_rank}}','{{online_since}}','{{alexa_backlinks}}','{{alexa_title}}','{{alexa_rank}}','{{yahoo_backlinks}}','{{website_speed}}','{{html_size}}','{{average_load_time}}','{{ip}}','{{country}}','{{city}}','{{keyword1}}','{{keyword2}}','{{keyword3}}','{{google_chart}}','{{URL}}');
				   $replace=array($paa,$domain,COMPANY_NAME,$rank,$online_since,$alexa_backlinks,$alexa_title,$alexa_rank,$yahoo_backlinks,$website_speed,$html_size,$average_speed,$domain_locator[0],$domain_locator[1],$domain_locator[2],$keyword1,$keyword2,$keyword3,$vFinalReport,$imgurl);
							$html=str_replace($find,$replace,$html);
						//echo $html;
					//	exit;
								$ran = time () ;
								$ran=$ran.".pdf";
							
							
								$file=WWW_ROOT."reports/$ran";
							//echo $file;
							//exit;
							
							$pdf = new Htmldoc( $html,$file );
					    	$pdf->setMargins(0,15,15,10);
    						if ( ! $pdf->render() ){
								  $pdf->error();}
							  
								$d=array();
							  	$this->UserPlan->id=$plan[0]['user_plans']['id'];
								$d['UserPlan']['report_limit']=$user_limit-1;
								$this->UserPlan->save($d);	
								
								
								$report_data['Report']['name']=$ran;
								$report_data['Report']['date_created']=date("Y-m-d H:i:s", strtotime("now"));
								$report_data['Report']['user_id']=$this->Session->read('user_id');
								$this->Report->save($report_data);
				
								$this->Session->setFlash('Report Generated.');
								$this->redirect(array('action' => 'index'));
							break;
							
					default:
						break;	
						
				}
			}
		}
		
		
		$this->loadModel('User');
		$user=$this->User->findById($this->Session->read('user_id'));
		$this->set('plan_name',ucfirst($user['User']['plan_type']));
		$this->render('index');  		
	}//end index

	//added by Navneet ::::: Getting Image Uploaded by user
	function find_image()
	{
		if ($handle = opendir(realpath('../../app/webroot/img/user_images/')))
		{
			while (false !== ($file = readdir($handle))) 
			{
				if (strcmp($this->Session->read('user_id'),substr($file,0,strrpos($file,"."))) == 0)
				{
					$imgfile = $file;
        		}
    		}
		closedir($handle);
		}
		return realpath('../../app/webroot/img/user_images/') .'/'.$imgfile;
	}
	//end added by Navneet	

	function download_report($file)
	{
		//echo WWW_ROOT.$file;
		//exit;
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past 
		header('Content-type: application/pdf');
		header('Content-Disposition: attachment; filename="summary_report.pdf"');
		readfile(WWW_ROOT."reports/$file");			
		exit;							
	}
	
	function view_report($file)
	{
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past 
		header('Content-type: application/pdf');
		header('Content-Disposition: attachment; filename="summary_report.pdf"');
		header("Location: /reports/$file");
		exit;							
	}
	function _speed_checker($domain)
	{
		$low_date=microtime(true);
		$str=file_get_contents($domain);
		$high_date = microtime(true);
		$pageLoad = $high_date - $low_date;  	
		file_put_contents(CONTROLLERS.'tmp.txt',$str);
		$file_size=filesize(CONTROLLERS.'tmp.txt');
		$file_size=round($file_size/1024);
		$file_size=$file_size ."KB";
		$pageLoad=round($pageLoad,2)." Sec";
		unlink(CONTROLLERS.'tmp.txt');
		$info=array('time' => $pageLoad,'size' => $file_size);
		return $info; 
	}

	
	
	/**
			This is a main function to calculate keyword density.
	*/
	
	function _density($domain)
	{
			//exit;
			App::import('Vendor', 'density_checker');
			$url=trim($domain);
			$url_backup=$url;
			$ultimate = &New DensityChecker;
			$ultimate->minoc=$_POST['minoc'];
			$ultimate->minlength=$_POST['minlength']+1;
			$page=$ultimate->getUrl($url);
			if($page===false) 
			{
			}
			else
			{
				//extracting meta-tags : title,keywords,description
				$tags=$ultimate->_parseTags($page);
				//extracting only text from html
				$text=$ultimate->getOnlyText($page);
				if($_POST['ikey']==1) $text=$text." ".$tags['keywords'];
				if($_POST['ides']==1) $text=$text." ".$tags['description'];
			
				//erasing stop words
				if($_POST['stopwords']==1 )
				{
					$handle = fopen(WWW_ROOT."/stop_words.txt", "r");
					while (!feof($handle)) 
					{
  						$buffer = fgets($handle, 4096);
						$buffer=" ".trim($buffer)." ";
   						if(strlen(trim($buffer))>0) $text = ereg_replace(strtolower($buffer)," ",strtolower($text));
					}
					fclose($handle);
				}
		
				//end erasing stop words
				//echo $text;
				//getting 1 word
				$nrWords=$ultimate->getNrWords($text);
				$res_counts_1=array();
				$res_counts_1=$ultimate->getCounts($text);
	
				//getting 2 words
				$res_counts_2=array();
				$res_counts_2=$ultimate->getCounts_2($text);
				//getting 3 words
				$res_counts_3=array();
				$res_counts_3=$ultimate->getCounts_3($text);
				//output results table
				$info=array('res_counts_1' => $res_counts_1 ,'res_counts_2' => $res_counts_2,'res_counts_3' => $res_counts_3,'nrWords' => $nrWords);
				return $info;
		     	//$this->set('res_counts_1',$res_counts_1);
				//$this->set('res_counts_2',$res_counts_2);
				//$this->set('res_counts_3',$res_counts_3);
			 	//$this->set('nrWords',$nrWords);
			 	
			}//end else
			
	}//end _density
 
 
		/**
 				This action analysis header of any site
 		*/
	
		function _header_analyze($domain)
		{
				$url=trim($domain);
				$header_info=get_headers($url,1);
				return $header_info;
		}
 
 		/**
 		This function displays geographical position of entered site.
		
		USES WEBSERVICE : http://ipinfodb.com/ip_location_api.php
		*/ 
 		function _location_checker($data)
		{
			$url=trim($data);
			$url=parse_url($url);
			$ip = gethostbyname($url['host']);
			$result=$this->_locateIp($ip,'xml',"true");	
			return $result;
				
		}
	
		function _locateIp($ip,$output,$tz="true") //ip,output,timezone
		{
				$d = file_get_contents(GEOLOCATION_SERVER."ip=$ip&output=$output&timezone=$tz");
			  //Use backup server if cannot make a connection
	 		 if (!$d)
			 {
	    		$backup = file_get_contents(GEOLOCATION_BACKUP_SERVER."ip=$ip&output=$output&timezone=$tz");
	   			$answer = new SimpleXMLElement($backup);
	  		 	 if (!$backup) return false; // Failed to open connection
	  		 }
			 else{$answer = new SimpleXMLElement($d);}
	 
			  $ip = $answer->Ip;
			  $country_code = $answer->CountryCode;
			  $country_name = $answer->CountryName;
			  $region_name = $answer->RegionName;
			  $region_code = $answer->RegionCode;	
			  $city = $answer->City;
			  $zippostalcode = $answer->ZipPostalCode;
			  $timeZone=$answer->TimezoneName;
			  $latitude = $answer->Latitude;
			  $longitude = $answer->Longitude;
 
		  	//Return the data as an array
			  return array('ip' => $ip,'country code' => $country_code,
  				 'country name' => $country_name, 'state/province' => $region_name,'region code' => $region_code ,'city' => $city, 'zippostalcode' => $zippostalcode,'time zone'=>$timeZone ,'latitude' => $latitude, 'longitude' => $longitude);
		
		}//end function
 

		/**
				This function checks domain is available or not.
		**/
		function _domain_check($domain)
		{
				$url=trim($domain);
				App::import('Vendor', 'domain');
				$domain=new Domain($url);
				// Checking if domain is available
				if($domain->is_available())
    			return 'Domain Is Available';
				else
    			return 'Domain Is Not Available';
		}	
		
		
		function back_link($start='',$url)
		{
			$this->_link($start,$url);
			
		}//end function
		
		
		function _link($start,$url)
		{
			$yahoo_url="http://boss.yahooapis.com/ysearch/se_inlink/v1/".
							"$url?appid=".YAHOO_API_KEY."&format=xml&count=20&start=$start";
							
			$this->result = $this->_make_http_request($yahoo_url);
			$d=new SimpleXMLElement($this->result);
			$total_links=$d->resultset_se_inlink['totalhits'];	
						
			$this->result = str_replace ("&amp;", "$", $this->result);	
			//pr($this->result);		
			//$times=round($total_hits/20);	
			$this->_setParser();
echo "<pre>";	print_r($this->nextpage);
			if(!empty($this->nextpage))
			{
				$arr=explode('&',$this->nextpage);
				$arr=explode('=',$arr[3]);
				//$this->set('next',$arr[1]);
				$this->_link($arr[3],$url);
			}
			else
			//return $this->links;
			echo "<pre>";	print_r($this->links);
			
			/*if(!empty($this->prepage))
			{
				$arr=explode('&',$this->prepage);
				$arr=explode('=',$arr[3]);
				$this->set('pre',$arr[1]);
			}
			
			$this->set('back_links',$this->links);
			$this->set('tit',$this->title);
			$this->set('total_links',$total_links);	
			$this->set('url',$url);*/
			
		}
		
		function more_link($start,$url)
		{
			$this->_link($start,$url);
			
		}
		
	
		function _setParser()
		{
			// Parse XML and display results
			$this->current_tag = "";
			$this->results="";
			$this->xml_parser  =  xml_parser_create("");
			xml_set_object($this->xml_parser, $this); 
			
			//xml_parser_set_option($this->xml_parser, XML_OPTION_CASE_FOLDING, false);
			//xml_parser_set_option($this->xml_parser, XML_OPTION_TARGET_ENCODING, 'UTF-8'); 
			xml_parser_set_option($this->xml_parser, XML_OPTION_CASE_FOLDING, false);
			
			xml_set_element_handler($this->xml_parser, "_start_tag", "_end_tag");
			xml_set_character_data_handler($this->xml_parser, "_contents");
			//pr($this->result['url']);
			xml_parse($this->xml_parser, $this->result, true);
			xml_parser_free($this->xml_parser);
			
		}
	
			function _contents($parser, $con)
			{
			 
				switch ($this->current_tag) {
			   
 
				case "title":
							   $this->title[] =  $con;   
							   //print_r($this->title);
						break;		
			
				case "url":
							$this->links[]=$con;
							//echo $con."<br>";
								//$this->results['url'] .=  $con.";";    //splitting multiple urls
							   //$this->results[] .=  $con.";";    //splitting multiple urls
		
						break;		
				case "nextpage":
				//echo $con;
				$this->nextpage=$con;		
				break;
				
				case "prevpage":
				$this->prepage=$con;		
				break;
				
				 }
			}//end function	

			function _start_tag($parser, $name) 
			{
				$this->current_tag = $name;
			}
		
			function _end_tag()
			{
				$this->current_tag = '';
			}
		


			// Make an http request to the specified URL and return the result
			function _make_http_request($url)
			{
			   $ch = curl_init($url);
			   curl_setopt($ch, CURLOPT_TIMEOUT, 4);
			   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			   $result = curl_exec($ch);
			   curl_close($ch);
			   return $result;
			}		
			
	function delete($id)
	{
		$id=trim($id);
		$user_id=$this->Session->read('user_id');
		$this->loadModel('UserPlan');
		$this->loadModel('Report');
		$plan_data=$this->UserPlan->findByUserId($user_id);
		$this->UserPlan->id = $plan_data['UserPlan']['id'];
		if ($plan_data['UserPlan']['report_to_del'] > 0 )
		{
			$d['UserPlan']['report_to_del']=$plan_data['UserPlan']['report_to_del'] - 1;
			$d['UserPlan']['report_limit'] = $plan_data['UserPlan']['report_limit'] + 1;
			$this->UserPlan->save($d);
		}	
		$this->Report->delete($id,true);
		$this->Session->setFlash('Report has been deleted.');
		$this->redirect('/dashboards/');
	}	
		/*function _links($url,$times)
		{	
			
			$data=array();
			foreach($times as $key => $value)
			{
				
				if(!empty($y_url))
				$yahoo_url="http://boss.yahooapis.com".$y_url;
				else	
				$yahoo_url="http://boss.yahooapis.com/ysearch/se_inlink/v1/".
							"$url?appid=".YAHOO_API_KEY."&format=xml&count=20&start=0";  
							
				$this->result = $this->_make_http_request($yahoo_url);
		
				$this->result = str_replace ("&amp", "$", $this->result);
				$d=new SimpleXMLElement($this->result);
				$this->total_hits=$d->resultset_se_inlink['totalhits'];
				$this->_setParser();
				//$this->Session->write('backlink_url',$this->nextpage);
				$y_url=$this->nextpage;
				
				$sno=count($data);
				foreach($this->links as $key => $value)
				{
					if(trim($value)!="")
					{
						//if(strpos($value,'http://')===false) continue;
						$value = str_replace ("$", "&", $value);
						$sno=$sno+1;
						$data[]=array($sno,$value,$this->title[$key]);
						
			
					}
				}	
			}//end upper for for times to fire to call yahoo
			var_dump($data);
		}//end function
	*/	
 
 }//end class

?>
