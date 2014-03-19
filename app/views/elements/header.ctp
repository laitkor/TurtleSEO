<table width="100%" border="0" cellpadding="0" cellspacing="0" align="left"  >

  <tr >
    <td width="60%" height="67" valign="top" align="left" > <div style="background:url('/img/logo.png') no-repeat left;width:50%;height:100%;cursor:pointer;padding-top:10px" onclick="window.location='/'"></div></td>
    <td  align="right" valign="middle"  >
	<div align="right">
		<?php
			//print_r($this->params);
			$name=ucfirst($session->read('name'));
				if(!empty($name))
				{
				 echo "<div style='padding-right: 30px'><a  href='/dashboards/' style='text-decoration:underline; color:#FFFFFF'> Welcome! $name </a>";
				 echo "<font  color=white > | </font><a href='/users/sign_out'  style='text-decoration:underline; color:#FFFFFF'>Sign Out </a></div>";
					//echo '&nbsp; <font  color="#3399ff" style="font-weight: bold;">Welcome,'.$name .'| </font><a href="/users/sign_out" >Sign Out</a>';
				
				}
				else
				{			?>
				
					<div style='padding-right: 30px'><a href="/users/sign_in" style="text-decoration:underline; color:#FFFFFF">Sign In</a>&nbsp;&nbsp;<font color="#ffffff"> |</font> &nbsp;<a href="/users/sign_up" style="text-decoration:underline; color:#FFFFFF">Sign Up</a></div>
		<?php		}	?>
		
</div></td>
  </tr>
  
  
</table>