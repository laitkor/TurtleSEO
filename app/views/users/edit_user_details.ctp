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
    <form method="post" action="/users/sign_in">
      <table  width="90%" id="myTable" border=0 class="tablesorter" cellpadding="0" cellspacing="0">
        <thead>
          <tr>
            <td align="left" style="padding-left:50px"><strong>Name: </strong></td>
            <td align="left" style="font-size:13px;">
			<?php echo $form->input('name',array('label' =>false,'error'=>false,'value'=>$users_detials[0][User][name],'type' =>'text'));?>             </td> 
          </tr>
         
           <tr>
             <td align="left" style="padding-left:50px"><strong>Username: </strong></td>
            <td align="left" style="font-size:13px;">
			  <?php echo $form->input('username',array('label' =>false,'value'=>$users_detials[0][User][username],'size'=>20,'error'=>false,'readonly' =>true));?>             
		   </td> 
          </tr>
		  <tr>
		    <td align="left" style="padding-left:50px"><strong>email: </strong></td>
            <td align="left" style="font-size:13px;">
			  <?php echo $form->input('email',array('label' =>false,'value'=>$users_detials[0][User][email],'error'=>false,'type' =>'text'));?>            
		   </td> 
          </tr> 
	      <tr>
		    <td align="left" style="padding-left:50px"><strong>password: </strong></td>
            <td align="left" style="font-size:13px;">
			  <?php echo $form->input('password',array('label' =>false,'value'=>$users_detials[0][User][password],'error'=>false,'type' =>'text'));?>            
		   </td> 
          </tr> 
		  
		 
		
		
		
		 <tr>
		    <td align="left" style="padding-left:50px"><strong>Current Plan: </strong></td>
            <td align="left" style="font-size:13px;">
			  <?php echo $form->input('password',array('label' =>false,'value'=>$users_detials[0][UserPlan][plan_name],'error'=>false,'type' =>'text','readonly' =>true));?>            
		   </td> 
          </tr> 	 
		  
	 <tr>
		  <td align="left" style="padding-left:50px; background:#cccccc;"><strong>Acivate/Inacivate Account: </strong></td>
          <td align="left" style="font-size:13px;background:#cccccc;">
		 <?php echo $form->input('verified',array('label' =>false,'value'=>$users_detials[0][User][password],'error'=>false,'type' =>'checkbox'));?> 
		 <span style="font-size:9px;"> Uncheck=>Incactive ||  Checked => Active</span>           
		   </td> 
   </tr> 	
   
   
   		 <tr>
		    <td align="left" style="padding-left:50px"><strong>password: </strong></td>
            <td align="left" style="font-size:13px;">
			  <?php echo $form->input('password',array('label' =>false,'value'=>$users_detials[0][User][password],'error'=>false,'type' =>'text'));?>            
		   </td> 
          </tr> 	 
      </table>
    </form>
  </div>
</div>
