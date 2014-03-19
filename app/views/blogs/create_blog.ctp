<table style="width: 100%;">
		<tbody>
			<tr>
				<td width="238" valign="top" style="width: 15em;display:none;">
					<?php echo $this->element('menu',array('link_name' => 'create blog')); ?>				</td>
				<td width="981" valign="top" align="left" >
					<span ><?php echo $crumb; ?></span><br><br>
						<b>You are being redirected to our shopping cart within 5sec.If it is not redirected then click Go</b><br>
						<br>
						<input type="button" value="Go >>" onclick="window.open('http://cloudegg.com/product_details.php?category_id=71&item_id=53')">
						<input type="button" value="Cancel"  onclick="window.location='/dashboards/'">
		
			</td>
			</tr>
	</tbody>
</table>

<script language=javascript>
setTimeout("window.open('http://cloudegg.com/product_details.php?category_id=71&item_id=53')", 5000);
</script>
