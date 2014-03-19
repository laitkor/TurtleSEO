<?php
	//echo $html->css('style',false);
?>
<?php //echo $crumb; ?>
<h3 style="display:inline">Add Network</h3>
<div align="center" style="padding-top:40px">

<p>Please Enter Your LinkedIn Details</p><br />
<form action="/networks/linkedin/" method="post">
<table>
<tr><td align="left"><label>Your LinkedIn Email:</label></td><td><input type="text" name="data[username]" style="width: 200px;" /></td></tr>
<tr><td align="left"><label>Your LinkedIn Password:</label></td><td><input type="password" name="data[password]" style="width: 200px;" /></td></tr>
<tr><td></td><td align="left"><input type="image" src="/img/add.png" alt="Add" /></td></tr>
</table>
</form>
</div>
<style>
input[type="text"],input[type="password"] {
width: 200px;
background-color:#FFFFFF;
font-size:16px;
}
</style>