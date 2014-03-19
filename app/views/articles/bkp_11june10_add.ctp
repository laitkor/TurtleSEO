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
<?php echo $crumb; ?>
<table width="101%" height="277" style="width: 100%;">
<tbody>
<tr>
<td width="253" height="264" valign="top" style="width: 15em;display:none;">
<?php echo $this->element('menu',array('link_name' => 'add article')); ?>				</td>
<td width="911" valign="top" align="center">
<?php
echo $javascript->link('prototype',false);
echo $javascript->link('scriptaculous',false); 
echo "<script src=/ckeditor".DS."ckeditor.js"."></script>";
echo $form->create('Article', array('action' => 'add'));
?>


<table width="967" height="211" border="0"  >
<tr  align="left">
<td height="25" colspan="3" ><h3>Add Article</h3></td>
</tr>
<tr valign="top">
<td height="34" colspan="3" bgcolor="#FFFFFF">
<table width="909" border="0" >
<tr>
<td width="81" height="42" valign="top" align="left"><b>Title :</b></td>
<td width="332" valign="top"><?php echo $form->input('title',array('label' => false,'size' =>'60')); ?></td>
<td width="10" valign="top">&nbsp;</td>
<td width="87" valign="top"><b>Category : </b></td>
<td width="377" valign="top"><select   id="maincats" name="data[Article][maincats_id]">
<?php
//filling maincategories and making selected for articles main cat
foreach($data as $key => $value)
echo "<option value=$key >$value</option>";
?>
</select>&nbsp;&nbsp;<input type="button" value="Add Category"  onclick="window.location='/maincats/index/'"></td>
</tr>
</table></td>
</tr>


<tr valign="top" align="left">
<td width="436" bgcolor="#FFFFFF" ><b>Meta Keywords :</b> </td>
<td width="521" colspan="2" bgcolor="#FFFFFF" ><b>Meta Description : </b>
<input type="text" value="100" id="limiter_text" readonly size=3> </td>
</tr>
<tr align="left">
<td height="20" valign="top" bgcolor="#FFFFFF"> <?php echo $form->input('meta_keywords',array('label' => false,'rows' => '5', 'cols' => '30')); ?></td>
<td colspan="2" valign="top" bgcolor="#FFFFFF"><?php echo $form->input('meta_desc',array('label' => false,'rows' => '5', 'cols' => '50','maxlength' => '100','onkeyup'=>'limiter()')); ?></td>
</tr>
<tr align="left">
<td height="24" colspan="3" valign="bottom" bgcolor="#FFFFFF" ><b>Description :</b> </td>
</tr>
<tr valign="top" align="left">
<td height="28" colspan="3" bgcolor="#FFFFFF"><?php echo $form->input('content',array('label' => false,'rows' => '5', 'cols' => '80')); ?></td>
</tr>
<tr valign="top" align="left">
<td height="26" colspan="3" bgcolor="#FFFFFF"> <?php echo $form->input('authors_id',array('label'=> false,'type' =>'hidden')); ?>	
<input type="submit" value="Add" />  <input type="button" value="Cancel" onclick="window.location='/articles/'" /> </td>
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
var count = "100";   //Example: var count = "175";
function limiter(){
var tex = document.getElementById('ArticleMetaDesc').value;
var len = tex.length;
if(len > count){
tex = tex.substring(0,count);
document.getElementById('ArticleMetaDesc').value =tex;
return false;
}
document.getElementById('limiter_text').value = count-len;
}

</script>
<!-- Script by hscripts.com -->
</td>
</tr>
</tbody>
</table>

