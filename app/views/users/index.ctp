<style>
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style3 {color: #006633}
</style>

<style type="text/css">

label{
float: left;
width: 180px;
font-weight: bold;
}

input, textarea{
width: 180px;
margin-bottom: 5px;
background-color:#CCCCCC;
font-size:17px;
}

textarea{
width: 180px;
height: 30px;
}

.boxes{
width: 1em;
}

#submitbutton{
margin-left: 180px;
margin-top: 5px;
width: 90px;
}

br{
clear: left;
}
fieldset {
border: 1px solid #CCA383;
width:80%;
background: #F7F7F7;
padding: 3px;


}

fieldset legend {
background: #CCA383;
padding: 3px;
font-weight: bold;


}
</style>
<table style="width: 100%;">
		<tbody>
			<tr>
				<td width="238" valign="top" style="width: 15em;display:none;">
					<?php echo $this->element('menu',array('link_name' => 'list profile')); ?>				</td>
				<td width="981" valign="top" align="left">
				<?php echo $crumb; ?>	
						<br><br><br>
						under construction
	  		  </td>
			</tr>
	</tbody>
</table>


<script>								
function validate()
{
	if(document.getElementById('UserPassword').value!=document.getElementById('confirm_pass').value)
	{
		//alert('Password and Confirm Password Field  not match');
		document.getElementById('mess').innerHTML='<font color="red">Password does not matched.</font>';
		return false;	
	} 
	else
	return true;
}
</script>

