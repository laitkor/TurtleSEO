<?php
//SOURCE : http://www.huddletogether.com/projects/lightbox/
//echo $javascript->link('lightbox',false); 
//echo $html->css('lightbox',false);
?>
<style type="text/css">
<!--
.style3 {font-size: 14px}
input[type="text"],input[type="password"],textarea
{width:300px;
font-size:14px;
}
textarea{
width:400px;
height:100px;
}

-->
</style>
<div  align="left">	<?php echo $crumb; ?>		</div>
<div id="left">
	<form action="/users/tell_friend"  method="post">
	  <table width="100%" cellspacing="0" cellpadding="2" border="0" >
		<tbody>
                 <tr style="display:none;">
			<td align="left" colspan="2" ></td>
		</tr>
		<tr>
			<td height="23" colspan="2" align="center" >
			
			<div id="mess1" style="color:#FF0000" align="left">			</div>			</td>
		</tr>
		<tr> 
			<td width="168" height="26" align="left" valign="top"><h3 style="display:inline">Tell a Friend</h3><br></td>
			<td width="386"></td>
		</tr>
		<tr> 
<<<<<<< .mine
			<td><label>Your name:</label></td>
			<td><input type="text" size="32"  name="data[name]"  value="<?php echo $name;  ?>"  readonly="true" ></td>
=======
			<td width="168" height="26" align="left"><strong><span class="style3">Your name:</span>&nbsp;</strong></td>
			<td width="386"><input type="text" size="36"  name="data[name]"  value="<?php echo $name;  ?>"  readonly="true" ></td>
>>>>>>> .r41776
		</tr>
		<tr> 
			<td><label>Your e-mail:</label></td>
			<td><input type="text" size="36" value="<?php echo $email;  ?>" name="data[email]" readonly="true" /></td>
		</tr>
		<tr> 
			<td><label>Friend's name:</label></td>
			<td>
				<input type="text" size="36" value="" name="data[friend_name]" class="text">			</td>
		</tr>
		<tr> 
			<td height="31" align="left" nowrap=""><strong> Friend's e-mail *:&nbsp;</strong></td>
			<td><input type="text" size="36"  name="data[friend_email]"  id="friend_email"></td>
		</tr>
		<tr> 
			<td height="124" align="left" valign="top"><strong>  Comment *:&nbsp;</strong></td>
			<td>	
<<<<<<< .mine
				<textarea class="text" cols="36" rows="8" name="data[comment]" id="comment">Hi {friend_name} - I thought you might be interested in seeing the research mechanism at this site http://<?php echo $_SERVER['SERVER_NAME'];?></textarea>			</td>
=======
				<textarea class="text" cols="30" rows="9" name="data[comment]" id="comment">Hi {friend_name} - I thought you might be interested in seeing the research mechanism at this site http://<?php echo $_SERVER['SERVER_NAME'];?></textarea>			</td>
>>>>>>> .r41711
		</tr>

		
		<tr valign="top">
			<td height="52" align="left" valign="top"><strong>  Are You Human *:&nbsp;</strong>&nbsp;</td>
			<td align="left" ><?php $recaptcha->display_form('echo'); ?><a href="/users/tell_friend/" >Try Another</a>
<?php if(isset($error_msg))echo "<font color='red'>$error_msg</font>";  ?>&nbsp;</td>
		</tr>
		

		<tr valign="bottom" align="left" >
		  <td height="34">&nbsp;</td>
		  <td>
		    <input name="submit" type="submit"  value="Send" onclick="return validate();" />
		 </td>
		  </tr>
		<tr valign="top" align="left">
			<td colspan="2"><p class="grey10"><strong>PRIVACY NOTICE: We will not save or reuse your, or your friend's email address(es) for any other purpose.</strong></p>			</td>
		</tr>
		</tbody></table>
		</form>
</div>
<div id="right">
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
