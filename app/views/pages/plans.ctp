<style>
tr { border: .4pt }
table.plan {}
thead { border: 14pt double(1,12,1) }
thead { background: cyan }
tr.odd { background: #FFFFFF; }
tr.even { background: #999999; }
.style1 {
	font-size: medium;
	font-weight: bold;
}
.style2 {font-size: 10px}
.style4 {font-size: 9px}
</style>
<?php
//echo $javascript->link('prototype');
//echo $javascript->link('tabs'); 
//echo $javascript->link('livepipe'); 
?><table width="75%" cellpadding="0" style="width: 100%;" border="0">
		<tbody>
			<tr>
				<td width="253" valign="top" style="width: 15em;"><?php echo $this->element('menu',array('link_name' => 'view plans')); ?></td>
			  <td width="1113" valign="top" >
				<div align="left"><h3>View Plans</h3></div>
			    <table width="771" height="273"   cellpadding="1"  cellspacing="1" >
                  <tr>
                    <td width="161" height="21" bordercolor="#FFFFFF" bgcolor="#999999"><strong>Particulars</strong></td>
                    <td width="178" bordercolor="#FFFFFF" bgcolor="#999999"><span class="style1">Freebie Plan </span></td>
                    <td width="206" bordercolor="#FFFFFF" bgcolor="#999999"><span class="style1">Silver Plan </span></td>
                    <td width="211" bordercolor="#FFFFFF" bgcolor="#999999"><span class="style1">Gold Plan </span></td>
                  </tr>
                  <tr style="border:1px solid red;" class="odd">
                    <td height="19" bordercolor="#00FF66"><span class="style4"><strong>Users/Account Holder </strong></span></td>
                    <td bordercolor="#00FF66"><span class="style2">1 User </span></td>
                    <td bordercolor="#00FF66"><span class="style2">5 Users</span></td>
                    <td bordercolor="#00FF66"><span class="style2">10 Users </span></td>
                  </tr>
                  <tr class="even">
                    <td height="19" bordercolor="#00FF66"><span class="style4"><strong>No.of  Blogs </strong></span></td>
                    <td bordercolor="#00FF66"><span class="style2">1 Blog (10 pages + 10 post) </span></td>
                    <td bordercolor="#00FF66"><span class="style2">20 Blogs (20 pages +unlimited post) </span></td>
                    <td bordercolor="#00FF66"><span class="style2">50 Blogs (unlimited post + unlimited blog) </span></td>
                  </tr>
                  <tr class="odd">
                    <td height="19" bordercolor="#00FF66"><span class="style4"><strong>Keyword Density Report </strong></span></td>
                    <td bordercolor="#00FF66"><span class="style2">1 Reports / month </span></td>
                    <td bordercolor="#00FF66"><span class="style2">15 Reports / month </span></td>
                    <td bordercolor="#00FF66"><span class="style2">50 Reports / month </span></td>
                  </tr>
                  <tr class="even">
                    <td height="21" bordercolor="#00FF66"><span class="style4"><strong>Website Speed Checker Report </strong></span></td>
                    <td bordercolor="#00FF66"><span class="style2">1 Reports / month </span></td>
                    <td bordercolor="#00FF66"><span class="style2">15 Reports / month </span></td>
                    <td bordercolor="#00FF66"><span class="style2">50 Reports / month </span></td>
                  </tr>
                  <tr class="odd">
                    <td height="19" bordercolor="#00FF66"><span class="style4"><strong>IP to Locatin Report </strong></span></td>
                    <td bordercolor="#00FF66"><span class="style2">1 Reports / month </span></td>
                    <td bordercolor="#00FF66"><span class="style2">15 Reports / month </span></td>
                    <td bordercolor="#00FF66"><span class="style2">50 Reports / month </span></td>
                  </tr>
                  <tr class="even">
                    <td height="19" bordercolor="#00FF66"><span class="style4"><strong>Back Link Report(Alexa) </strong></span></td>
                    <td bordercolor="#00FF66"><span class="style2">1 Report (10 links) </span></td>
                    <td bordercolor="#00FF66"><span class="style2">15 Report (1000 links/report) /month </span></td>
                    <td bordercolor="#00FF66"><span class="style2">50 Report(per month) </span></td>
                  </tr>
                  <tr class="odd">
                    <td height="19" bordercolor="#00FF66"><span class="style4"><strong>Back Link Report(YAHOO) </strong></span></td>
                    <td bordercolor="#00FF66"><span class="style2">1 Report (10 links) </span></td>
                    <td bordercolor="#00FF66"><span class="style2">15 Report (1000 links/report) /month </span></td>
                    <td bordercolor="#00FF66"><span class="style2">50 Report(per month) </span></td>
                  </tr>
                  <tr class="even">
                    <td height="19" bordercolor="#00FF66"><span class="style4"><strong>Header Analyzer Report </strong></span></td>
                    <td bordercolor="#00FF66"><span class="style2">1 Reports / month </span></td>
                    <td bordercolor="#00FF66"><span class="style2">15 Reports / month </span></td>
                    <td bordercolor="#00FF66"><span class="style2">50 Reports / month </span></td>
                  </tr>
                  <tr class="odd">
                    <td height="36" bordercolor="#00FF66"><span class="style4"><strong>Traffic Report </strong></span></td>
                    <td bordercolor="#00FF66"><span class="style4">1 Reports / month </span></td>
                    <td bordercolor="#00FF66"><span class="style4">15 Reports / month </span></td>
                    <td bordercolor="#00FF66"><span class="style4">50 Reports / month </span></td>
                  </tr>
                  <tr class="even">
				  	 <td height="21" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>Price</strong></td>
                    <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong><blink>FREE</blink></strong></td>
                    <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>$9.95per month <?php if($plan=='free') echo '<a href="/users/change_plan/">Upgrade Plan</a>'; ?></strong></td>
                    <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>$29 per month <?php if($plan=='silver') echo '<a href="/users/change_plan/">Upgrade Plan</a>'; ?></strong></td>
                  </tr>
                  <tr>
                    <td height="21">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="right"></td>
                  </tr>
                </table></td>
			</tr>
	</tbody>
</table>
