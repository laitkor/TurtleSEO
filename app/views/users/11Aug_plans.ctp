<style>
 .heading{color:#FFFFFF;size:20px; background:#666666;}
 #step_up_plan, #step_up_down{color:#99CC00;  padding:5px; font-size:14px; margin:2px; padding-bottom:10px;}
 #step_up_plan h5 a, #step_up_down h5 a{text-decoration:none}
 
 table .tablesorter {
	font-family:arial;
	background-color: #CDCDCD;
	margin:10px 0pt 15px;
	font-size: 13px;
	/*font-size: 8pt;*/
	
	width: 100%;
	text-align: left;
}
table .tablesorter thead tr th, table.tablesorter tfoot tr th {
	/*background-color: #e6EEEE;*/

/*	background-color: #0099CC;*/
	background-color:#6893ff;
	
	
	
	border: 1px solid #FFF;
	font-size: 8pt;
	padding: 4px;
}
table.tablesorter thead tr .header {
	background-image: url(../img/bg.gif);
	background-repeat: no-repeat;
	background-position: center right;
	cursor: pointer;
	/*added*/
	color:#ffffff;
	font-size:12px;
}
table.tablesorter tbody td {
	color: #3D3D3D;
	padding: 4px;
	background-color: #FFF;
	/*vertical-align: center;*/
	vertical-align: top;
	width:10%;
	
	
}
table.tablesorter tbody tr.odd td {

	background-color:#EBEBEB;

}
table.tablesorter thead tr .headerSortUp {
	background-image: url(../img/asc.gif);
}
table.tablesorter thead tr .headerSortDown {
	background-image: url(../img/desc.gif);
}
table.tablesorter thead tr .headerSortDown, table.tablesorter thead tr .headerSortUp {
background-color: #8dbdd8;
}

</style>
<script language="javascript">
	function HideBox(divid){
		$(divid).hide();
	}
	var curr_plan ="<?php echo  ucfirst($plan) ; ?>";
	function ShowChangePlan(form_id,new_plan,upgrade){
		if(upgrade=="1"){
			var divid= "step_up_plan";
			var form_click ="u_form_sub"; 
			var id1='u_ini_plan';
			var id2='u_new_plan';
			HideBox("step_up_down");
			setTimeout("HideBox('step_up_plan')",10000);			
		}else{
			divid= "step_up_down";
			form_click ="d_form_sub"; 
			id1='d_ini_plan';
			id2='d_new_plan';
			HideBox( "step_up_plan");			
			setTimeout("HideBox('step_up_down')",10000);	
		}
		
		$(divid).show();
		document.getElementById(id1).innerHTML =curr_plan;
		document.getElementById(id2).innerHTML =new_plan;
		document.getElementById(form_click).innerHTML ="<a href='#' style='text-decoration:underline' onclick=\"SubmitForm('"+form_id+"',"+upgrade+")\">Click here</a>";
	}
	
	function SubmitForm(formid,upgrade){
		var obj = document.getElementById(formid);
		//if(upgrade == "0"){
			//obj.action = '/users/upgrade_plan/';
		//}else{
			obj.action = '/users/setUpplan/';
		//}
		obj.submit();
	}
</script><a 
<?php
//echo $javascript->link('prototype');
//echo $javascript->link('tabs'); 
//echo $javascript->link('livepipe'); 
?>
<?php
	echo $html->css('style',false);
?>
<?php echo $crumb; ?>
<div align="center">
 <table background="/img/View-Plan.png" width="884px" height="81" >
<tr><td align="right" style="padding-right:20px;">&nbsp;
 </td></tr></table>
<!--<img src="/img/View-Plan.png" alt="View Plan" />-->
<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
	<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>
<table width="882px" cellpadding="0" border="0" align="center" style="background:#fff">
 <tbody>
   <tr>
   <td width="253" valign="top" style="width: 15em;display:none;"><?php echo $this->element('menu',array('link_name' => 'view plans')); ?></td>
   <td width="1113" valign="top" align="left"><br/><?php // echo $crumb; ?>
   <div id="step_up_plan" style="display:none">
    <!--step up to {gold}-->
    <!--<h5 align="right"><a href="#" onclick="HideBox('step_up_plan')">x</a></h5>-->
	<h5>Your current plan is <span id="u_ini_plan">{Silver}</span> and you wish to step up to <span id="u_new_plan">{gold}</span>. Your current plan will expire and new plan will start. <span id="u_form_sub"></span> to proceed</h5>
    </div>
    
    <div id="step_up_down" style="display:none">
    	<!--<h5 align="right"><a href="#" onclick="HideBox('step_up_down')">x</a></h5>-->
        <h5>Your current plan is <span id="d_ini_plan">{Gold}</span> and you wish to step down to <span id="d_new_plan">{Silver}</span>. Your limits would be set according to silver plan. <span id="d_form_sub"></span> to proceed</h5>        
    </div>
    <br />
    <!--<div align="left" ><h3 style="color:#FF9900">View Plans :</h3></div>-->
    <div style="color:#FF9900; width:400; float:left;"><b>Your current plan is: <?php echo  ucfirst($plan) ; ?></b></div>
    <?php echo  $plan_expires ; ?>
    
    
    <table width="100%"  border="0" >
     <tr>
      <td width="114" height="32" bordercolor="#FFFFFF" bgcolor="#FFFFFF">Remaining: </td>
      <td width="129" bordercolor="#FFFFFF" bgcolor="#FFFFFF">Blogs: <?php  echo $blog_limit ;?></td>
      <td width="171" bordercolor="#FFFFFF" bgcolor="#FFFFFF">Posts: <?php  echo $post_limit ;?></td>
      <td width="138" bordercolor="#FFFFFF" bgcolor="#FFFFFF">Pages: <?php  echo $page_limit ;?></td>
      <td width="115" bordercolor="#FFFFFF" bgcolor="#FFFFFF" >Reports: <?php  echo $report_limit ;?></td>
     </tr>
	 <tr>
      <td width="114" height="39" bordercolor="#FFFFFF" bgcolor="#FFFFFF"> </td>
      <td width="129" bordercolor="#FFFFFF" bgcolor="#FFFFFF"></td>
      <td width="171" bordercolor="#FFFFFF" bgcolor="#FFFFFF"></td>
      <td width="138" bordercolor="#FFFFFF" bgcolor="#FFFFFF"></td>
      <td width="115" bordercolor="#FFFFFF" bgcolor="#FFFFFF"></td>
     </tr>
     </table>
	 
	 <table  width="100%" id="myTable" border=0 class="tablesorter">
	 <thead>
      <tr>
      <th class="heading" style="font-size:13px;">Particulars</th>
      <th  class="heading" style="font-size:13px;">Freebie Plan </th>
      <th class="heading" style="font-size:13px;">Silver Plan </th>
      <th  class="heading" style="font-size:13px;">Gold Plan </th>
     </tr>
	 </thead>
     
     <!--<tr style="border:1px solid red; background-color:#EBEBEB;" class="odd">
      <td height="19" bordercolor="#00FF66"><strong>Users/Account Holder </strong></td>
      <td bordercolor="#00FF66">1 User </td>
      <td bordercolor="#00FF66">5 Users*</td>
      <td colspan="2" bordercolor="#00FF66">10 Users* </td>
     </tr>-->
     <tr class="odd">
      <td height="19" bordercolor="#00FF66"><strong>Blogs </strong></td>
      <td bordercolor="#00FF66">5 Blog </td>
      <td bordercolor="#00FF66">20 Blogs </td>
      <td colspan="2" bordercolor="#00FF66">50 Blogs  </td>
     </tr>
     <tr class="even" style="background:#EBEBEB;">
      <td height="19" bordercolor="#00FF66"><span class="style4"><strong>Pages</strong></span></td>
      <td bordercolor="#00FF66"><span class="style2">10 Pages </span></td>
      <td bordercolor="#00FF66"><span class="style2">30 Pages</span></td>
      <td colspan="2" bordercolor="#00FF66"><span class="style2">unlimited</span></td>
     </tr>
     <tr class="odd">
      <td height="21" bordercolor="#00FF66"><span class="style4"><strong>Posts</strong></span></td>
      <td bordercolor="#00FF66"><span class="style2">10 Posts </span></td>
      <td bordercolor="#00FF66"><span class="style2">50 Posts </span></td>
      <td colspan="2" bordercolor="#00FF66"><span class="style2">unlimited </span></td>
     </tr>
     <tr class="even" style="background:#EBEBEB;">
      <td height="19" bordercolor="#00FF66"><span class="style4"><strong>Reports </strong></span></td>
      <td bordercolor="#00FF66"><span class="style2">5 Report </span></td>
      <td bordercolor="#00FF66"><span class="style2">15 Reports </span></td>
      <td colspan="2" bordercolor="#00FF66"><span class="style2">35 Reports</span></td>
     </tr>
     <tr class="odd">
      <td height="21" bordercolor="#CCCCCC" ><strong>Price</strong></td>
      <td bordercolor="#CCCCCC" ><strong>FREE</strong></td>
      <td bordercolor="#CCCCCC"><strong>$<?php echo $silver_cost; ?>per month 
       <!-- Silver    --></td>
       <!-- Gold  -->
      <td colspan="2" bordercolor="#CCCCCC"><strong>$<?php echo $gold_cost; ?> per month					  </td>
     </tr>
     <tr>
      <td height="54">&nbsp;</td>
      <td>
       <?php if($plan=='gold' || $plan=='silver') 
       echo "<form action ='/users/setUpplan/' method='post' id='frm1'>
        <input type='hidden' value='$free' name='data[id]'>
        <input type='image' src='/img/step-down-to-free.png' alt='Step down to free'  onclick='return confirm(\"Are you sure you want to step down to free\")' style='color:red'>
     </form>";
     ?></td>
     <td><?php if($plan=='free') 
       echo "<form action ='/users/setUpplan/' method='post' id='frm2'>
       <input type='hidden' value='$silver' name='data[id]'>
	   <!--<input type='button' value='Step up to Silver' onclick='ShowChangePlan(\"frm2\",\"Silver\",1)'>-->
	   <img src='/img/step-up-to-silver.png' alt='Step up to Silver' onclick='ShowChangePlan(\"frm2\",\"Silver\",1)'>
       <!--<input type='submit' value='Step up to Silver'>-->
      </form>";
      ?>
      <?php if($plan=='gold') 
      echo "<form action ='/users/setUpplan/' method='post' id='frm3'>
      <input type='hidden' value='$silver' name='data[id]'>
	  <img src='/img/step-down-to-silver.png' alt='Step down to Silver'  onclick='ShowChangePlan(\"frm3\",\"Silver\",0)' />
	 <!--<input type='button' value='Step down to Silver'  onclick='ShowChangePlan(\"frm3\",\"Silver\",0)' style='color:red'>-->
     <!-- <input type='submit' value='Step down to Silver'  onclick='return confirm(\"Are you sure you want to step down to silver\")' style='color:red'>-->
      </form>";
      ?></td>
      <!--   <td align="right"><?php if($plan=='gold') echo '<a href="/payments/expressCheckout/1" ><font size="2">change plan </font></a>'; ?></td>-->
      <td colspan="2" align="left">
      <!--
      <a href="/payments/expressCheckout/1" ><font size="2">Make Payment </font></a>
      -->
      <?php if($plan=='silver') 
      echo "<form action ='/users/setUpplan/' method='post' id='frm4'>
      <input type='hidden' value='$gold' name='data[id]'>
	  <!--<input type='button' value='Step up to Gold' onclick='ShowChangePlan(\"frm4\",\"Gold\",1)'>-->
	  <img src='/img/gold.png' alt='Step up to Gold' onclick='ShowChangePlan(\"frm4\",\"Gold\",1)'>
      <!--<input type='submit' value='Step up to Gold'>-->
      </form>";
      
?>
<?php if($plan=='free') 
echo "<form action ='/users/setUpplan/' method='post' id='frm5'>
<input type='hidden' value='$gold' name='data[id]'>
<!--<input type='button' value='Step up to Gold' onclick='ShowChangePlan(\"frm5\",\"Gold\",1)'>-->
<input type='image' src='/img/gold.png' alt='Step up to Gold' onclick='ShowChangePlan(\"frm5\",\"Gold\",1)'>
<!--<img src='/img/gold.png' alt='Step up to Gold' onclick='ShowChangePlan(\"frm5\",\"Gold\",1)'>-->
<!--<input type='submit' value='Step up to Gold'>-->
</form>";
?></td>
</tr>
</table>
</td>
</tr>
<?php if($plan!='free'){ ?> 
<tr>
	<td align="left"><p><a href="/payments/expressCheckout/3/">Click here</a> to view subscription details</p></td>
</tr>	
<?php }?>
</tbody>
</table>