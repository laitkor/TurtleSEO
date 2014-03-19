<style type="text/css">
label{
float: left;
font-weight: bold;
font-size:15px;
width:150px;
}
<!--
#left, #right  {
   width: 50.5%;
   margin: 1% 0 1% 10%;
}
#right {
   margin: 3% 10% 10% 0;
   width: 100%;
   padding-left:10px;
}
-->
</style>
     <?php echo $crumb; ?><br>

<div align="center">
 <table background="/img/edit-blog.png" width="884px" height="81" >
<tr><td align="right" style="padding-right:20px;">&nbsp;
 </td></tr></table>
<!--<img src="/img/edit-blog.png" alt="Edit Blog">-->
<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
	<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>
<table width="882px" border=0 style="align:center; background:#fff; padding-left:10px">
 <tbody>
<tr> <td colspan="2">  <!--   <h3>Edit Blog</h3>-->
</td></tr>
<tr>

   <td width="238" valign="top" style="width: 15em;display:none;">
    <?php echo $this->element('menu',array('link_name' => 'blogs')); ?>				</td>
   <td width="981" valign="top" align="left">
<!--    <h3 style="display:inline;">Blog Edit</h3>-->
      <p class="grey10"> Use this form to edit the RPC credentials of your blog</p>
    <?php echo $form->create('WpServer', array('url' => '/blogs/edit/'.$this->data['WpServer']['id']));   ?>
	<?php 
echo $form->error('name', null, array('class' => 'error-message')); 
echo $form->error('wp_admin_id', null, array('class' => 'error-message')); 
echo $form->error('wp_admin_password', null, array('class' => 'error-message')); 
echo $form->error('rpc_url', null, array('class' => 'error-message')); 
?>
    <table width="66%" border="0" cellpadding="0" cellspacing="0"  >
     <tr>
      <td height="9" colspan="2" ></td>
     </tr>
     <tr style="display:none">
      <td><label>Blog ID:</label></td>
      <td><input type="text"  size=5 disabled="disabled"  value="<?php echo $this->data['WpServer']['id'] ?>" ></td>
     </tr>
     <tr>
      <td><label>Domain Name*:</label></td>
      <td><?php echo $form->input('name',array('label' =>false,'error' =>false,'size'=>20));?></td>
     </tr>
     <tr>
      <td><label>Admin Username*:</label></td>
      <td><?php echo $form->input('wp_admin_id',array('label' =>false,'error' =>false,'size'=>20));?></td>
     </tr>
     <tr>
      <td><label>Admin Password*:</label></td>
      <td><?php echo $form->input('wp_admin_password',array('label' =>false,'error' =>false,'size'=>20,'type' => 'password'));?></td>
     </tr>
     <tr>
      <td><label>RPC URL*:</label></td>
      <td><?php echo $form->input('rpc_url',array('label' =>false,'error' =>false,'size'=>25));?></td>
     </tr>
     <tr>
      <td><label>Active:</label></td>
      <td><?php echo $form->input('active',array('label' =>false,'type'=>'checkbox'));?>&nbsp;</td>
     </tr>
     <tr>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <?php echo $form->input('id', array('type'=>'hidden'));?>
      <td bgcolor="#FFFFFF">
       <!--<input type="submit" value="Save"><input type="button" value="Cancel" onclick="window.location='/blogs/'">-->
	   <input type="image" src="/img/save.png" alt="Save">&nbsp;<img src="/img/cancel.png" alt="Cancel" onclick="window.location='/blogs/'">
   
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