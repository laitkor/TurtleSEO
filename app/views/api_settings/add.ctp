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
   width: 50.5%;
   margin: 1% 1% 0 10%;
}
#right {
   float: right;
   margin: 11% 1% 23% 0;
   padding-top:15px;
	width: 77.5%;
   background-color: #eee;
   border: 1px solid #999999;
}

.style1 {
	color: #ffffff;
	font-weight: bold;
}
.style3 {color: #006633}
-->
</style>
<?php echo $crumb; ?>
<div align="center">
<table background="/img/Add-API.png" width="884px" height="81" >
<tr><td align="right" style="padding-right:20px;">&nbsp;
 </td></tr></table>
</table>
<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
	<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>
<table width="882px" align="center" border="0" style="background:#fff" >
  <tbody>
      <td  align="center" valign="top">
      <?php  echo $form->create('ApiSetting', array('action' => 'add'));   ?>
	  <div align="left"><?php if(isset($_SESSION[api_message])) echo $_SESSION[api_message]; unset($_SESSION[api_message]); ?></div>
      <table align="center" border="0" style="background:#fff">
        <tr >
          <td><h3 style="display:none;">Add API: </h3></td>
		  <td ><span class="style3"></span></td>
        </tr>
		<tr><td colspan="2">&nbsp; </td></tr>
        <tr style="display:none">
          <td  bgcolor="#ffffff" style="padding-left:50px"><strong>&nbsp; <label id="f1">Name: </label></strong></td>
        <td bgcolor="#ffffff">
		<?php 
		echo $form->input('name',array('label' =>false,'options'=>$api_names,'onchange' =>'change_label(this.value)','id' =>'type'));
		?>
		</td>
        </tr>
        <tr>
          <td  bgcolor="#ffffff" style="padding-left:50px"><strong>&nbsp;<label id="f1">Email*:</label></strong></td>
          <td bgcolor="#ffffff"><?php echo $form->input('api_key',array('label' =>false,'size'=>40,'id' => 'key1'));?></td>
        </tr>
        <tr>
          <td bgcolor="#ffffff" style="padding-left:50px"><strong>&nbsp;<label id="f2">Password*: </label></strong></td>
          <td bgcolor="#ffffff"><?php echo $form->input('api_password',array('label' =>false,'size'=>40,'type' => 'password','id' => 'key2'));?></td>
        </tr>
        <tr id="getThisHidden1" style="">
          <td   bgcolor="#ffffff" style="padding-left:50px"><strong>&nbsp;<label id="f3">GA Profile ID*: </label></strong></td>
          <td bgcolor="#ffffff"><?php echo $form->input('api_token',array('label' =>false,'size'=>40,'id' => 'key3'));?></td>
        </tr>
        <tr id="getThisHidden2"  style="">
          <td  bgcolor="#ffffff" style="padding-left:50px"><strong>&nbsp;<label id="f3">URL*: </label></strong></td>
          <td bgcolor="#ffffff"><?php echo $form->input('api_url',array('label' =>false,'size'=>40,'id' => 'api_url'));?></td>
        </tr>
        <tr id="getThisHidden3" style="">
          <td  bgcolor="#ffffff" style="padding-left:50px"><strong>&nbsp;<label id="f3">Description: </label></strong></td>
          <td bgcolor="#ffffff"><?php echo $form->input('description',array('label' =>false,'rows' =>2));?></td>
        </tr>
        <tr>
          <td bgcolor="#ffffff" style="padding-left:50px"><strong>&nbsp;<label id="f3">Active: </label></strong></td>
       <td bgcolor="#ffffff"><?php echo $form->input('active',array('label' =>false,'type'=>'checkbox','checked' =>true));?></td>
        </tr>
        <tr>
          <td bgcolor="#ffffff" style="padding-left:50px">&nbsp;</td>
          <td bgcolor="#ffffff"><!--<input type="submit" value="Add" onclick="return validate()">-->
		  <input type="image" src="/img/add.png" alt="Add">
            <img src="/img/cancel.png" alt="Cancel" onclick="window.location='/api_settings/'">
           
         </td>
        </tr>
      </table>
	   </form>
      </td>
	  <td width="300" >
 <table  id="right" style=" display:none; ">
 <tr><td>Name:Ping.fm</td></tr>
 <tr><td>
Developers API KEY</td></tr> <tr><td style=" font-size:10px">
<a href="http://ping.fm/developers/" target="_blank">To get/request free Developers API KEY Click Here</a></td></tr> <tr><td>
Application Key</td></tr> <tr><td style=" font-size:10px">
<a href="http://ping.fm/key/" target="_blank">To get Application Key Click Here</a></td></tr> <tr><td>
 </table>
</td>
    </tr>
  </tbody>
</table>
</div>


<script>
function  change_label(value)
{
	value=value.toLowerCase();

	if(value=="google_analytics")
	{	
		document.getElementById('f1').innerHTML='Email *';
		document.getElementById('f2').innerHTML='Password *';
		document.getElementById('f3').innerHTML='GA Profile ID *';
		document.getElementById('getThisHidden1').style.display='';
		document.getElementById('getThisHidden2').style.display='';
		document.getElementById('right').style.display='none';

	}
	else if(value=="ping")
	{
		document.getElementById('f1').innerHTML=' Developers API KEY';
		document.getElementById('f2').innerHTML='Application Key';
		document.getElementById('f3').innerHTML='Token ';
		document.getElementById('getThisHidden1').style.display='none';
		document.getElementById('getThisHidden2').style.display='none';
		document.getElementById('right').style.display='';

	}
	else{}
}

function validate()
{
		key1=document.getElementById('key1').value.replace(/(\s+$)|(^\s+)/g, '');
		key2=document.getElementById('key2').value.replace(/(\s+$)|(^\s+)/g, '');
		key3=document.getElementById('key3').value.replace(/(\s+$)|(^\s+)/g, '');
		type=document.getElementById('type').value.toLowerCase();
		api_url=document.getElementById('api_url').value;
		if( (type=='google_analytics') &&  (key1=="" ||  key2=="" || key3=="" || api_url=="") )
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
