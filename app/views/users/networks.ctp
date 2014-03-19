<?php
echo $html->css('style',false);
echo $javascript->link('prototype');
echo $javascript->link('scriptaculous.js?load=builder,effects');  
echo $javascript->link('modalbox');
echo $html->css('modalbox');
?>

<?php echo $crumb; ?>
<div align="center">
 <table background="/img/network.png" width="884px" height="81" >
<tr><td align="right" style="padding-right:20px;">&nbsp;
 </td></tr></table>
<!--<img src="/img/network.png" alt="Networks" />-->
<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
	<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>
<div align="center" style="background:#fff; width:882px">
<table width="442px" >
<?php 
	//$networks = $this->requestAction('/users/networks/'); 
	//if(is_array($networks))
	if(count($networks)!=0)
		{
		foreach($networks as $network) {
		$networkid = $network['Network']['network_id'];
		$networkname = $network['Network']['network_name'];
		$networkurl = $network['Network']['network_url'];
		?>
		<tr>
		<td align="left" width="40px"><img src="/img/<?php echo $networkname ?>.jpg" /></td>
		<td align="left" width="240px">
		<a href="http://<?php echo $networkurl ?>" target="_blank"><?php echo $networkname ?></a>
		</td><td>
		<?php 
			$ch = 0;
			foreach($addednetworks as $addednetwork) {
				if ($networkid == $addednetwork['Addednetwork']['network_id'])
					$ch = $ch +1;
				}	
			if ($ch > 0)	
				{
		?>
		<!--<a href="/users/changecredentials/<?php // echo $networkid; ?>">Change Credentials</a>-->
		<a href="/users/changecredentials/<?php echo $networkid; ?>"  onclick="
Modalbox.show(this.href, {title: this.title, height:400,width: 600}); return false;">Edit</a>&nbsp;<font color="#0099FF">|</font>&nbsp;
		<?php echo $html->link('Delete',array('controller'=>'users', 'action'=>'delete',$networkid), array(),"Are you sure you wish to delete this Network?");?>
		<?php		
				$ch = 0;
				}
			else
				{
		?>
		<!--<a href="/networks/<?php echo $networkname ?>/">Add This Network</a>-->
		<a href="/networks/<?php echo $networkname ?>"  onclick="
Modalbox.show(this.href, {title: this.title, height:400,width: 600}); return false;">Add Network</a>
		<?php $ch =0;} ?>
		<!--<a href="/networks/<?php echo $networkname ?>/"  onclick="
Modalbox.show(this.href, {title: this.title, height:400,width: 600}); return false;">Add This Network</a>-->
		
		</td></tr>
		<?php
		}	
		}
	else
		echo "No network to display";	
?>
	
	<tr><td colspan="3" align="center"><br><?php //echo $html->link('Post Status', '/users/post_status/'); ?>
	<a href="/users/post_status/"  onclick="
Modalbox.show(this.href, {title: this.title, height:400,width: 600}); return false;">Post Status</a>
	<br /><br />
	</td></tr>
</table>
</div>
</div>