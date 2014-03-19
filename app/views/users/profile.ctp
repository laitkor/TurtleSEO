<style>
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style3 {
	color: #006633
}
</style>
<style type="text/css">
label {
	float: left;
	width: 180px;
	font-weight: bold;
}
input[type="text"], input[type="password"], textarea {
	width: 300px;
	margin-bottom: 5px;
	background-color:#ffffff;
	font-size:17px;
}
textarea {
	width: 300px;
	height: 30px;
}
.boxes {
	width: 1em;
}
br {
	clear: left;
}
fieldset {
	border: 1px solid white;
	width:80%;
	/*background: #F7F7F7;*/
background: white;
	padding: 3px;
}
fieldset legend {
	background: white;
	padding: 3px;
	font-weight: bold;
}
</style>
<?php   echo $crumb;  ?>
<div align="center">
<!--<img src="/img/edit-profile.png" alt="Edit Profile" />-->
<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
  <?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
  <div id="message" >
    <?php $session->flash(); ?>
  </div>
  <?php } ?>
</div>
<div style="background:#FFFFFF; width:882px">
<table width="882px" >
<tbody>
<tr>
  <td valign="top" style="display:none;" colspan="2"><?php echo $this->element('menu',array('link_name' => 'edit profile')); ?></td>
</tr>
<tr>
<br />
<?php  echo $form->create('User', array('action' => 'profile','type' => 'file'));   ?>
<table style="background:#ffffff;" width="882px" valign="top" border="0">
  <tr>
    <td  valign="top" align="left" colspan="2" ><?php 									
									echo $form->error('User.password', null, array('class' => 'error-message')); 
									echo $form->error('User.email', null, array('class' => 'error-message')); 									
								?>
      <span id="messg1" ></span></td>
  <tr align="left">
    <td  colspan="2"></td>
  </tr>
  <tr>
    <td align="left" style="padding-left:50px"><strong>Email*: </strong></td>
    <td align="left"><?php echo $form->input('email',array('label' =>false,'size'=>20,'error'=>false));?></td>
  </tr>
  <tr>
    <td height="23" align="left" style="padding-left:50px"><strong>Password*: </strong></td>
    <td align="left"><?php echo $form->input('password',array('label' =>false,'size'=>20,'error'=>false,'maxlength' =>20));?></td>
  </tr>
  <tr>
    <td  align="left" style="padding-left:50px"><strong>Confirm Password*: </strong></td>
    <td align="left"><input type="password" id="confirm_pass" maxlength="20"></td>
  </tr>
  <tr>
    <td align="left" style="padding-left:50px"><strong>&nbsp;</strong></td>
    <td align="left"><!--<input name="submit" type="submit"  onclick="return validate()" value="Submit"  />
						  <input name="button" type="button"   onclick="window.location='/dashboards/'" value="Cancel" /></td>-->
      
      <input type="image" src="/img/submit.png" alt="Submit" onclick="return validate()">
      <img src="/img/cancel.png" alt="Cancel" onclick="window.location='/dashboards/'">
  </tr>
    </tr>
    </form>
  
    </td>
  
    </tr>
  
  <tr><br />
  </tr>
    </tbody>
  
</table>
</div>
</div>
<script type="text/javascript" language="javascript">
function validate()
{
  var why='';
  if(document.getElementById('email').value=='')
	{
		why+='<font color="red">Please enter your Email!</font><br>';
	}
  if(document.getElementById('UserUsername').value=='')
	{
		why+='<font color="red">Please enter your username!</font><br>';
	}	
	
  if(document.getElementById('UserPassword').value=='')
	{
		why+='<font color="red">Please enter your Password!</font><br>';
	}		
	
  if(document.getElementById('confirm_pass').value=='')
	{
		why+='<font color="red">Please enter your confirm password!</font><br>';
	}else{
	if(document.getElementById('UserPassword').value!=document.getElementById('confirm_pass').value)
	{
		why+='<font color="red">Password and confirm password donot match !</font><br>';
	} 
	} 
}
</script> 
