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
	
	font-weight: bold;
	color:#CC6600;
}
.style4 {	color:#99CC00;
	font-weight: bold;
}
.style4 {	
	font-weight: bold;
	color:#99CC00;
}
-->
</style>
	<?php echo $crumb; ?>
<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
	<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>

<table width="93%" style="width: 100%;">
		<tbody>
			<tr>
				<td width="286" valign="top" style="width: 15em;display:none;">
					<?php echo $this->element('menu',array('link_name' => 'add page')); ?>				</td>
				<td width="982" valign="top"  align="center" bgcolor="#FFFFFF" >
						
								<?php
								//echo $form->create('',array('url' =>'/wp_servers/page_add/','method' =>'get'));
								echo $form->create('',array('url' => '/blogs/page_add/'));
								
								?>
								<?php
								if(!empty($message))echo "<font color='red'>$message</font>";
								?>
								<?php
								if(!empty($error))echo "<br><font color='red'>$error</font>";
								?>
								<table width="1052" height="248"  border="0" cellpadding="1" cellspacing="2" bgcolor="#FFFFFF" style="padding-left:0px">
								 <tr  >
									
									<td width="124" height="38" colspan="1" align="left" bgcolor="#FFFFFF" style="background-color:#FFFFFF"><h3>Add Page : 
									  
									</h3></td>
								    <td align="left" bgcolor="#FFFFFF" style="background-color:#FFFFFF">&nbsp;</td>
							       <td colspan="2" align="left" bgcolor="#FFFFFF" style="background-color:#FFFFFF">&nbsp;</td>
								  </tr>
									
									<tr  >
										<td width="124" height="27" align="left" bgcolor="#FFFFFF" style="background-color:#FFFFFF"><strong>Server ID: </strong></td>
										<td width="169" align="left" bgcolor="#FFFFFF" style="background-color:#FFFFFF;"><span style="background-color:#FFFFFF">
										  <input name="data[wp_server_id]" id="wp_server_id" style="color:#000000" type="text" readonly value="<?php echo $wp_server_id ; ?>">
										 					  </span></td>
										<td width="170" align="left" bgcolor="#FFFFFF" style="background-color:#FFFFFF;"><div align="right"><strong>Enter Title :&nbsp;&nbsp;</strong></div></td>
								        <td width="571" align="left" bgcolor="#FFFFFF" style="background-color:#FFFFFF;"><strong>
								          <input type="text" name="data[title]" size="25"  />
								          <span class="style4">
								          <?php if(isset($msg))echo $msg;   ?>
							            </span>								        </strong></td>
								  </tr>
								
								  <tr  >
									<td width="124" height="30" align="left" bgcolor="#FFFFFF" style="background-color:#FFFFFF"><strong>Description : </strong></td>
									<td width="169" align="left" bgcolor="#FFFFFF" style="background-color:#FFFFFF;">&nbsp;</td>
									<td colspan="2" align="left" bgcolor="#FFFFFF" style="background-color:#FFFFFF;">&nbsp;</td>
								  </tr>
								  <tr>
									<td height="28" colspan="4" align="left" valign="top" bgcolor="#FFFFFF" style="background-color:#FFFFFF"><textarea name="data[page_desc]" id="page_desc" rows="5" cols="20"></textarea></td>
								  </tr>
								  <tr>
									<td height="33" colspan="2" bgcolor="#FFFFFF" style="background-color:#FFFFFF"><input type="hidden" value="submitted" name="data[type]" />
                                      <input name="submit" type="submit" value="Add" />
                                    <input name="button"  type="button"  onclick="window.location='/dashboards/'" value="Cancel" /></td>
									<td colspan="2" align="left" bgcolor="#FFFFFF" style="background-color:#FFFFFF">&nbsp;</td>
								  </tr>
								  <tr>
									<td height="21" colspan="4" bgcolor="#FFFFFF" style="background-color:#FFFFFF">&nbsp;</td>
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
													CKEDITOR.replace( 'page_desc' );
												//]]>
												
								</script>	
	  		  </td>
			</tr>
	</tbody>
</table>



