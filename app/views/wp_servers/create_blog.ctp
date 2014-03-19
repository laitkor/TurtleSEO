<?php echo $crumb; ?>
<div align="center" width=882px" >
 <table background="/img/create-bolg.png" width="884px" height="81" >
<tr><td align="right" style="padding-right:20px;">&nbsp;
 </td></tr></table>
<!--<img src="/img/create-bolg.png" alt="Create Blog">-->
<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
	<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>
<table style="width:882px;background:#fff" >
		<tbody>
		    
			<tr valign="top" align="left" padding="50px" >
			<td width="200"></td>
			<td>
			<br><br>
						<b>You are being redirected to our shopping cart</b><br>
						<br>
						<!--
						<input type="button" value="Go >>" onClick="window.open('http://cloudegg.com/product_details.php?category_id=71&item_id=53')">
						<input type="button" value="Cancel"  onclick="window.location='/dashboards/'">
						-->
						<input type="image" src="/img/go.png" alt="Go >>" onClick="window.open('http://cloudegg.com/product_details.php?category_id=71&item_id=53')">
						<img src="/img/cancel.png" alt="Cancel"  onclick="window.location='/dashboards/'">
						<br /><br />
			</td>			
			</tr>
	</tbody>
</table>
</div>

<script language=javascript>
setTimeout("window.open('http://cloudegg.com/product_details.php?category_id=71&item_id=53')", 5000);
</script>
