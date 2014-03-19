<?php
echo $javascript->link('prototype');
echo $javascript->link('scriptaculous'); 
?>
<div align="center">
<?php
echo $form->create('',array('url' =>'delete_category','id' => 'delete_category'));
?>
<!-- <input type="hidden"  name="data[add_to_all_server]" value="" id="add_to_all_server"> -->
<h5 align="center" >Delete Category</h5>
<?php
if(!empty($error))echo "<br><font color='red'>$error</font>";
if(!empty($message))echo "<font color='red'>$message</font>";
?>
<table width="453"  border="0" cellspacing="2" cellpadding="1" style="padding-top:10px" bgcolor="#FFFFFF">
  <tr  >
    <td width="228" height="41" style="background-color:#FFFFFF"><strong>Select Servers : </strong></td>
    <td width="215" style="background-color:#FFFFFF"><select name="data[wp_server_id]" id="wp_server_id" style="color:#000000">
      <?php   
			
				foreach($wp_server_ids as $key => $value)
				echo "<option value=$key>$value</option>";
				
				echo "<option value='select' selected>Please Select Server</option>";
			
			
	?>
    </select></td>
  </tr>
  <tr>
    <td height="29" style="background-color:#FFFFFF"><strong>Select Category  : </strong></td>
    <td style="background-color:#FFFFFF">
	<div id="cat">
	<select id="cat_names" name="data[cat_names]">
	</select>
	</div>
	</td>
  </tr>
  <tr>
    <td height="33" style="background-color:#FFFFFF">&nbsp;</td>
    <td style="background-color:#FFFFFF">
	<!--<input name="submit" type="submit" value="Delete"  />-->
	<input type="submit"  onclick="Modalbox.show('/wp_servers/delete_category/', {params: Form.serialize('delete_category'), method: 'post'},'height:200'); return false;"  value="Delete" class="MB_focusable">
	<input  type="button" value="cancel"  onclick="Modalbox.show('/wp_servers/add_category/', 'height:200'); return false;"  class="MB_focusable"  />
	<!-- <input  type="button" value="cancel"  onclick="window.location='/'"  /> -->
	
	<!-- <input name="submit" type="submit" value="Add to All Server"  onclick="document.getElementById('add_to_all_server').value='all'" /> -->
  </tr>
  <tr>
    <td style="background-color:#FFFFFF">&nbsp;</td>
    <td style="background-color:#FFFFFF">&nbsp;</td>
  </tr>
</table>
</form>
<?php 
echo $ajax->observeField( 'wp_server_id', 
    array(
        'url' => array( 'action' => 'update_cat' ),
        'frequency' => 0.2,
		'update'=>'cat'
    ) 
); 
?>
<div id='test'></test>
</div>
