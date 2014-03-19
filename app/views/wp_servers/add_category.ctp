<!--
<?php
//echo $javascript->link('prototype');
//echo $javascript->link('scriptaculous'); 
?>
-->
<div align="center" >

<?php
echo $form->create('',array('url' =>'add_category','id' =>'add_category'));
?>
<?php
if(!empty($message))echo "<font color='green'>$message</font>";
?>
<!-- <input type="hidden"  name="data[add_to_all_server]" value="" id="add_to_all_server"> -->
<?php
if(!empty($error))echo "<br><font color='red'>$error</font>";
?>
<div style="padding-top:5px;padding-bottom:5px;clear:both;">
	<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>

<table width="453"  border="0" cellspacing="2" cellpadding="1" style="padding-top:10px;">
  <tr><td colspan="2"><h3 style="display:inline">Add Category</h3></td></tr>
  <tr>
    <td width="228" height="41"><strong>Select Servers : </strong></td>
    <td width="215" >
	<select name="data[wp_server_id]" id="wp_server_id" style="color:#000000">
		<?php   
			
			if(count($wp_server_ids)!=0)
			{
				foreach($wp_server_ids as $key => $value)
				echo "<option value=$key>$value</option>";
				
				echo "<option value='' selected>Please Select Server</option>";
				echo "<option value='all'>Add To All Server</option>";
		
			}
			else
			{
				echo "<option value='' selected>Please Select Server</option>";
			}
			
		?>
	</select>
	
	</td>
  </tr>
  <tr>
    <td height="28" ><strong>Enter Category Name : </strong></td>
    <td><input type="text"  name="data[cat_name]"></td>
  </tr>
  <tr>
    <td height="33" >&nbsp;</td>
    <td >
	<!--<input type="submit"  onclick="Modalbox.show('/wp_servers/add_category/', {params: Form.serialize('add_category'), method: 'post'},'height:200'); return false;"  value="Add" class="MB_focusable">
	<input  type="button" value="Delete"  onclick="Modalbox.show('/wp_servers/delete_category/', 'height:200'); return false;"  class="MB_focusable"  />-->
	<input type="image" src="/img/add.png" alt="Add" onclick="Modalbox.show('/wp_servers/add_category/', {params: Form.serialize('add_category'), method: 'post'},'height:200'); return false;" class="MB_focusable">
	<!--<img src="/img/delete.png" alt="Delete" onclick="Modalbox.show('/wp_servers/delete_category/', 'height:200'); return false;"  class="MB_focusable"  />-->
	
	<!--<input type="reset"  />-->
	</td>
  </tr>
  <tr>
    <br />
  </tr>
</table>
</form>

</div>
