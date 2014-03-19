<table border="0" cellpadding="5" cellspacing="1">
<tr><td><strong>User Details :</strong></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td><strong>ID : <?php echo $id ; ?></strong></td></tr>
<tr><td><strong>Name : <?php echo $user['name']; ?> </strong></td></tr>
<tr><td><strong>Email :<?php echo  $user['email']; ?> </strong></td></tr>
<tr><td><strong>Question : </strong>Why Do You Want To Join turtleSEO </td></tr>
<tr><td><strong>Answer :<?php echo $user['answer']; ?> </strong></td></tr>
<tr><td><strong>Click To Verify User  :</strong> &nbsp; &nbsp; &nbsp;<a href=http://<?=$_SERVER['SERVER_NAME'];?>/users/verify/<?=$encoded_id;?> target='_blank'>Verify</a> </td></tr>
</table>