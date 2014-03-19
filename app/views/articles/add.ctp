<style>
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
input[type="text"],input[type="password"],textarea
{width:300px;
font-size:12px;
}
textarea
{width:400px;
}
.style3 {color: #006633}
</style>

<table border="0" width="100%"  cellpadding="0" cellspacing="0"> <tr><td valign="bottom">
<?php echo $crumb; ?> 
</td><td width="120" align="center"> <a href="javascript: openwindow('article');" title="Help Video for articles.">
<img border="0" src="/img/help-videos.png">
</a></td></tr>
</table>

<div align="center">
 <table background="/img/add-article.png" width="884px" height="81" >
<tr><td align="right" style="padding-right:20px;">&nbsp;
 </td></tr></table>
 </table>
<!--<img src="/img/add-article.png" alt="Add Articles">-->
<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
		<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>

<table align="center" width="882px" style="background:#fff">
<tbody>
<tr>
<td width="253" height="264" valign="top" style="width: 15em;display:none;">
<?php echo $this->element('menu',array('link_name' => 'add article')); ?></td>
<td valign="top" align="left">
<?php
echo $javascript->link('prototype',false);
echo $javascript->link('scriptaculous',false); 
echo "<script src=/ckeditor".DS."ckeditor.js"."></script>";
echo $form->create('Article', array('action' => 'add'));
?>
<?php 
echo $form->error('title', null, array('class' => 'error-message')); 
echo $form->error('meta_keywords', null, array('class' => 'error-message')); 
echo $form->error('meta_desc', null, array('class' => 'error-message')); 
echo $form->error('content', null, array('class' => 'error-message')); 
?>

<table height="211" border="0" align="center"  >

<!--
<tr  align="left">
<td height="25" colspan="3" ><h3>Add Article</h3></td>
</tr>
-->
<tr valign="top">
<td height="34" colspan="3" valign="top" bgcolor="#FFFFFF"  align="left">
<table border="0" >
<tr>
<td    align="left" valign="top"><b>Title*:</b>&nbsp;&nbsp;</td>
<td  valign="middle"><?php echo $form->input('title',array('label' => false,'size' =>'60','error'=>false)); ?></td>
<td  valign="middle">&nbsp;</td>
<td   valign="top" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Category: </b>&nbsp;&nbsp;</td>
<td  valign="middle" ><select id="maincats" name="data[Article][maincats_id]">
  <?php
//filling maincategories and making selected for articles main cat
foreach($data as $key => $value)
echo "<option value=$key >$value</option>";
?>
</select>  &nbsp;&nbsp;
  <!--<input type="button" value="Add Category"  onclick="window.location='/maincats/index/'">--></td></tr>
</table></td>
</tr>


<tr valign="top" align="left">
<td width="436" bgcolor="#FFFFFF" ><b>Meta Keywords:</b> </td>
<td width="521" colspan="2" bgcolor="#FFFFFF" ><span> <b>Meta Description:</b> </span>  <span id="limiter_text" > 100 Characters Left</span></td>
</tr>
<tr align="left">
<td height="20" valign="top" bgcolor="#FFFFFF"> <?php echo $form->input('meta_keywords',array('label' => false,'rows' => '5', 'cols' => '30','error'=>false)); ?></td>
<td colspan="2" valign="top" bgcolor="#FFFFFF"><?php echo $form->input('meta_desc',array('label' => false,'rows' => '5', 'cols' => '50','maxlength' => '100','onkeyup'=>'limiter()','error'=>false)); ?></td>
</tr>
<tr align="left">
<td  colspan="3" valign="bottom" bgcolor="#FFFFFF" ><b>Description*:</b>  <span style=" font:Arial, Helvetica, sans-serif; font-size:10px; color:#999999; padding-bottom:0px;"> Standard Format: {{A {{simple|basic}} example|An uncomplicated scenario|The {{simplest|trivial|fundamental|rudimentary}} case|My {{test|invest{{igative|igation}}}} case}} to illustrate the {{function|problem}} </span></td>
</tr>
<tr valign="top" align="left">
<td height="28" colspan="3" bgcolor="#FFFFFF"><?php echo $form->input('content',array('label' => false,'rows' => '5', 'cols' => '80','error'=>false)); ?></td>
</tr>
<tr valign="top" align="left">
<td height="36" colspan="3" valign="bottom" bgcolor="#FFFFFF"> <?php echo $form->input('authors_id',array('label'=> false,'type' =>'hidden')); ?>	
<!--<input type="submit" value="Add" />  <input type="button" value="Cancel" onClick="window.location='/articles/'" />-->
<input type="image" src="/img/add.png" alt="Add" />&nbsp;&nbsp;<img src="/img/cancel.png" alt=="Cancel" onClick="window.location='/articles/'" />
</td>
</tr>
</table>
</form>


<script type="text/javascript">
//<![CDATA[

// This call can be placed at any point after the
// <textarea>, or inside a <head><script> in a
// window.onload event handler.

// Replace the <textarea id="editor"> with an CKEditor
// instance, using default configurations.
CKEDITOR.replace( 'ArticleContent' );
CKEDITOR.replace( 'ArticleTips' );
CKEDITOR.replace( 'ArticleFooter' );

//]]>

</script>

<script type="text/javascript">
/*
function checkBlank()
{

if(document.getElementsByName('data[Article][subcats_id]')[0].value=="")
{
alert("Please Select Sub Category First");
return false;
}
else if(document.getElementsByName('data[Article][subcattags_id]')[0].value=="")
{
alert("Please Select Sub Category Tags First");
return false;
}
else
{
document.forms[0].submit();
return true;
}
}
*/
</script>				
<!-- Script by hscripts.com -->
<script type="text/javascript">
//Edit the counter/limiter value as your wish
var count = "100";    
function limiter(){
var tex = document.getElementById('ArticleMetaDesc').value;
var len = tex.length;
if(len > count){
tex = tex.substring(0,count);
document.getElementById('ArticleMetaDesc').value =tex;
return false;
}
document.getElementById('limiter_text').innerHTML = count-len+' Characters left';
}

</script>
<!-- Script by hscripts.com -->
</td>
</tr>
</tbody>
</table>

</div>