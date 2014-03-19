<?php
echo $javascript->link('prototype',false);
echo $javascript->link('scriptaculous',false); 
?>
<?php
$api_key = '43aa22f4b1294e1170b529f07bad0363';
$secret = '7acdf54b5e8ccc2907037651c30d6d17';
include_once 'facebook-platform/php/facebook.php';
$facebook = new Facebook($api_key, $secret); 
$user = $facebook->require_login(); 
?>

<div align="center">
<fieldset style="width:50%">
<legend><font size="+1" color="#006633"><b>Facebook Post</b></font></legend>
<table width="760" border="0">
  <tr>
    <td width="172" height="31">&nbsp;</td>
    <td width="578">&nbsp;</td>
  </tr>
  <tr>
    <td >Select Article ID : </td>
    <td>
   		<select name="data[id]" id="article">
		<?php   
			foreach($ids as $key => $value)
			{
				echo "<option value=$value>$value</option>";
			}
		?>
		</select>
   		<?php
	  	 echo $ajax->link('Go >>',array( 'controller' => 'articles', 'action' => 'article_desc' ), 
    							   array( 'update' => 'desc' ,'with'=> '$(\'article\').serialize()')
								   
						  );	
    	?></td>
  </tr>
  <tr>
    <td>Description : </td>
    <td><div id="desc">
      <textarea name="data[desc]" rows="4"  style="width:50%" id="descrip"></textarea>
    </div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td ><input type="button" value="Post"  onclick="publishPost(); return false;"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</fieldset>
</div>



<script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php/en_US" type="text/javascript"></script>
<script type="text/javascript">FB.init("43aa22f4b1294e1170b529f07bad0363");</script>
<script src="http://static.ak.facebook.com/js/api_lib/v0.4/XdCommReceiver.js" type="text/javascript"></script>

<script>
function publishPost() {
mess=document.getElementById('descrip').innerHTML; 
var message =mess; 
var attachment = '';
var action_links = '';
Facebook.streamPublish(message, attachment, action_links,'','','',true);

}
</script>