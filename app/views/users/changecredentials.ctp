<?php
	//echo $html->css('style',false);
?>
<?php // echo $crumb; ?>
<?php  
	  $postfix = "Email";
	  if ($id==1)
	  	$postfix = "Username/Email";
	  if ($id==7)
	  	$postfix = "Nickname";	
	  if ($id==8)
	  	$postfix = "Shoutem Network Name";	
?>



<h3 style="display:inline">Change Network Credentials</h3>

<div align="center" style="padding-top:40px">
<p>Please Enter Your New <?php echo ucwords($network['Network']['network_name']); ?> Details</p>
<form action='/users/changecredentials/<?php echo $id; ?>' method='post'>
<table>
<tr><td align="left"><label>Your <?php echo ucwords($network['Network']['network_name']) . ' ' . $postfix; ?>:</label></td>
<td align="left"><input type="text" name="data[username]" style="width: 200px;" /></td></tr>
<tr><td align="left"><label>Your <?php echo ucwords($network['Network']['network_name']); ?> Password:</label></td>
<td align="left"><input type="password" name="data[password]" style="width: 200px;" /></td></tr>
<tr><td></td><td align="left"><input type="image" src="/img/go.png" alt="Change" /></td></tr>
</form>
</table>
</div>
<style>
input[type="text"],input[type="password"] {
width: 200px;
background-color:#FFFFFF;
font-size:16px;
}
</style>