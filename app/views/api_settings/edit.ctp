<style type="text/css">
<!--
.style1 {
	color: #ffffff;
	font-weight: bold;
}
label {
width:180px;

}
input[type="text"],input[type="password"],textarea
{width:300px;
}
#left, #right  {
   width: 60.5%;
   margin: 1% 1% 0 10%;
}
#right {
	float: right;
	margin: 3% 5% 140% 0;
	width: 80%;
   background-color: #eee;
   border: 1px solid #999999;
}

table td { height:40px;}
-->
</style>
<?php echo $crumb;?>
<div align="center">
 <table background="/img/edit- API-setting.png" width="884px" height="81" >
<tr><td align="right" style="padding-right:20px;">&nbsp;
 </td></tr></table>
 </table>
<!--<img src="/img/edit- API-setting.png" alt="Edit API Settings">-->
<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px;">
	<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>
<div style="background:#fff; width:882px">
<table  border=0 align="center" width="882px" style="background:#fff">
<tbody>
<tr>
<td   valign="top" style=" display:none;">
<?php echo $this->element('menu',array('link_name' => 'list api')); ?>
</td>
<td  valign="top" align="left" >
<?php  echo $form->create('ApiSetting', array('action' => 'edit'));   ?>
<table border="0" align="center" cellpadding="0" cellspacing="0" style="padding-left:40px"  >
<!--<tr bgcolor="#003333" style="display:none;">
<td width="48%"   bgcolor="#ffffff"><span class="style1">&nbsp;Edit API : </span></td>
<td width="52%" bgcolor="#ffffff"><span class="style3"></span></td>
</tr>
<tr><td align="left" colspan="2">&nbsp;</td></tr>
-->
<tr style="display:none">
<td><label>Name:</label></td>
<td><?php echo $form->input('name',array('label' =>false,'options'=>$api_names,'disabled' => true,'id' =>'type'));?></td>
</tr>
<tr>
<td ><label>Email:*</label></td>
<td><?php echo $form->input('api_key',array('label' =>false,'size'=>60,'id' => 'key1'));?>
</tr>
<tr>
<td><label>Password:*</label>
<td><?php echo $form->input('api_password',array('label' =>false,'size'=>40,'type' => 'password','id' => 'key2'));?></td>
</tr>
<?php if($NameType!='Ping'){?>
<tr id="getThisHidden1" style="">
<td ><label>GA Profile ID : *  </label>
<td><?php echo $form->input('api_token',array('label' =>false,'size'=>40,'id' => 'key3')); ?> </td>
</tr>
<tr id="getThisHidden2" style="">
<td><label>URL : *  </label>
<td><?php echo $form->input('api_url',array('label' =>false,'size'=>40,'id' => 'api_url'));?></td>
</tr>
<?php } ?>
<tr id="getThisHidden3" style="">
<td ><label>Description:</label></td>
<td><?php echo $form->input('description',array('label' =>false,'rows'=>2));?></td>
</tr>
<tr>
<td><label>Active:</label></td>
<td><?php echo $form->input('active',array('label' =>false,'type'=>'checkbox'));?></td>
</tr>
<tr>
<td><?php echo $form->input('id', array('type'=>'hidden'));?> </td>
<td>
<!--<input type="submit" value="Save" onclick="return validate();">	<input type="button" value="Cancel" onclick="window.location='/api_settings/'" >-->
<input type="image" src="/img/save.png" alt="Save" onclick="return validate();"> <img src="/img/cancel.png" alt="Cancel" onclick="window.location='/api_settings/'" >
<?php //echo $form->end('Save');  ?>
</td>
</tr>
</table>
</td>

<!--<td>
<?php if($NameType!='Ping'){?>
<div id="right" style="padding-left: 10px">
<li>Name
<li>API Key
<li>API Password
<li>API Token
<li>Site URL
<li>Description
<li>Active
</div>
<?php }else{ ?>
<div id="right">
<li><strong>Name</strong>:Ping.fm
<li><strong>Developers API KEY :</strong>
<br /><span style=" font-size:10px">
<a href="http://ping.fm/developers/" target="_blank">To get/request free Developers API KEY Click Here</a></span>
<li><strong>Application Key :</strong>
<br /><span style=" font-size:10px">
<a href="http://ping.fm/key/" target="_blank">To get Application Key Click Here</a></span>
 </table>
<?php  } ?>
</td>-->

</tr>
<br />
</tbody>
</table>
</div>
</div>

<script>
api_name=document.getElementById('type');
if(api_name.value=='Google_Analytics')
{
		document.getElementById('f1').innerHTML='Email *';
		document.getElementById('f2').innerHTML='Password *';
		document.getElementById('f3').innerHTML='GA Profile ID *';
}else if(api_name.value=="Ping")
	{
		document.getElementById('f1').innerHTML=' Developers API KEY';
		document.getElementById('f2').innerHTML='Application Key';
		//document.getElementById('f3').innerHTML='Token ';
		document.getElementById('getThisHidden1').style.display='none';
		document.getElementById('getThisHidden2').style.display='none';

	}
</script>

<script>
function validate()
{	
		key1=document.getElementById('key1').value.replace(/(\s+$)|(^\s+)/g, '');
		key2=document.getElementById('key2').value.replace(/(\s+$)|(^\s+)/g, '');
		key3=document.getElementById('key3').value.replace(/(\s+$)|(^\s+)/g, '');
		type=document.getElementById('type').value.toLowerCase();
		api_url=document.getElementById('api_url').value;
		if( (type=='google_analytics') &&  (key1=="" ||  key2=="" || api_url=="" || api_url=="") )
		{
			alert("Please Fill Required Fields");
			return false;
		}
		else if( (type=='google_analytics') )
		{
			 var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
		    if(!pattern.test(key1))         
			{
				alert("Please Enter Correct Email Address");
				return false;
			}	
			if(isNaN(key3))         
			{
				alert("Please Enter Numeric Value In GA Profile ID");
				return false;
			}	
 
		}
		else if((type=='ping') &&  (key1=="" ||  key2=="" ))
		{
			alert("Please Fill Required Fields");
			return false;
		}
		else
		return true;	

}
</script>



