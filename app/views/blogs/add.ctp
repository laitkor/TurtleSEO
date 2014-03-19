<style>
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style3 {color: #006633}

input[type='text']
{width:250px;}
input[type='password']
{width:250px;}
</style>

<table style="width: 100%;">
		<tbody>
			<tr>
				<td width="238" valign="top" style="width: 15em;display:none;">
					<?php echo $this->element('menu',array('link_name' => 'add blog')); ?>				</td>
				<td width="981" valign="top" align="left">
								
								<?php  echo $form->create('WpServer', array('action' => 'add'));   ?>
								<table width="52%"  border="0" cellpadding="0" cellspacing="0"  >
								  <tr bgcolor="#003333">
								    <td height="33" colspan="2" bgcolor="#FFFFFF">
									<?php echo $crumb; ?><br>
									<span class="style1" style="color:#CC6600">&nbsp;You Have Used <?php echo $user_blog." of " .$total ; ?> . Remaining <?php echo $total-$user_blog; ?> Blogs. 
									To get More : <a href="/users/plans/" >Upgrade Here</a></span></td>
							      </tr>
								  <tr bgcolor="#003333" style="display:none">
									   <td height="19" colspan="2" bgcolor="white"><span class="style1">Add Blog : </span><span class="style3"></span></td>
								  </tr>
								<tr>
									  <td width="31%" height="28" bgcolor="#FFFFFF"><strong>&nbsp;Domain Name URL: </strong></td>
									  <td width="69%" bgcolor="#FFFFFF" style="padding-top:10px;"><?php echo $form->input('name',array('label' =>false,'size'=>20));?></td>
								 </tr>
							  <tr>
								<td height="27" bgcolor="#FFFFFF"><strong>&nbsp;Admin Username : </strong></td>
								<td bgcolor="#FFFFFF"><?php echo $form->input('wp_admin_id',array('label' =>false,'size'=>20));?></td>
							  </tr>
							  <tr>
								<td height="26" bgcolor="#FFFFFF"><strong>&nbsp;Admin Password : </strong></td>
								<td bgcolor="#FFFFFF"><?php echo $form->input('wp_admin_password',array('label' =>false,'size'=>20,'type' => 'password'));?></td>
							  </tr>
							  <tr>
								<td height="25" bgcolor="#FFFFFF"><strong>&nbsp;Rpc URL : </strong></td>
								<td bgcolor="#FFFFFF"><?php echo $form->input('rpc_url',array('label' =>false,'size'=>25));?></td>
							  </tr>
							  <tr>
								<td height="26" bgcolor="#FFFFFF"><strong>&nbsp;Active : </strong></td>
								<td bgcolor="#FFFFFF"><?php echo $form->input('active',array('label' =>false,'type'=>'checkbox'));?></td>
							  </tr>
							  <tr>
								<td bgcolor="#FFFFFF">&nbsp;</td>
								<td bgcolor="#FFFFFF">
								<input type="submit" value="Add">
								<input type="button" value="Cancel" onclick="window.location='/wp_servers/'">	
								</form>								</td>
							  </tr>
				  </table>
	  		  </td>
			</tr>
	</tbody>
</table>
