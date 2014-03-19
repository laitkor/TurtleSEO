<style type="text/css">
 .heading{color:#FFFFFF;size:20px; background:#666666;}
 

table.tablesorter tr th {
	background-color:#6893ff;
	border: 1px solid #FFF;
}
table.tablesorter tr.header {
	background-repeat: no-repeat;
	cursor: pointer;
	color:#ffffff;
	font-size:12px;
}
th{
	padding-left:10px;
}
table.tablesorter td {
	color: #3D3D3D;
	background-color:#FFF;
	width:10%;
	padding-left:8px;
	font-size:12px;
	border:1px solid #CCCCCC;
	
	
}
tr.odd td {
	background-color:#EBEBEB;
}
table.tabManish td{
border:none;
} 
 
table.tabManish td img{
height:20px;
width:20px;
} 
</style>
<?php echo $crumb; ?> 
<div align="center" style="width:882px">
  <table background="/img/Admin_header.png" width="884px" height="81" >
    <tr>
      <td align="right" style="padding-right:20px;">&nbsp;</td>
    </tr>
  </table>
  <div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
    <?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
    <div id="message" >
      <?php $session->flash(); ?>
    </div>
    <?php } ?>
  </div>
  <div style="width:882px; background:#ffffff" >
  <div style="font-size:16px; font-weight:bold; text-align:left; padding:10px 0 10px 46px;">Use List</div>
    <form method="post" action="/users/sign_in">
      <table  width="90%" id="myTable" border=0 class="tablesorter" cellpadding="0" cellspacing="0">
        <thead>
          <tr class="heading">
            <th align="left" style="font-size:13px;">Name
              </td>
            <th align="left" style="font-size:13px;">Plan
              </td>
            <th align="left" style="font-size:13px;">Blog
              </td>
            <th align="left" style="font-size:13px;">Post
              </td>
            <th align="left" style="font-size:13px;">Report
              </td>
		   <th align="left" style="font-size:13px;">Page
              </td>
          </tr>
          <?php 
	  $ii=0;
	  foreach($all_users_details as $k=>$val){ 
	         if($ii%2) { ?>
          <tr class="even">
            <?php } else { ?>
          <tr class="odd">
            <?php }?>
            <td> <?php if($val['User']['name']){ echo ucfirst($val['User']['name']); }else{ echo "---"; }?> </td>
            <td>
			<?php if($val['UserPlan'][0]['plan_id']=='1'){ echo "Silver"; }else if($val['UserPlan'][0]['plan_id']=='2'){ echo "Gold"; } else{ echo "Free"; }?>
			</td>
			<td><?php echo $val['UserPlan'][0]['blog_limit'];?></td>
			<td><?php echo $val['UserPlan'][0]['post_limit'];?></td>
			<td><?php echo $val['UserPlan'][0]['report_limit'];?></td> 
			<td><?php echo $val['UserPlan'][0]['page_limit'];?></td>	  
			
         </tr>
             
          <?php $ii++; } ?>
          </tbody>
          
      </table>
    </form>
  </div>
</div>
