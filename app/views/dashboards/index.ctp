<style>
#homepage-dash{
background:url(/img/seo1.jpg);
height:690px;
width:100%;
}

body {
background:url("/img/bg_dash.png") repeat-x scroll 0 0 transparent;
color:#FFFFFF;
font-family:'lucida grande',verdana,helvetica,arial,sans-serif;
font-size:14px;
margin:0;
top:0;
}

span.heading{color:#FF9900;font-size:24px;}
td.sub_heading{color:#ffffff;background-color:#6893ff;font-weight:bold;padding-left:4px; text-align:left;}

table.sub_table, th.sub_table, td.sub_table
{
border: 1px solid  #cccccc;
}
</style>
<?php

if(!empty($disable))
{
	echo "<div align='center'><font color='red'>Your Account Type Is $plan_name.Please Make Payment to Unlock Feature</font>&nbsp;&nbsp;<a href='/payments/expressCheckout/1'>Make Payment</a><font color='red'> or </font> <a href='/users/plans/'>Change Plan</a>          </div>";
	
	echo "<div align='right'><br></div>";	
	
}
else
{?>
 
 <div align="center" >
 <table background="/img/dashboard.png" width="884px" height="81" >
<tr><td align="right" style="padding-right:20px;">&nbsp;
 </td></tr></table>
 
<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
	<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>
<table width="882px" style="background:#fff;">
	<tbody>
	<tr>
	<td width="25%" valign="top" >
		<?php echo $this->element('menu',array('link_name' => 'not_specified')); ?>
	</td>

	<td  valign="top" width="65%"  >	
	<table width="97%" border="0"  cellspacing="0" cellpadding="0" >
  	<tr>
    	<td width="100%" height="25" class="sub_heading" >My Blogs</td>
    	<td>&nbsp;</td>		
	</tr>	
  <tr>
    <td height="51" valign="top">
		
		<table  width="100%"  class="sub_table" style="padding-top:5px;" >
			   <?php
				foreach($servers as $key => $server):  ?>
				<tr  >
					<td width="62%" class="sub_table" align="left"><?php echo $server['WpServer']['name']; ?> </td> 	
					<td width="38%" class="sub_table" align="right" valign="top"> 
					<a href='/blogs/edit/<?php echo $server['WpServer']['id']; ?>'>Edit</a>  <?php //echo $html->link('Delete',array('controller'=>'blogs', 'action'=>'delete',$server['WpServer']['id']),array(),"Are you sure you wish to delete this server?");?>					</td> 													
				</tr> 
				<?php endforeach; ?> 
				<tr ><td></td><td valign="top" align="right" ><?php if(count($servers)>0){?><a href="/blogs/">More >></a><?php } else { echo 'No Record';}?></td></tr>
		</table>
	</td>
  </tr>
  
<tr>
    <td height="52"  ></td>
    <td>&nbsp;</td>
    <td ><a href="/blogs/"></a></td>
  </tr>


	
	<tr>	
	<td class="sub_heading" height="25" width="343">My Articles </td>
    <td>&nbsp;</td>
	<tr>
    <td valign="top"><table  width="100%"  class="sub_table" style="padding-top:5px;" >
			   <?php
				foreach($posts as $key => $post):  ?>
				<tr  >
					<td width="62%" class="sub_table" align="left"><?php echo $post['Article']['title']; ?> </td> 	
					<td width="38%" class="sub_table" align="right" valign="top">
					<a href='/articles/edit/<?php echo $post['Article']['id']; ?>'>Edit</a></td> 													
				</tr> 
				<?php endforeach; ?> 
				<tr ><td></td><td valign="top" align="right" ><?php if(count($posts)>0){?><a href="/articles/">More >></a><?php } else { echo 'No Record';}?></td></tr>
		</table> </td>
  </tr>
  <tr>
    <td height="52"  ></td>
    <td>&nbsp;</td>
    <td ><a href="/blogs/"></a></td>
  </tr>
  <tr>
   <td width="80%" height="27" class="sub_heading"  >My Reports</td>
    <td>&nbsp;</td>
    <td class="sub_heading" width="343" style="display:none;">My Reports </td>
  </tr>
  <tr>
    <td valign="top" >
	<table  width="100%"  class="sub_table" style="padding-top:5px;" >
			  <?php 
				foreach($reports as $key => $report): 
				$dt=explode(' ',trim($report['Report']['date_created']));
				$tm=explode(' ',trim($report['Report']['date_created']));
				
				$dt=explode('-',$dt[0]);
				$tm=explode(':',$tm[1]);
				$dt= date("jS_F_Y_H:i:s", mktime($tm[0],$tm[1],$tm[2],$dt[1],$dt[2],$dt[0]));
				//$dt=substr_replace($dt,$dt[0].$dt[1].'th',0,2);  //adding th format
					
			 ?>
				<tr  >
					<td width="62%" class="sub_table" align="left"><?php echo $dt; ?> </td> 	
					<td width="38%" class="sub_table" align="right" valign="top"> 
					<a href='/research/view_report/<?php echo $report['Report']['name']; ?>' target="_blank">View</a>				  </td> 													
				</tr> 
				<?php endforeach; ?> 
				<tr ><td></td><td valign="top" align="right" ><?php if(count($reports)>0){?><a href="/research/">More >></a><?php } else { echo 'No Record';}?></td></tr>
		</table>
	<!--
			<table  width="100%"  class="sub_table" style="padding-top:5px;" >
			  <?php
				foreach($servers as $key => $server):  ?>
				<tr  >
					<td width="62%" class="sub_table" valign="top"><?php echo $server['WpServer']['name']; ?> </td> 	
					<td width="38%" class="sub_table" align="right" valign="top"> 
					<a href='/blogs/page_add/<?php echo $server['WpServer']['id']; ?>'>Add</a>				  </td> 													
				</tr> 
				<?php endforeach; ?> 
				<tr ><td></td><td valign="top" align="right" ><?php if(count($servers)>0){?><a href="/blogs/add_page">More >></a><?php } else { echo 'No Record';}?></td></tr>
		</table>
	-->
		
	</td>
    <td>&nbsp;</td>
    <td  valign="top" style="display:none;">
	<table  width="90%"  class="sub_table" style="padding-top:5px;" >
			  <?php 
				foreach($reports as $key => $report): 
				$dt=explode(' ',trim($report['Report']['date_created']));
				$dt=explode('-',$dt[0]);
				$dt= date("jS_F_Y", mktime(0, 0, 0, $dt[1],$dt[2],$dt[0]));
				//$dt=substr_replace($dt,$dt[0].$dt[1].'th',0,2);  //adding th format
					
			 ?>
				<tr  >
					<td width="62%" class="sub_table" valign="top"><?php echo "seo_report_" .$dt; ?> </td> 	
					<td width="38%" class="sub_table" align="right" valign="top"> 
					<a href='/research/view_report/<?php echo $report['Report']['name']; ?>'>View</a>				  </td> 													
				</tr> 
				<?php endforeach; ?> 
				<tr ><td></td><td valign="top" align="right" ><?php if(count($reports)>0){?><a href="/research/">More >></a><?php } else { echo 'No Record';}?></td></tr>
		</table>
	</td>
  </tr>
  <tr>
    <td ></td>
    <td>&nbsp;</td>
    <td align="right"></td>
  </tr>
  <tr>
    <td ></td>
    <td>&nbsp;</td>
    <td align="right"></td>
  </tr>
  <tr>
    <td ></td>
    <td>&nbsp;</td>
    <td align="right"></td>
  </tr>
</table>
			  </td>
			  	<td width="20%" valign="top" >
		<?php  if($_SESSION['user_plantype']!='gold'){
echo "<a href='/users/plans/' title='click here to upgrade your plan'><img src='/img/step-up.png' style='padding-right: 30px' align='left' border='0' ></a>";
} ?>
	</td>
			</tr>
		
	</tbody>
</table>

</div>


<?php 	//echo $crumb;
 	//echo $this->requestAction(array('controller' => 'blogs', 'action' => 'index'), array('return'));   
} ?>

