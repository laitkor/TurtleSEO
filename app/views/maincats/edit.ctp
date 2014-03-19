<style type="text/css">
textarea,input[type="text"]
{
	width:50%;
}
</style>
<?php echo $crumb; ?>
 <table background="/img/edit-category.png" width="884px" height="81" >
<tr><td align="right" style="padding-right:20px;">&nbsp;
 </td></tr></table>
<div style="backgroung:#FFFFFF;" align="center">
<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
	<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>
<div align="left" style="background:#fff;width:882px">
<br />
</div>

<div style="background:#fff;width:882px">
<?php
	echo $form->create('Maincat', array('action' => 'edit'));
?>

  <table width="723"  border="0"   >
  	<input  type="hidden" name="data[Maincat][id]"  value="<?php  echo $category_id; ?>" />
    <tr>
      <td width="214" align="left"><strong> Category Name:</strong></td>
      <td width="493" align="left" class="required">
	  <input  type="text" name="data[Maincat][name]"  value="<?php  echo $category_name; ?>" /> </td>
    </tr>
    <!--<tr>
      <td align="left"><strong> URL : </strong></td>
      <td align="left"><input  type="text" name="data[Maincat][url]"  value="<?php  echo $category_url; ?>"  disabled="disabled"/> </td>
    </tr>-->
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
