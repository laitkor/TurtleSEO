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
width: 130px;
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
margin-left: 120px;
margin-top: 5px;
width: 100px;
}

br{
clear: left;
}
fieldset {
border: 1px solid #CCA383;
width:70%;
background: #F7F7F7;
padding: 3px;


}

fieldset legend {
background: #CCA383;
padding: 3px;
font-weight: bold;


}
</style>
<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
	<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>

<table style="width: 100%;">
		<tbody>
			<tr>
				<td width="238" valign="top" style="width: 15em;">
					<?php echo $this->element('menu',array('link_name' => 'change plan')); ?>				</td>
				<td width="981" valign="top" >
					<?php echo $crumb; ?>
					<form method="post" action="/users/change_plan/">
						<fieldset>
									<legend>Change Plan</legend>
									<br>
									<span style="color:#009966;padding:10px"><?php if(isset($mess))echo $mess  ;?></span>
										<br>
									<br><label >Select Plans</label>
									<p><?php echo $form->input('plan_type',array('options' =>$plans,'label' =>false,'default' =>'select'));?><span id="mess"></span></p>
									<p>
										<input type="submit" id="submitbutton" value="change plan" onclick="return validate()" />
										<input type="button" value="cancel" onclick="window.location='/users/plans/'"  style="width:120px">
									</p>
					</fieldset>
				</form>	
			  </td>
			</tr>
	</tbody>
</table>


<script>								
function validate()
{
	
	if(document.getElementById('plan_type').value=='select')
	{
		document.getElementById('mess').innerHTML='<font color="red">Please Select Plan First.</font>';
		return false;	
	} 
	else
	return true;
}
</script>

