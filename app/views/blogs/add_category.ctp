<!--
<?php
//echo $javascript->link('prototype');
//echo $javascript->link('scriptaculous'); 
?>
-->
<h3>sss</h3>
<div align="center">

<?php
echo $form->create('',array('url' =>'add_category','id' =>'add_category'));
?>
<h3>ZAdd Category</h3>
<?php
if(!empty($message))echo "<font color='red'>$message</font>";
?>
<!-- <input type="hidden"  name="data[add_to_all_server]" value="" id="add_to_all_server"> -->
<?php
if(!empty($error))echo "<br><font color='red'>$error</font>";
?>
<table width="453"  border="0" cellspacing="2" cellpadding="1" style="padding-top:10px">
  <tr  >
    <td width="228" height="41" bgcolor="#FFFFFF" style="background-color:#FFFFFF"><strong>Select Servers : </strong></td>
    <td width="215" bgcolor="#FFFFFF" style="background-color:#FFFFFF">
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
    <td height="28" bgcolor="#FFFFFF" style="background-color:#FFFFFF"><strong>Enter Category Name : </strong></td>
    <td bgcolor="#FFFFFF" style="background-color:#FFFFFF"><input type="text"  name="data[cat_name]"></td>
  </tr>
  <tr>
    <td height="33" bgcolor="#FFFFFF" style="background-color:#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF" style="background-color:#FFFFFF">
	<!--<input name="submit" type="submit" value="Add"  />-->
	<input type="submit"  onclick="Modalbox.show('/wp_servers/add_category/', {params: Form.serialize('add_category'), method: 'post'},'height:200'); return false;"  value="Add" class="MB_focusable">

	<!-- <input name="submit" type="submit" value="Add to All Server"  onclick="document.getElementById('add_to_all_server').value='all'" /> -->
	<input  type="button" value="Delete"  onclick="Modalbox.show('/wp_servers/delete_category/', 'height:200'); return false;"  class="MB_focusable"  />
	<input type="reset"  />
	</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="background-color:#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF" style="background-color:#FFFFFF">&nbsp;</td>
  </tr>
</table>
</form>

</div>
