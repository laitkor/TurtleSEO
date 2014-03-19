<style type="text/css">
textarea,input[type="text"]
{
	width:50%;
}
</style>
<?php echo $crumb; ?>
 <table background="/img/add-category.png" width="884px" height="81" >
<tr><td align="right" style="padding-right:20px;">&nbsp;
 </td></tr></table>
<div style="backgroung:#FFFFFF;" align="center">
<!--<img src="/img/add-category.png" alt="Add Category" >-->

<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
		<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>

<!--<h2  style="padding-left:5px;" >Add New Category</h2>-->

<div align="left" style="background:#fff;width:882px">
<br />
<!--<ul class="actions" style="text-align:left; padding-right:10px;">
  <li style="padding-top:5px"><?php echo $html->link('List Main Category', '/Maincats/')?></li>
  <li style="padding-top:5px"><?php echo $html->link('Articles', '/articles/')?></li>
</ul>
--></div>

<div style="background:#fff;width:882px">
<form action="<?php echo $html->url('/maincats/add'); ?>" method="post">
<div align="left" align="left"><font color="red">
<?php if (isset($name_error)) echo $name_error; ?>
</font></div>
  <table width="723"  border="0"   >
    <tr>
      <td width="214" align="left"><strong> Category Name:</strong></td>
      <td width="493" align="left" class="required">
	  <?php echo $form->input('name', array('size' => '50','label'=>false));?> </td>
    </tr>
    <tr>
      <td align="left"><strong> URL: </strong></td>
      <td align="left"><?php echo $form->input('url', array('size' => '60','label'=>false));?> </td>
    </tr>
    <!--
	<tr>
      <td align="left"><strong> Edit Name: </strong></td>
      <td align="left"><?php echo $form->input('edb_name', array('size' => '60','label'=>false));?> </td>
    </tr>
    <tr>
      <td align="left"><strong> Tips: </strong></td>
      <td align="left"><?php echo $form->input('tips', array('size' => '60','label'=>false));?></td>
    </tr>
   <tr style="display:none;">
      <td align="left"><strong> Footer: </strong></td>
      <td align="left"><?php echo $form->input('footer', array('size' => '60','label'=>false,'style' => 'width:50%','value' => 'default'));?> </td>
    </tr>
    <tr>
      <td align="left"><strong> Meta Keywords: </strong></td>
      <td align="left"><?php echo $form->input('meta_keywords', array('size' => '60','label'=>false));?> </td>
    </tr>
    <tr>
      <td align="left"><strong> Meta Description: </strong></td>
      <td align="left"><?php echo $form->textarea('meta_desc', array('cols' => '40', 'rows' => '5','label'=>false));?> </td>
    </tr>
    <tr>
      <td align="left"><strong> Short Name: </strong></td>
      <td align="left"><?php echo $form->input('short_name', array('size' => '60','label'=>false));?> </td>
    </tr>
<tr> <td colspan="2">&nbsp; </td></tr>
-->
    <tr>
	<td align="left"><strong>&nbsp;</strong></td>
	<td class="submit" colspan="2" align="left">
		<?php //echo $form->button('Submit', array('type'=>'submit')); ?>
		<input type="image" src="/img/submit.png" alt="Submit">
	  </td>    
</tr>
  </table>
</form>
</div>
