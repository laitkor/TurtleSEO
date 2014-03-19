<style>
#v3_new_chef {

/*color:#F5F3DF;
padding-bottom:38px;
padding-left:46px;
padding-right:46px;
padding-top:38px;
*/

}

.clearfix {
display:block;
}
h2{background-color:#ffffff;}
/*input
{background-color:#CCCCCC;font-size:25px;}
label
{
font-weight: bold;
font-size:15px;
}*/
</style>
<style type="text/css">

label{
float: left;
width:100px;

font-weight: bold;
font-size:15px;
}

input[type="text"],input[type="password"], textarea{
width: 400px;
margin-bottom: 5px;
background-color:#FFFFFF;
font-size:25px;
}



textarea{
width: 400px;
height: 50px;
font-weight:bold;
}

.boxes{
width: 1em;
}

#submitbutton{
margin-left: 180px;
width:100px;
}
#button
{
        width:100px;
}
br{
clear: left;
}
zzzfieldset {
border: 1px solid white;
width: 60%;
background: #F7F7F7;
padding: 3px;
margin-left:25%;
background: #ffffff;

}
fieldset {
   border: 1px solid white;

}

fieldset legend {
background: #ffffff;
padding: 3px;
font-weight: bold;


}
option {
font-size:16px;
font-weight:bold;
background-color:#ffffff;
}
</style>
<style type="text/css">
<!--
.brown32 {font-family:helvetica,arial; font-size:32px; font-weight:bold; color: #F8995A;}
label {font-family:helvetica,arial; font-size:16px; font-weight:bold; color: #666666;}
.grey10 {font-family:arial; font-size:12px; font-weight:normal; color: #999999;}
.cat1, .cat2, .cat3 { margin: 0 auto; width: 70px; }
#left {
   float: left;
   width: 50.5%;
   margin: 1% 0 1% 15%;
   padding: 1%;
   background-color:#FFFFFF;
   color: #000;
}
#right {
   float: right;
   margin: -50% 30% 50% 20%;
   width: 100%;
   background-color: #eee;
   border: 1px solid #999999;
}

-->
</style>

<?php
echo $javascript->link('prototype');
echo $javascript->link('scriptaculous');  
?>
<div align="center" style="width:882px">
 <table background="/img/sign-in.png" width="884px" height="81" >
<tr><td align="right" style="padding-right:20px;">&nbsp;
 </td></tr></table>
<!--<img src="/img/sign-in.png" alt="Sign In">-->
<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
		<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>
<div style="width:882px; background:#ffffff" >
<form method="post" action="/users/sign_in">
 <table border=0 align="center" style="padding-left:15px" width="600px">
  <tr>
    <td width="70%">
   <table  border="0" align="left">
  <!--<tr>
    <td colspan="2"><h3>Sign In</h3></td>
    </tr>-->
  <tr>
    <td>&nbsp;</td>
    <td align="left" ><?php
	if(!empty($message))echo $message;
	?></td>
  </tr>
  <tr>
    <td align="left">
       <label>Email:</label>
   </td>
    <td ><input type="text" name="data[email]"  size="50" maxlength="50"></td>
  </tr>
  <tr>
    <td align="left">
      <label>Password:</label>
    <td><input type="password" name="data[password]" size="50" maxlength="50"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><!--<input type="submit" value="Go >>" ><input type="button" value="Cancel" onclick="window.location='/'">-->
	<input type="image" src="/img/go.png" alt="Go >>">&nbsp;&nbsp;&nbsp;<img src="/img/cancel.png" alt="Cancel" onclick="window.location='/'"></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
  	<td><img src="/img/fb_signin.png" />&nbsp;<a href="/users/twitter_connect"><img src="/img/tw_signin.png" /></a></td>
  </tr>
</table>
 </form>   </td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
  </tr>
  <tr>
    <td align=left><table border="0">
  <tr>
    <td><div istyle="border-top: 1px solid rgb(127, 114, 88); margin: 30px 0pt 0pt; padding: 10px 0pt 0pt; text-align: left;" >
    	   <a href="#"  onclick="Effect.toggle('forgot_pass','blind',{ duration: 0.2 });return false;" >Forgot your password?</a>
      </div>
 	
	<div id="forgot_pass" style="<?php  if(isset($mess)) echo 'display:block;'; else echo 'display:none;' ;?>">
	<span style="color:red"><?php  if(isset($mess))echo $mess; ?></span>
	<form action="/users/forgot_password" method="post">
	<table border="0" align="left">
  <tr>
    <td>
       <label>Email:</label>
   </td>
    <td ><input name="data[email]" type="text" size="50" maxlength="50" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><!--<input type="submit" value="Go >>">-->
	<input type="image" src="/img/go.png" alt="Go >>"></td>
  </tr>
</table>
	</form>
	</div>	
</div>
</td>
    </tr>
   </table> 
  </td>
  </td>
  <td width="30%">
  <!--<table id="right"><tr><td>
<li>Sign-in
  <p class="grey10">Please sign-in to access your account</p></li></td></tr> <tr><td>
<li>Forgot Password
  <p class="grey10">Click the Forgot password link. Then use your email address to retrieve your password.</p></li></td></tr> 
 </table>-->
  
  </td>
 </tr>
</tbody>
</table>
</div>
</div>