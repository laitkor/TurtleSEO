<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color:#000000;
}
-->
</style>

<?php echo $crumb; ?>
<div align="center">
 <table background="/img/paypal-details.png" width="884px" height="81" >
<tr><td align="right" style="padding-right:20px;">&nbsp;
 </td></tr></table>
<!--<img src="/img/paypal-details.png" alt="Paypal Details" />-->
<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
		<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>
<div style="background:#ffffff;width:882px">
<?php if ($step==1){?>
<script language="JavaScript">
	function generateCC(){
		var cc_number = new Array(16);
		var cc_len = 16;
		var start = 0;
		var rand_number = Math.random();

		switch(document.CreateRPProfileForm.creditCardType.value)
        {
			case "Visa":
				cc_number[start++] = 4;
				break;
			case "Discover":
				cc_number[start++] = 6;
				cc_number[start++] = 0;
				cc_number[start++] = 1;
				cc_number[start++] = 1;
				break;
			case "MasterCard":
				cc_number[start++] = 5;
				cc_number[start++] = Math.floor(Math.random() * 5) + 1;
				break;
			case "Amex":
				cc_number[start++] = 3;
				cc_number[start++] = Math.round(Math.random()) ? 7 : 4 ;
				cc_len = 15;
				break;
        }

        for (var i = start; i < (cc_len - 1); i++) {
			cc_number[i] = Math.floor(Math.random() * 10);
        }

		var sum = 0;
		for (var j = 0; j < (cc_len - 1); j++) {
			var digit = cc_number[j];
			if ((j & 1) == (cc_len & 1)) digit *= 2;
			if (digit > 9) digit -= 9;
			sum += digit;
		}

		var check_digit = new Array(0, 9, 8, 7, 6, 5, 4, 3, 2, 1);
		cc_number[cc_len - 1] = check_digit[sum % 10];

		document.CreateRPProfileForm.creditCardNumber.value = "";
		for (var k = 0; k < cc_len; k++) {
			document.CreateRPProfileForm.creditCardNumber.value += cc_number[k];
		}
	}
	function setDate() {
		
		var dt = new Date();
		dt = addMonth(dt,1);
		document.CreateRPProfileForm.profileStartDateDay.options[dt.getDate()-1].selected = true;
		document.CreateRPProfileForm.profileStartDateMonth.options[dt.getMonth()].selected = true;
		for(index=0; index<document.CreateRPProfileForm.profileStartDateYear.options.length;index++)
		{
			if(document.CreateRPProfileForm.profileStartDateYear.options[index].value == dt.getFullYear())
			{
				document.CreateRPProfileForm.profileStartDateYear.options[index].selected = true;
				break;
			}
		}
		
	}
	function addMonth(d,month){
		 t  = new Date (d);
		  t.setMonth(d.getMonth()+ month) ;
		  if (t.getDate() < d.getDate())
		 	{
		      t.setDate(0);
		  	}
		  return t;
	}
	
	function appendOptionLast()
	{		
	 
	  for(var i=0;i<10;i++){
		   var elOptNew = document.createElement('option');
		  var d = new Date();
		  y=d.getFullYear();
		  
		  elOptNew.text = y + i;
		  elOptNew.value = y + i;
		  
		  var elSel = document.getElementById('expDateYear');
		
		  try {
			elSel.add(elOptNew, null); // standards compliant; doesn't work in IE
		  }
		  catch(ex) {
			elSel.add(elOptNew); // IE only
		  }
	  }
	}  
	
</script>

<!--<font color=black face=Verdana><b>If you have a PayPal account, <a href="/payments/expressCheckout/5">click here</a></b></font><br><br>-->

<form method="POST" action="/payments/expressCheckout/2/"  name="CreateRPProfileForm">
<!--<h3 style="display:inline; margin-left:350px;">Payment paypal subscription</h3><br /><br />-->
<div align="center">


<table width=670 align="center">	
	<tr>
		<td width="306" align=left><span class="style1">First Name:</span></td>
		<td width="352" align=left><input type="text" name="data[firstName]" value="<?php echo $user_name;?>"></td>
	</tr>
	<tr>
		<td align=left class="style1">Last Name:</td>
		<td align=left><input type="text" name="data[lastName]" value=""></td>
	</tr>
    <tr>
		<td align=left class="style1">Card Type:</td>
		<td align=left>
			<select name="data[creditCardType]" onChange="javascript:generateCC(); return false;">
				<option value=Visa selected>Visa</option>
				<option value=MasterCard>MasterCard</option>
				<option value=Discover>Discover</option>
				<option value=Amex>American Express</option>
			</select>
		</td>
	</tr>
	<tr>
		<td align=left class="style1">Card Number:</td>
		<td align=left><input type="text" name="data[creditCardNumber]"></td>
	</tr>
	<tr>
		<td align=left class="style1">Expiration Date:</td>
		<td align=left><p>
			<select name="data[expDateMonth]">
				<option value=1>01</option>
				<option value=2>02</option>
				<option value=3>03</option>
				<option value=4>04</option>
				<option value=5>05</option>
				<option value=6>06</option>
				<option value=7>07</option>
				<option value=8>08</option>
				<option value=9>09</option>
				<option value=10>10</option>
				<option value=11>11</option>
				<option value=12>12</option>
			</select>
			<select name="data[expDateYear]" id="expDateYear">
			</select>
		</p></td>
	</tr>
	<tr>
		<td align=left class="style1">Card Verification Number:</td>
		<td align=left><input type=text name="data[cvv2Number]"></td>
	</tr>	
	
	<tr align="left">
		<td><br>
	    <b>Billing Address:</b></td>
	</tr>
	<tr>
		<td align=left class="style1">Address 1:</td>
		<td align=left><input type="text" name="data[address1]" value="<?php echo $address;?>"></td>
	</tr>
	<tr>
		<td align=left class="style1">Address 2:</td>
		<td align=left><input type="text"  maxlength=100 name="data[address2]">(optional)</td>
	</tr>
	<tr>

		<td align=left class="style1">City:</td>
		<td align=left><input type="text" maxlength=40 name="data[city]" value="<?php echo $city;?>"></td>
	</tr>
	<tr>
		<td align=left class="style1">State:</td>
		<td align=left>
        <input type="text" name="data[state]" value="<?php echo $state;?>">
		</td>
	</tr>
	<tr>
		<td align=left class="style1">ZIP Code:</td>
		<td align=left><input type="text" maxlength=10 name="data[zip]" value="<?php echo $zip_code;?>"></td>
	</tr>
	<tr>
		<td align=left class="style1">Country:</td>
		<td align=left><input type="text" name="data[country]" value="<?php echo $country;?>"></td>
	</tr>	
	<tr>
		<td/>
		<td><input type="image" src="/img/submit.png" alt="Submit"></td>
	</tr>
</table>
</div>
</form>
<script language="javascript">	
	appendOptionLast();
</script>
<?php }elseif($step==2){?>
	<p>&nbsp;</p>
	<table border="0" cellpadding="5" cellspacing="1" align="center">
	<!--<tr>
		<td colspan="2">
		<?php
			echo $output_data;
			echo $error_msg
		?>
		</td>
	</tr>-->
	<tr>
		<td colspan="2"><div style="color:#FF9900; float:left;"><b><?php echo $display_msg_title;?></b></div></td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td colspan="2"><p><?php echo $display_msg_content;?></p></td>
	</tr>
	<tr><td>&nbsp;</td></tr>					
	<tr>
		<td valign="top"><!--<input type="button" name="back" value="Back" onclick="window.location='/payments/expressCheckout/1'" />-->
		<img src="/img/back_button.png" width="68px" height="28px" alt="Back" onclick="window.location='/payments/expressCheckout/1'" /></td>
		<td valign="top"><?php echo $display_next_button;?></td>
	  </tr>
	</table>	
	<p>&nbsp;</p>
<?php }elseif($step==3){?>

<p>&nbsp;</p>
<div align="center">
	<table border="0" cellpadding="5" cellspacing="1" align="center">
	<!--<tr>
		<td colspan="2">
		<?php
			echo $output_data;
			echo $error_msg
		?>
		</td>
	</tr>-->
	<tr>
		<td colspan="2"><div style="color:#FF9900; float:left;"><b><?php echo $display_msg_title;?></b></div></td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td colspan="2"><p><?php echo $display_msg_content;?></p></td>
	</tr>
	<tr><td>&nbsp;</td></tr>	
	<tr>
		<td><!--<input type="button" value="Back" onclick="javascript: history.go(-1);" />-->
		<img src="/img/back_button.png" width="68px" height="28px" alt="Back" onclick="javascript: history.go(-1);" />
		&nbsp;&nbsp;<?php echo $display_next_button;?></td>
	<tr><td>&nbsp;</td></tr>						
	</table>
</div>	
	<p>&nbsp;</p>
<?php }elseif($step==4){?>
	<table border="0" cellpadding="5" cellspacing="1">
	<!--<tr>
		<td colspan="2">
		<?php
			echo $output_data;
			echo $error_msg
		?>
		</td>
	</tr>-->
	<tr>
		<td colspan="2"><div style="color:#FF9900; float:right;"><b><?php echo $display_msg_title;?></b></div></td>
	</tr>
	</table>
<?php }elseif($step==5){?>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
  <input type="hidden" name="cmd" value="_xclick-subscriptions">
  <input type="hidden" name="business" value="sanjay.pal@laitkor.com">
  <input type="hidden" name="item_name" value="TurtleSEO - User Plan <?php echo $plan_name;?>">
  <input type="hidden" name="item_number" value="1">
  <input type="hidden" name="image_url"
value="http://turtleseo.brideo.com/img/header.jpg">
  <input type="hidden" name="no_shipping" value="1">
  <input type="hidden" name="return"
value="http://turtleseo.stpi.com/payments/expressCheckout/6">
  <input type="hidden" name="cancel_return"

value="http://turtleseo.stpi.com/payments/expressCheckout/7">  
  <input type="hidden" name="a3" value="0.01">
  <input type="hidden" name="p3" value="1">
  <input type="hidden" name="t3" value="D">
  <input type="hidden" name="src" value="1">
  <input type="hidden" name="sra" value="1">
  <input type="hidden" name="srt" value="0">
  <input type="hidden" name="no_note" value="1">
  <input type="hidden" name="custom" value="customcode">
  <input type="hidden" name="invoice" value="<?php echo $invoice_id;?>">
  <input type="hidden" name="usr_manage" value="1">
  <table border="0" cellpadding="5" cellspacing="1" align="center">

	<tr>
		<td colspan="2"><div style="color:#FF9900; float:left;"><b>PayPal</b></div></td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>Plan :</td>
		<td><?php echo $plan_name;?></td>
	</tr>
	<tr>
		<td>Amount :</td>
		<td>$<?php echo $amount;?></td>
	</tr>
	<tr><td>&nbsp;</td></tr>	
	<tr>
		<td> <input type="image" src="http://images.paypal.com/images/x-click-but01.gif" border="0" name="submit" 
alt="Make payments with PayPal - it’s fast, free and secure!" /></td>
	<tr><td>&nbsp;</td></tr>						
	</table>
 
</form>
<?php }elseif($step==6 || $step==7){?>
<table border="0" cellpadding="5" cellspacing="1" align="center">

	<tr>
		<td colspan="2"><div style="color:#FF9900; float:left;"><b><?php echo $display_msg_title;?></b></div></td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td colspan="2"><p><?php echo $display_msg_content;?></p></td>
	</tr>
	<tr><td>&nbsp;</td></tr>	
	<tr>
		<td><!--<input type="button" value="Back" onclick="/users/plans" />-->
		<img src="/img/back_button.png" alt="Back" onclick="/users/plans" /></td>
	<tr><td>&nbsp;</td></tr>						
	</table>
<?php }?>	