<style type="text/css">
<!--
.brown32 {font-family:helvetica,arial bold; font-size:36px; font-weight:bold; color: #005447;padding-top:20px;}
.black16 {font-family:helvetica,arial; font-size:24px; font-weight:bold; color: #88cf15; display:inline;}
.grey10 {font-family:arial; font-size:14px; font-weight:normal; color: #6c6c6c;}
.help{color: #88cf15;font-size:24px; font-weight:bold;cursor:pointer;}
-->
</style>
<div align="center" >
<table background="/img/homepage_header.png" width="884px" height="202px">
<tr><td align="right" style="padding-right:20px;">
<?php
		
		$id=$session->read('user_id');
		if(empty($id))
		{ ?>
			<img style="cursor:pointer;" src="/img/box_sign-up.png" alt="Sign Up" onClick="window.location='/users/sign_up'" />
	<?php		
		}	
		else
		{ ?>
			<img style="cursor:pointer;" src="/img/box_dashboard.png" alt="Goto Dashboard" onClick="window.location='/dashboards/'" />
	<?php
		}
?>
</td></tr></table>
<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
		<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>
<div style="width:882px;background:#fff">
<!--<img src="/img/homepage_header.png" />-->

<!--<a href="#" class="lbAction" rel="deactivate">Close Lightbox.</a>-->
<table width="882px" border="0" cellspacing=10 valign="top" >
  <tr>
    <td width="50%" align="left"><div align="center" class="style2">
      <div align="left" class="brown32">SEO Professionals</div>
    </div></td>
	
    <td width="50%" align="left"><div align="center" class="style2" >
      <div align="left" class="brown32">Business Owners </div>
    </div></td>
    <!--<td width="290" align="right"><img src="/img/logo.jpg"></td>-->
  </tr>
  <tr>
    <td align="left" style="vertical-align:top"><p class="black16"><strong>Service your SEO Clients</strong></p>
   	<p align="justify" class="grey10"> This SEO toolbox can be utilized for "Off-Page" analytics and a variety of research. Find all the tools here to be utilized for SEO. From analytics to research, these tools help you manage all your SEO clients in one stop.</p></td>
	
    <td align="left" style="vertical-align:top"><p class="black16"><strong>Self Service SEO </strong></p>
     <p align="justify" class="grey10">Designed for ease of use, this toolbox enables you to control both on and off. website optimization.</p>
    </td>
  </tr>
  <tr>
  <td align="left" style="vertical-align:top"><p class="black16"><strong>Manage Multiple Blogs </strong></p>
     <p align="justify" class="grey10"> This toolbox helps you to control a number of blogs efficiently and without signing in to all your blogs. Write articles, spin articles, post articles and  manage pages; all using turtleSEO. </p>
  </td>
  
  <td align="left" style="vertical-align:top"><p class="black16"><strong>Manage One or Multiple Blogs </strong></p>
	<p align="justify" class="grey10">A toolbox that enables you to spin your article and generate multiple posts for various blogs. No duplicate content but content posted only once.</p>
  </td>
  </tr>
  <tr>
  <td align="left" style="vertical-align:top"><p class="black16"><strong>Optimize Content</strong></p>
	<p align="justify" class="grey10">Define your content strategy using tools to reseach your site's performance. Evaluate keyword density or traffic or site performance all in one click.</p>
  </td>
  
  <td align="left" style="vertical-align:top"><p class="black16"><strong>Use Power Tools to Research</strong></p>
<p align="justify" class="grey10">123 easy steps and you have a researh reports for your site. This is a one stop shop for all that you wish to know about your web site, be it keywords, links, speed or traffic.</p>
  </td>
  </tr>
  <tr>
    <td align="left" style="vertical-align:top"><p class="black16"><strong>Google Analytics</strong></p>
	<p align="justify" class="grey10">Get rich insights into your website traffic and marketing effectiveness. Analyze your traffic data with Google analytics.</p>
  </td>
	
    <td align="left" style="vertical-align:top"><p class="black16"><strong>Google Analytics</strong></p>
<p align="justify" class="grey10">The go to tool for SEO professionals to garner the essential information for behavior orientation stats.</p>
  </td>
   </tr>
  </table>
  

<div align="left" >

<!--<h3 align="center"> -->
<h3 align="left"> 

		<?php
		
		$id=$session->read('user_id');
		if(!empty($id))
		{
			echo '<a href="/dashboards/" style="text-decoration:underline;">Go to Dashboard</a></h3>';
		}	
		else
		{
			//edited
		?>
	<table width="91%" border="0"  style="padding-left:10px;">
		  <tr>
			<td width="431" height="38" ><font color=#005447>Help Videos <img src="/img/help-videos.png"></font> </td>
			<td width="362">&nbsp;</td>
		  </tr>
		  <tr>
			<td height="28" class="help" onclick="javascript: openwindow('blog');" onMouseOver="this.style.color='#005447'" onMouseOut="this.style.color='#88cf15'">How to add Blogs </td>
			<td class="help" onclick="javascript: openwindow('page');" onMouseOver="this.style.color='#005447'" onMouseOut="this.style.color='#88cf15'">How to add Page </td>
		  </tr>
		  <tr>
			<td height="30" class="help" onclick="javascript: openwindow('article');" onMouseOver="this.style.color='#005447'" onMouseOut="this.style.color='#88cf15'">How to add Article </td>
			<td class="help" onclick="javascript: openwindow('research');" onMouseOver="this.style.color='#005447'" onMouseOut="this.style.color='#88cf15'">How to Research </td>
		  </tr>
	</table>

		<?php
			//edited
			//echo	'<a href="/users/sign_up" style="text-decoration:underline;">Sign Up For Free</a></h3>';
		}
		?>
	</h3>	
</div>
<div><br /></div>
</div>
</div>
