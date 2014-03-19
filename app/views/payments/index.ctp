<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
		<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>
<table width="75%" cellpadding="0" style="width: 100%;" border="0">
		<tbody>
			<tr>
				<td width="253" valign="top" style="width: 15em;">
				<?php 
						
						if(empty($disable))
						echo $this->element('menu'); 
				?>
				</td>
				<td width="1113" valign="top"  align="center" >
				<div style="margin-top:10%;">
				<form method="post" action="/payments/expressCheckout/1">
				<table width="358" border="0" bgcolor="#E5E5E5" style="border:1px solid black"  >
				  <tr bgcolor="#FFFFFF">
					<td height="31" colspan="2"><strong>Payment : </strong></td>
				  </tr>
				  <tr>
					<td width="119">Plan : </td>
					<td><input type="text" name="plan" value="<?php echo $plan_name ;  ?>" readonly=""></td>
				  </tr>
				  <tr>
					<td>Amount : </td>
					<td><input type="text" name="data[amt]" value="<?php echo $amt ;  ?>"  readonly=""/></td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td  align="left"><input type="submit">&nbsp;
					<!-- <input type="button" value="cancel" onclick="window.location='/dashboards/'">-->
					</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td width="223">&nbsp;</td>
				  </tr>
				</table>
				</form>
		</div>
		  </td>
	</tr>
	</tbody>
</table>


