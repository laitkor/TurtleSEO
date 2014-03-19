<style>
textarea {
width: 260px;
border:1px solid #A6A6A6;
padding:2px 1px;
}
</style>
<h3 style="display:inline">Post Your Status</h3>
<div align="center">
<div style="padding-top:5px;padding-bottom:5px;clear:both;">
	<div id="message" ><?php $session->flash(); ?></div>
</div>
<?php
echo $form->create('',array('url' =>'/users/post_status','id' =>'post_status'));
?>
<!--<form name="postform" method="post" >-->
<table width="453">
	<tr>
		<td width="40%" align="left">
		<?php 
		if(count($addednetworks)!=0)
			{
			foreach($addednetworks as $addednetwork)
				{
				echo  $form->checkbox('Usernetworks.['.$addednetwork['Addednetwork']['network_id'].']', array('value' => $addednetwork['Addednetwork']['network_id']));
				echo $addednetwork['Addednetwork']['network_name'];
				echo "<br />";
				}
			}	
		else
			echo "You have not added any network. <br> Please add a network"; 
		?>
		</td>
		<td  width="60%">
			<textarea name="data[message]" style="width:260px""></textarea>
		</td>
	</tr>
	<tr><td></td>
	<td align="left">
	<input type="image" src="/img/post.png" alt="Post" onclick="Modalbox.show('/users/post_status', {params: Form.serialize('post_status'), method: 'post'},'height:200'); return false;" class="MB_focusable" /></td>
    </tr>
</table>
</form>
</div>