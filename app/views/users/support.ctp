<style>
textarea
{
width:310px;
height:100px;
}
</style>
<?php
//SOURCE : http://www.huddletogether.com/projects/lightbox/
//echo $javascript->link('lightbox',false); 
//echo $html->css('lightbox',false);
?>
<?php echo $crumb; ?>
<div align="center"><!--<img src="/img/support.png" alt="Support">-->
 <table background="/img/support.png" width="884px" height="81" >
<tr><td align="right" style="padding-right:20px;">&nbsp;
 </td></tr></table>
<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
	<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>
<div align="left" style="background:#fff;width:882px"><?php if(isset($error_msg))echo "<font color='red'>$error_msg</font>";  ?></div>
<table width="882px" style="background:#FFFFFF">
		<tbody>
			
			<tr>
				<td width="238" height="383" valign="top" style="width: 15em;display:none;">
				<?php echo $this->element('menu',array('link_name' => 'support')); ?>				</td>
			  <td width="871" valign="top"  align="center">
			 <div  align="left">			</div>
	<form action="/users/support/"  method="post">
	  <table cellspacing="0" cellpadding="2" border="0" style="background:#fff">
		<tbody><tr style="display:none;">
			<td align="left" colspan="2" ><br>			</td>
		</tr>
		
		<tr>
			<td height="23" colspan="2" align="center" >
			
			<div id="mess1" style="color:#FF0000" align="left">			</div>			</td>
		</tr>
		
		<tr style="display:none"> 
			<td height="30" align="left" valign="top" ><h3 >Support</h3></td>
			<td width="462" valign="top">&nbsp;</td>
		</tr>
		<tr>
		  <td height="33" align="left" valign="top" style="padding-left:50px"><strong> Type:&nbsp;</strong></td>
		  <td valign="top" align="left">
		  <select  name="data[query_type]">
		    <option value="Plan Section" <?php if($qtype == "Plan Section" ) echo 'selected="selected"'; ?> >Plan Section</option>
		    <option value="Payment Section"  <?php if($qtype == "Payment Section") echo 'selected="selected"'; ?>>Payment Section</option>
		    <option value="Upgrade Section"  <?php if($qtype == "Upgrade Section") echo 'selected="selected"'; ?>>Upgrade Section</option>
		    <option value="Suggestion"  <?php if($qtype == "Suggestion") echo 'selected="selected"'; ?>>Suggestion</option>
		   <option value="Report Abuse"  <?php if($qtype == "Report Abuse") echo 'selected="selected"'; ?>>Report Abuse</option>
		    </select>		  </td>
		</tr>
		<tr> 
			<td width="169" height="66" align="left" valign="top" style="padding-left:50px"><strong> Description*:&nbsp;</strong></td>
			<td width="462" valign="top" align="left">	
				<textarea class="text" cols="15" rows="12" name="data[desc]" id="desc"><?php if(isset($des)) echo $des; else echo ""; ?></textarea>			</td>
		</tr>

		
		<tr class="usual">
			<td height="30" align="left" valign="top" style="padding-left:50px"><strong> Are You Human*:&nbsp;</strong>&nbsp;</td>
			<td align="left" style="padding-top:2px"><?php $recaptcha->display_form('echo'); ?>
			<!--<a href="/users/support/" >Try Another</a>-->
&nbsp;</td>
		</tr>
		

		<tr valign="bottom" align="left" >
		  <td height="40">&nbsp;</td>
		  <td><span class="usual"><span class="submit">
		    <input name="submit" type="image" src="/img/send.png" alt="Send" onclick="return validate();" />
		  </span></span></td>
		  </tr>
		<tr valign="top" align="left">
			<td height="36">&nbsp;</td>
			<td><!--<strong>asterisk (*) - required fields</strong>--></td>
		</tr>
		<tr valign="top" align="left">
			<td height="42" colspan="2">&nbsp;</td>
		</tr>
		</tbody></table>
		</form>

	  		  </td>
			</tr>
	</tbody>
</table>
</div>
<script>
function validate()
{
		
		desc=document.getElementById('desc');
	
		div=document.getElementById('mess1');
		mess="";	 
		if( desc.value.replace(/(\s+$)|(^\s+)/g, '')=="" ) 
		{
			mess+="Please enter description<br>";
		}
		
	
		div.innerHTML=mess;	
		if(mess!="")
		return false;
		else
		return true;

}
</script>