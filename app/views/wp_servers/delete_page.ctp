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
<table border="0" width="100%" cellpadding="0" cellspacing="0"> <tr><td valign="bottom">
<?php echo $crumb; ?> 
</td><td width="120" align="center"> <a href="javascript: openwindow('page');" title="Help Video for pages.">
<img border="0" src="/img/help-videos.png">
</a></td></tr>
</table>
<div align="center">
 <table background="/img/delete-page.png" width="884px" height="81" >
<tr><td align="right" style="padding-right:20px;">&nbsp;
 </td></tr></table>
<!--<img src="/img/delete-page.png" alt="Delete Page">-->
<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
	<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>
<table  width="882px" bgcolor="#FFFFFF">
		<tbody>
			
			<tr>
				<td width="272" valign="top" style="width: 15em;display:none;">
					<?php echo $this->element('menu',array('link_name' => 'delete page')); ?>				</td>
				<td width="1107" valign="top"  align="center">
				<?php
						echo $javascript->link('prototype');
						echo $javascript->link('scriptaculous'); 
				?>
						<div>
						
						<?php
						echo $form->create('',array('url' =>'delete_page'));
						?>
						<div align="center" id="message" >
						<?php
						if(!empty($error))echo "<br><font color='red'>$error</font>";
						if(!empty($message))echo "<font color='green';font-weight:16px'>$message</font>";
						?>
						</div>
						<table cellspacing="2" cellpadding="1" style="padding-top:10px" >
						  <tr style="display:none">
						    <td height="28" colspan="3" bgcolor="#FFFFFF" ><h3>Delete Page</h3></td>
					      </tr>
						  <tr  >
							<td width="153" height="41" bgcolor="#FFFFFF" align="left" ><strong>Select Servers: </strong></td>
							<td width="129" bgcolor="#FFFFFF"  align="left"><select name="data[wp_server_id]" id="wp_server_id" style="color:#000000">
							  <?php   
									
										foreach($wp_server_ids as $key => $value)
										echo "<option value=$key>$value</option>";
										
										echo "<option value='select' selected>Please select server</option>";
									
									
							?>
							</select></td>
							<td width="279"  ><span id="load" style="display:none;"><img src="/img/spinner.gif"></span>&nbsp;</td>
						  </tr>
						  <tr bgcolor="#FFFFFF">
							<td height="29" bgcolor="#FFFFFF" align="left" ><strong>Select Page: </strong></td>
							<td colspan="2" bgcolor="#FFFFFF" align="left" >
							<div id='page'>
							<select id="pages" name="data[page_id]">
							</select>
							</div>							</td>
						  </tr>
						  <tr bgcolor="#FFFFFF">
							<td height="33" bgcolor="#FFFFFF" >&nbsp;</td>
							<td colspan="2" bgcolor="#FFFFFF"  align="left">
						<!--<input name="submit" type="submit" value="Delete"  /><input name="button"  type="button"  onclick="window.location='/dashboards/'" value="Cancel"  />-->
							<input type="image" src="/img/delete.png" alt="delete" >&nbsp;&nbsp;<img src="/img/cancel.png" alt="Cancel" onclick="window.location='/dashboards/'">
						      
				          <!-- <input name="submit" type="submit" value="Add to All Server"  onclick="document.getElementById('add_to_all_server').value='all'" /> -->						 						 </tr>
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
</div>




