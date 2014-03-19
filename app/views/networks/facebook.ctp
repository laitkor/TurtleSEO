<style>
input[type="text"],input[type="password"] {
width: 200px;
background-color:#FFFFFF;
font-size:16px;
}
</style>
<?php
	//echo $html->css('style',false);
?>
<?php //echo $crumb; ?>

<h3 style="display:inline">Add Network</h3>
<div align="center"  style="padding-top:40px">
<form action="/networks/facebook/" method="post">
<p>Please Enter Your Facebook Details</p>
<table>
<tr><td align="left"><label>Your Facebook Email:</label></td><td><input type="text" name="data[username]" style="width: 200px;" /></td></tr>
<tr><td align="left"><label>Your Facebook Password:</label></td><td><input type="password" name="data[password]" style="width: 200px;"/></td></tr>
<tr><td></td><td align="left"><input type="image" src="/img/add.png" alt="Add" /></td></tr>
</table>
</form>
</div>
