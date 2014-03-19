<p>Dear <?php echo $record[0]['User']['name'] ; ?>, </p>
<p>Thanks for signing up for the turtleSEO beta program. Your application has been approved and these are your credentials:</p>
<p>
		<b>Email :<?php echo $record[0]['User']['email'] ; ?></b><br>
		<b>Password :<?php echo $record[0]['User']['password']; ?></b>
		<br>
</p>
<p>
		You can sign-in by <a href="<?php echo "https://".$_SERVER['SERVER_NAME']."/users/sign_in_directly/$email/$password" ; ?>">clicking here directly </a>
		or go to this URL <?php echo "https://".$_SERVER['SERVER_NAME']."/users/sign_in/"; ?>   <br /><br />
		We value your feedback to improve the turtleSEO service. Please email your feedback to <?php echo ADMIN_MAIL ;?><br>
		<br />
		Best Regards<br />
		<br />
		--<br />
		Anne <br />
		turtleSEO
</p>
