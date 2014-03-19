<style type="text/css">
<!--
.style2 {font-size: 32px; color: #00995A;}
-->
</style>
<div align="center" style="padding-left:130px;">
<!--<a href="#" class="lbAction" rel="deactivate">Close Lightbox.</a>-->

<table width="68%" border="0" >
  <tr>
    <td width="377"><div align="center" class="style2">
      <div align="left" style="padding-top:20px">ZSEO Professionals </div>
    </div></td>
    <td width="430"><div align="center" class="style2" >
      <div align="left"  style="padding-top:20px">Business Owners </div>
    </div></td>
    <!--<td width="290" align="right"><img src="/img/logo.jpg"></td>-->
  </tr>
  <tr>
    <td valign="top"><table width="346" height="236" border="0">
      <tr>
        <td width="336" height="41" valign="top" >
          <p align="left">&nbsp;</p>
          <p align="left">&nbsp;</p>
          <p align="left">&nbsp;</p>
          <p align="left"><strong>Service your SEO Clients</strong></p></td>
      </tr>
      <tr>
        <td height="42"><div align="left"><strong>Manage Multiple Blogs </strong></div></td>
      </tr>
      <tr>
        <td height="32"><div align="left"><strong>Optimize Content </strong></div></td>
      </tr>
      <tr>
        <td height="42">
          <div align="left"><strong>Use Google Analytics</strong></div></td>
      </tr>
    </table>      </td>
    <td colspan="2"><table width="364" height="239" border="0">
      <tr>
        <td width="354" height="31"><p align="left">&nbsp;</p>
          <p align="left">&nbsp;</p>
          <p align="left"><strong>Self Service SEO </strong></p></td>
      </tr>
      <tr>
        <td height="48"><div align="left"><strong>Manage One or Multiple Blogs </strong></div></td>
      </tr>
      <tr>
        <td height="41"><div align="left"><strong>Use Power Tools to Research </strong></div></td>
      </tr>
      <tr>
        <td height="43"><div align="left"><strong>Use Google Analytics </strong></div></td>
      </tr>
    </table>     </td>
  </tr>
</table>
</div>
<p align="center" >
<h3 align="center">
		<?php
		
		$id=$session->read('user_id');
		if(!empty($id))
		{
			echo '<a href="/dashboards/" style="text-decoration:underline;">Go to Dashboard</a></h3>';
		}	
		else
		{
			echo	'<a href="/users/sign_up" style="text-decoration:underline;">Sign up Now No Credit Card Required</a></h3>';
		}
		?>
</p>


&nbsp;
</div>
<div style="padding-bottom:55px;">
