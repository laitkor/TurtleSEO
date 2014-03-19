<?php
//SOURCE : http://www.huddletogether.com/projects/lightbox/
//echo $javascript->link('lightbox',false); 
//echo $html->css('lightbox',false);
?>
<style type="text/css">
<!--
.style3 {font-size: 14px}
input[type="text"],input[type="password"],textarea
{
width:300px;
font-size:14px;
}
textarea{
width:300px;
height:100px;
}

-->
</style>
<?php echo $crumb; ?>

<div align="center">
<!--<img src="/img/tell-a-frnd.png" />	-->
 <table background="/img/tell-a-frnd.png" width="884px" height="81" >
<tr><td align="right" style="padding-right:20px;">&nbsp;
 </td></tr></table>
<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
	<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
	<?php if(isset($error_msg))echo "<div align='left'><font color='red'>$error_msg</font></div>";  ?>
</div>


	<form action="/users/tell_friend"  method="post">
	  <table width="882px" cellspacing="0" cellpadding="2" border="0" style="background:#fff">
		<tbody>
        <tr style="display:none;">
			<td align="left" colspan="2" ></td>
		</tr>
		<tr>
			<td height="23" colspan="2" align="center" >
			<div id="mess1" style="color:#FF0000" align="left">	</div>			</td>
		</tr>
		<!--<tr> 
		  <td width="289" height="26" align="left" valign="top"><h3 style="display:inline">Tell a Friend</h3><br></td>
			<td ></td>
		</tr>-->
		<tr> 
			<td   height="26" align="left" style="padding-left:50px"><strong><span class="style3">Your name:</span>&nbsp;</strong></td>
			<td align="left"><input type="text" size="36"  name="data[name]"  value="<?php echo $name;  ?>"  readonly="true" ></td>
		</tr>
		<tr> 
			<td height="26" align="left" style="padding-left:50px"><strong> Your e-mail:&nbsp;</strong></td>
			<td align="left"><input type="text" size="36" value="<?php echo $email;  ?>" name="data[email]" readonly="true" /></td>
		</tr>
		<tr> 
			<td height="26" align="left" style="padding-left:50px"><strong>Friend's name:&nbsp;</strong></td>
			<td align="left"><input type="text" size="36" value="<?php if(isset($frndsname)) echo $frndsname; else echo ""; ?>" name="data[friend_name]" class="text"></td>
		</tr>
		<tr> 
			<td height="31" align="left" nowrap="" style="padding-left:50px"><strong> Friend's E-mail*:&nbsp;</strong></td>
			<td align="left"><input type="text" size="36" value="<?php if(isset($frndsemail)) echo $frndsemail; else echo ""; ?>"  name="data[friend_email]"  id="friend_email"></td>
		</tr>
		<tr> 
			<td height="124" align="left" valign="top" style="padding-left:50px"><strong>  Comment*:&nbsp;</strong></td>
			<td align="left">	

				<textarea class="text" cols="36" rows="8" name="data[comment]" id="comment" ><?php if(isset($comment)) echo $comment; else echo ""; ?></textarea>			</td>

		</tr>

		
		<tr valign="top">
			<td height="52" align="left" valign="top" style="padding-left:50px"><strong> Are You Human*:&nbsp;</strong>&nbsp;</td>
			<td align="left" ><?php $recaptcha->display_form('echo'); ?><!--<a href="/users/tell_friend/" >Try Another</a>-->
&nbsp;</td>
		</tr>
		

		<tr valign="bottom" align="left" >
		  <td height="34">&nbsp;</td>
		  <td>
		    <input name="submit" type="image" src="/img/send.png" alt="Send" onclick="return validate();" />
		 </td>
		  </tr>
		<tr valign="top" align="left">
			<td colspan="2" align="center"><p class="grey10"><br /><strong>PRIVACY NOTICE: We will not save or reuse your, or your friend's email address(es) for any other purpose.</strong></p>			</td>
		</tr>
		</tbody></table>
		</form>
</div>

<script>
function validate()
{
		email=document.getElementById('friend_email');
		comment=document.getElementById('comment');
	
		div=document.getElementById('mess1');
		var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
		mess="";	 
		if( email.value.replace(/(\s+$)|(^\s+)/g, '')=="" ) 
		{
			mess+="Please enter email<br>";
		}
		if(!pattern.test(email.value) && email.value !="" ) 
		{
			mess+="Please enter correct email<br>";
			
		}
		if( comment.value.replace(/(\s+$)|(^\s+)/g, '')=="" ) 
		{
			mess+="Please enter comment<br>";
		}
	
		div.innerHTML=mess;	
		if(mess!="")
		return false;
		else
		return true;

}
</script>
