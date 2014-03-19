<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
input[type='text']
{width:250px;}
input[type='password']
{width:250px;}
</style>
<style type="text/css">

label{
float: left;
width: 220px;
font-weight: bold;
font-size:15px;
}

input[type="text"],input[type="password"], textarea{
width: 400px;
margin-bottom: 5px;
background-color:#FFFFFF;
font-size:25px;
}

textarea{
width: 400px;
height: 50px;
font-weight:bold;
}

.boxes{
width: 1em;
}

#submitbutton{
margin-left: 180px;
width:100px;
}
#button
{
        width:100px;
}
br{
clear: left;
}
zzzfieldset {
border: 1px solid white;
width: 60%;
background: #F7F7F7;
padding: 3px;
margin-left:25%;
background: #ffffff;

}
fieldset {
   border: 1px solid white;
   #margin-left:25%;
}

fieldset legend {
background: #ffffff;
padding: 3px;
font-weight: bold;


}
option {
font-size:16px;
font-weight:bold;
background-color:#ffffff;
}
</style>
<style type="text/css">
<!--
.brown32 {font-family:helvetica,arial; font-size:32px; font-weight:bold; color: #F8995A;}
label {font-family:helvetica,arial; font-size:16px; font-weight:bold; color: #666666;}
.grey10 {font-family:arial; font-size:12px; font-weight:normal; color: #999999;}
.cat1, .cat2, .cat3 { margin: 0 auto; width: 70px; }
#left, #right  {
   float: left;
   width: 50.5%;
   margin: 1% 0 1% 15%;
   padding: 1%;
   #background-color: #9cf;
   color: #000;
}
#right {
   float: right;
   margin: 11% 1% 1% 0;
   width: 26.5%;
   background-color: #eee;
   border: 1px solid #999999;
}

-->
</style>

<div align="center">
<table style="width: 100%;">
 <tbody>
  <tr>
   <td width="238" valign="top" style="width: 15em;display:none;">
    <?php echo $this->element('menu',array('link_name' => 'blogs')); ?>				</td>
   <td width="981" valign="top" align="left">
    <?=$form->create('WpServer', array('action' => 'edit'));   ?>
    <table width="46%" border="0" cellpadding="0" cellspacing="0"  >
     <tr>
      <td width="37%" height="26" colspan="2" ><?php echo $crumb; ?></td>
     </tr>
     <tr>
      <td width="37%" height="32" bgcolor="#FFFFFF"><strong>Blog ID :</strong></td>
      <td width="63%" bgcolor="#FFFFFF"> <input type="text"  size=5 disabled="disabled"  value="<?php echo $this->data['WpServer']['id'] ?>" ></td>
     </tr>
     <tr>
      <td height="19" bgcolor="#FFFFFF"><strong>Domain Name : </strong></td>
      <td bgcolor="#FFFFFF"><?php echo $form->input('name',array('label' =>false,'size'=>20));?></td>
     </tr>
     <tr>
      <td height="27" bgcolor="#FFFFFF"><strong>Admin Username : </strong></td>
      <td bgcolor="#FFFFFF"><?php echo $form->input('wp_admin_id',array('label' =>false,'size'=>20));?></td>
     </tr>
     <tr>
      <td height="27" bgcolor="#FFFFFF"><strong>Admin Password : </strong></td>
      <td bgcolor="#FFFFFF"><?php echo $form->input('wp_admin_password',array('label' =>false,'size'=>20,'type' => 'password'));?></td>
     </tr>
     <tr>
      <td height="23" bgcolor="#FFFFFF"><strong>Rpc URL : </strong></td>
      <td bgcolor="#FFFFFF"><?php echo $form->input('rpc_url',array('label' =>false,'size'=>25));?></td>
     </tr>
     <tr>
      <td height="25" bgcolor="#FFFFFF"><strong>Active : </strong></td>
      <td bgcolor="#FFFFFF"><?php echo $form->input('active',array('label' =>false,'type'=>'checkbox'));?>&nbsp;</td>
     </tr>
     <tr>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <?php echo $form->input('id', array('type'=>'hidden'));?>
      <td bgcolor="#FFFFFF">
       <input type="submit" value="Save"><input type="button" value="Cancel" onclick="window.location='/wp_servers/'">
    </form>
    <?php //echo $form->end('Save');  ?></td>
    </tr>
</table>
</div>
</td>
</tr>
</tbody>
</table>
