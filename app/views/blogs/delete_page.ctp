<style>
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style3 {color: #006633}
</style>
<?php
echo $javascript->link('/ckeditor/ckeditor.js',false); 
?>
<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
	color: #0033CC;
}
-->
</style>
<table style="width: 100%;">
		<tbody>
			<tr>
				<td width="272" valign="top" style="width: 15em;display:none;">
					<?php echo $this->element('menu',array('link_name' => 'delete page')); ?>				</td>
				<td width="1107" valign="top"  align="left">
				<?php
						echo $javascript->link('prototype');
						echo $javascript->link('scriptaculous'); 
				?>
						<div >
						
						<?php
						echo $form->create('',array('url' =>'delete_page'));
						?>
						<h5 style="padding-top:5px;display:none;" >Delete Page</h5>
						<?php
						if(!empty($error))echo "<br><font color='red'>$error</font>";
						if(!empty($message))echo "<font color='#99CC00'>$message</font>";
						?>
						
						<table width="577"   cellspacing="2" cellpadding="1" style="padding-top:10px" bgcolor="#FFFFFF" >
						  <tr  >
						    <td height="28" colspan="3" bgcolor="#FFFFFF" ><?php echo $crumb; ?></td>
					      </tr>
						  <tr  >
							<td width="141" height="41" bgcolor="#FFFFFF" ><strong>Select Servers : </strong></td>
							<td width="141" bgcolor="#FFFFFF" ><select name="data[wp_server_id]" id="wp_server_id" style="color:#000000">
							  <?php   
									
										foreach($wp_server_ids as $key => $value)
										echo "<option value=$key>$value</option>";
										
										echo "<option value='select' selected>Please Select Server</option>";
									
									
							?>
							</select></td>
							<td width="279"  ><span id="load" style="display:none;"><img src="/img/spinner.gif"></span>&nbsp;</td>
						  </tr>
						  <tr bgcolor="#FFFFFF">
							<td height="29" bgcolor="#FFFFFF" ><strong>Select Page  : </strong></td>
							<td colspan="2" bgcolor="#FFFFFF" >
							<div id='page'>
							<select id="pages" name="data[page_id]">
							</select>
							</div>							</td>
						  </tr>
						  <tr bgcolor="#FFFFFF">
							<td height="33" bgcolor="#FFFFFF" >&nbsp;</td>
							<td colspan="2" bgcolor="#FFFFFF" ><input name="submit" type="submit" value="Delete"  />
						      <input name="button"  type="button"  onclick="window.location='/dashboards/'" value="Cancel"  />
				          <!-- <input name="submit" type="submit" value="Add to All Server"  onclick="document.getElementById('add_to_all_server').value='all'" /> -->						  </tr>
						  <tr bgcolor="#FFFFFF">
							<td bgcolor="#FFFFFF" >&nbsp;</td>
							<td colspan="2" bgcolor="#FFFFFF" >&nbsp;</td>
						  </tr>
				  </table>
						</form>
						<?php 
						echo $ajax->observeField( 'wp_server_id', 
							array(
								'url' => array( 'action' => 'update_page' ),
								'frequency' => 0.2,
								'update'=>'page',
								'loading' => 'Effect.Appear(\'load\')',
								'loaded' =>'Effect.Fold(\'load\')'
							) 
						); 
						?>
						<div id='test'></test>
						</div>

	  		  </td>
			</tr>
	</tbody>
</table>





