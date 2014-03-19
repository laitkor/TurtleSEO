<style>
.style1 {
	color: #FFFFFF;
	font-weight: bold;
	
	
}
.style3 {color: #006633}
#left, #right  {
   width: 60.5%;
   margin: 1% 0 1% 10%;
}
#right {
   margin: 3% 10% 10% 0;
   width: 100%;
   padding-left:10px;
}
input[type='text'] {width:350px;}
input[type='password'] {width:350px;}
</style>
     <?php echo $crumb; ?><br>

<div align="center">
 <table background="/img/add-blog.png" width="884px" height="81" >
<tr><td align="right" style="padding-right:20px;">&nbsp;
 </td></tr></table>
<!--<img src="/img/add-blog.png" alt"Add a Blog">-->
<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
	<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>

 <table width="882px" border=0 style="align: center;background:#fff; padding-left:10px">
 <tbody>
<tr> <td colspan="2">  <!--   <h3>Add a Blog</h3>-->
</td></tr>
<tr>
      <td height="28" colspan="2" bgcolor="#FFFFFF" align="left"><span class="style1" style="color:#CC6600">&nbsp;You have added <?php echo $user_blog." of " .$total ; ?> blogs. Remaining blogs - <?php echo $total-$user_blog; ?>. 
	  <?php  if($_SESSION['user_plantype'] !='gold'){ ?>
     To add more blogs: <a href="/users/plans/" >Step Up Here</a></span>&nbsp;
	 <?php } ?>
	 </td>
      </tr>
  <tr>
   <td width="238" valign="top" style="width: 15em;display:none;">
   <?php echo $this->element('menu',array('link_name' => 'add blog')); ?>				</td></tr><tr>

   <td valign="top" align="left">
   <?php  echo $form->create('WpServer', array('url' => '/blogs/add/'));   ?>
<?php 
echo $form->error('name', null, array('class' => 'error-message')); 
echo $form->error('wp_admin_id', null, array('class' => 'error-message')); 
echo $form->error('wp_admin_password', null, array('class' => 'error-message')); 
echo $form->error('rpc_url', null, array('class' => 'error-message')); 
?>
   <table width="100%"  border="0" cellpadding="0" cellspacing="0" align=center  >
    <tr bgcolor="#003333" style="display:none">
     <td height="19" colspan="2" bgcolor="white"><span class="style1">Add Blog : </span><span class="style3"></span></td>
    </tr>
    
	 
    <tr>
     <td width="30%" height="28" bgcolor="#FFFFFF"><strong>&nbsp;Domain Name URL*: </strong></td>
     <td width="70%" bgcolor="#FFFFFF" style="padding-top:10px;"><?php echo $form->input('name',array('label' =>false,'error'=>false,'size'=>20));?></td>
    </tr>
    <tr>
     <td height="27" bgcolor="#FFFFFF"><strong>&nbsp;Admin Username*: </strong></td>
     <td bgcolor="#FFFFFF"><?php echo $form->input('wp_admin_id',array('label' =>false,'error'=>false,'size'=>20));?></td>
    </tr>
    <tr>
     <td height="26" bgcolor="#FFFFFF"><strong>&nbsp;Admin Password*: </strong></td>
     <td bgcolor="#FFFFFF"><?php echo $form->input('wp_admin_password',array('label' =>false,'error'=>false,'size'=>20,'type' => 'password'));?></td>
    </tr>
    <tr>
     <td height="25" bgcolor="#FFFFFF"><strong>&nbsp;RPC URL*: </strong></td>
     <td bgcolor="#FFFFFF"><?php echo $form->input('rpc_url',array('label' =>false,'error'=>false,'size'=>25));?></td>
    </tr>
    <tr>
     <td height="26" bgcolor="#FFFFFF"><strong>&nbsp;Active: </strong></td>
     <td bgcolor="#FFFFFF"><?php echo $form->input('active',array('label' =>false,'type'=>'checkbox'));?></td>
    </tr>
    <tr>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF">
	 <!--
      <input type="submit" value="Add">
      <input type="button" value="Cancel" onclick="window.location='/blogs/'">	
	 --> 
	 <input type="image" src="/img/add.png" alt="Add">
	 <img src="/img/cancel.png" alt="Cancel" onclick="window.location='/blogs/'">	
  							</td>
    </tr>
   </table>  </form>	
  </td>
  <td width="30%">
  <table id="right"><tr><td align="left">
<li>Domain Name
 <p class="grey10">The domain name of your blog. Example: <i><b>http://inkopia.com</b></i></p></li></td></tr><tr><td align="left">
<li>Admin Username
 <p class="grey10">The user with the Administrator privileges. Example: <i><b>admin</b></i></p></li></td></tr><tr><td align="left">
<li>Admin Password
 <p class="grey10">The password of the user with the Administrator privileges. Example: <i><b>secret</b></i></p></li></td></tr><tr><td align="left">
<li>RPC URL
 <p class="grey10">The RPC URL. Example: <i><b>http://inkopia.com/xmlrpc.php</b></i></p></li></td></tr><tr><td align="left">
<li>Active
 <p class="grey10">Uncheck the check box to inactivate the blog edits from turtleSEO&trade;.</p></li></td></tr><tr><td align="left">
 <br><p class="grey10">Please <a href='/users/support'>contact us</a> if you are facing difficulties in making this work.</p></li></td></tr> 
 </table>
  
  </td>
 </tr>
</tbody>
</table>
</div>