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
            <th align="left" style="font-size:13px;">Email
              </td>
            <th align="left" style="font-size:13px;">Password
              </td>
            <th align="left" style="font-size:13px;">Plan
              </td>
            <th align="left" style="font-size:13px;">Action
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
            <td><?php if($val['User']['name']){ echo ucfirst($val['User']['name']); }else{ echo "---"; }?></td>
            <td><?php echo $val['User']['email'];?></td>
            <td><?php echo $val['User']['password'];?></td>
            <td><?php echo $val['User']['plan_type'];?></td>
            <td width="120"><table border="0" align="center" width="100%" class="tabManish">
                <tr>
                  <td width="35%" title="Verify user's details">
				  <?php if($val['User']['verified']){ 
		            echo "<img src='/img/verify_user.png' border='0' />";
		         }else{  
		       		echo "<img src='/img/warning.jpg' border='0' />";
			
				}?>
                  </td>
                  <td width="35%" title="Edit user's details">
				   <a href="/users/edit_user_details/<?php echo $val['User']['id'];?>">
				  <img src="/img/user_edit.png" border="0" />
				  </a>
				  
				  </td>
                  <td width="30%"  title="Delete this user details">
				   <a href="/users/usersdetaild/<?php echo $val['User']['id'];?>" onclick="return confirm('Are you sure you wish to delete this user details?');">
				      <img src="/img/user_delete.png" border="0" />
				     </a>
				  </td>
                </tr>
              </table></td>
          </tr>
          <?php $ii++; } ?>
          </tbody>
          
      </table>
    </form>
  </div>
</div>
