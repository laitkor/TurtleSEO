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

 
<table border="0" width="100%"> <tr><td valign="bottom">
<?php echo $crumb; ?> 
</td><td width="120" align="center"> <a href="javascript: openwindow('page');" title="Help Video for pages.">
<img border="0" src="/img/help-videos.png">
</a></td></tr>
</table>

<!-- &nbsp; ><a href="/wp_servers/index/">Edit an existing page </a>-->
<div align="center" style="float:none;">
 <table background="/img/add-page.png" width="884px" height="81" >
<tr><td align="right" style="padding-right:20px;">&nbsp;
 </td></tr></table>
<!--<img src="/img/add-page.png" alt="Add Page">-->
<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
	<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>

<table  align="center" width="882px" style="background:#fff">
		<tbody>
			<tr  valign="top"   bgcolor="#FFFFFF" >
				<td   valign="top" style="width: 15em;display:none;">
					<?php echo $this->element('menu',array('link_name' => 'add page')); ?></td>
 
				<td  valign="top" bgcolor="#FFFFFF" align="center">
								
								<?php
								echo $form->create('',array('url' => '/blogs/add_page/'));
								?>
							<div align="left">
								<?php
								if(!empty($error))echo "<br><font color='red'>$error</font>";
								?>
								<?php
								if(!empty($message))echo "<font color='#99CC00;font-weight:16px'>$message</font>";
								if(!empty($msg))echo "<br>$msg";
								?>
								</div>
								<table border="0" cellpadding="1" cellspacing="2" bgcolor="#FFFFFF" style="padding-left:0px">
																	
									<tr  >
										<td width="20%" align="left" bgcolor="#FFFFFF" ><strong>Select Server*: </strong></td>
										<td width="30%" align="left" bgcolor="#FFFFFF" ><span style="background-color:#FFFFFF">
										  <select name="data[wp_server_id]" id="wp_server_id" style="color:#000000">
                                            <?php   
											
											if(count($wp_server_ids)!=0)
											{
												foreach($wp_server_ids as $key => $value)
												echo "<option value=$key>$value</option>";
												
												echo "<option value='' selected>Please Select Server</option>";
																		
											}
											else
											{
												echo "<option value='' selected>Please Select Server</option>";
											}
											
										?>
                                          </select>
									  </span></td>
									    <td width="20%" align="left" bgcolor="#FFFFFF" ><strong>Enter Title*: </strong></td>
										<!--<td align="right" bgcolor="#FFFFFF"><strong>Enter Title*:&nbsp;&nbsp;</strong>-->
										    <td width=25%" align="left" bgcolor="#FFFFFF" ><input type="text" name="data[title]" size="25" style="width:300px"  />
											<!--
											<span style="background-color:#FFFFFF"><span class="style4">
									        <?php if(isset($msg))echo $msg;   ?>
							          		</span></span>
											-->
									        </td>
								 </tr>
								
								  <tr  >
									<td width="124" height="30" align="left" bgcolor="#FFFFFF" style="background-color:#FFFFFF"><strong>Description*: </strong></td>
									<td width="169" align="left" bgcolor="#FFFFFF" style="background-color:#FFFFFF;">&nbsp;</td>
									<td width="745" align="left" bgcolor="#FFFFFF" style="background-color:#FFFFFF;">&nbsp;</td>
								  </tr>
								  <tr>
									<td height="28" colspan="4" align="left" valign="top" bgcolor="#FFFFFF" style="background-color:#FFFFFF"><textarea name="data[page_desc]" id="page_desc" rows="5" cols="80"></textarea></td>
								  </tr>
								  <tr>
									<td height="60" colspan="2" align="left" bgcolor="#FFFFFF" style="background-color:#FFFFFF"><input type="hidden" value="submitted" name="data[type]" />
                                      <input src="/img/add.png" alt="submit" type="image" value="Add" />
                                    <img src="/img/cancel.png" alt="Cancel"  onclick="window.location='/dashboards/'" value="Cancel" /></td>
									<td align="left" bgcolor="#FFFFFF" style="background-color:#FFFFFF">&nbsp;</td>
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
</div>


