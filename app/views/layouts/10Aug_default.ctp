<?php
/* SVN FILE: $Id$ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>turtleSEO: Link building via multiple blogs, social networking and SEO tools for internet marketing</title>
	<?php echo $html->charset(); ?>
	<meta name="Keywords" content="SEO,Manage multiple blogs, evaluate site performance, free blog management, free SEO reports, free social networking, link buiding, social networking, add blogs, self SEO, SEO clients, off page optimization tools">
	<meta name="Description" content="Service your SEO clients or do it yourselves (DIY). Research, Optimize, Repeat. Free SaaS service gets you started immediately">
         <!-- code for alexa -->
         <meta name="alexaVerifyID" content="LxEFcv6MUKQSMyVmguwMeO5lq2Y" />	
	 <LINK REL="SHORTCUT ICON" href="/img/favicon.ico">  
	
	 	
	<script src="/js/prototype.js" type="text/javascript"></script>
	<script src="/js/scriptaculous.js" type="text/javascript"></script>
	
	<?php
		//echo $html->meta('icon');

		echo $html->css('cake.generic');
		
		echo $scripts_for_layout;
	?>
</head>
<body>

	<div id="container">
	
		  <div id="header">  
		<!--  <div id="header" >   -->
			
				<?php echo $this->element('header'); ?>
			
		</div>
	
		<div align="center" id="content">
		
			<!--<div align="center" id="message" ><?php $session->flash(); ?></div>-->

			<?php echo $content_for_layout; ?>

		</div>
		<style>
		.row_3 {
display:block;
}
		</style>
		<br><br><br>
		<!-- <div id="footer" style="background-image:url(/img/footer.jpg);height:100px;" >  -->
		<div id="footer" style="height:100px;" >
		 
		<div class="row_3" align="center"  >
        <p style="color:#757575"><b>Copyright &copy; 2010-2011 turtleSEO. All rights reserved.</b><div style="padding-top:5px;"> <a href="/home/terms_conditions/" style="color:#757575;text-decoration:none;">Terms of Service</a>  <font  color="black">| </font> <a href="/home/privacy_policy/" style="color:#757575;text-decoration:none;">Privacy Policy</a> <font  color="black">| </font> <a href="/home/faq" style="color:#757575;text-decoration:none;">FAQ</a></p>
      <!-- 	<marquee ><img src="/img/turtles.png" border="0" width="30px" height="30px"></marquee> -->
    </div>
	</div>
	
		</div>
	</div>
<!-- start google code -->
<script type="text/javascript">


  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-1990734-54']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;

    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';

    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- end google code  -->
<?php echo $cakeDebug; ?>
<script>
Effect.Fade('message',{ duration: 3.0 });
</script>
</body>
</html>
