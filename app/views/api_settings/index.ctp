<style>
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style3 {color: #006633}
</style>
<?php echo $crumb; ?>
<div align="center" >
 <table background="/img/API-setting.png" width="884px" height="81" >
<tr><td align="right" style="padding-right:20px;">&nbsp;
 </td></tr></table>
 </table>
<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
	<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>
<table style="width: 882px; background:#fff">
		<tbody>
			<tr>
				<td width="238" valign="top" style="width: 15em;display:none;" >
					<?php echo $this->element('menu',array('link_name' => 'list api')); ?>				</td>
				<td width="981" valign="top"  align="left">
								<?php
									echo $javascript->link('jquery-1.3.2.min',false);
									echo $javascript->link('jquery.tablesorter.min',false); 
									echo $html->css('style',false);
								?>
									<style>
									a{
									/*color:#000000;
									text-decoration:none;
									margin:5px;*/
									}
									a:hover{
									
									}
									</style>
									<table width="100%">
									<tr>
									<td width="874"><!-- <h4 style="color:#FF9900"><b>List API'S</b></h4> --></td>
									<!--<td width="91"><a href="/wp_servers/edit_page/"  >Edit Page </a></td>-->
									<!--<td width="113"><a href="/wp_servers/delete_page/"  >Delete Page </a></td>-->
									<!--<td width="133"><a href="/wp_servers/add/"  >Add Server </a></td>-->
									</tr>
									</table>
									
									<table  id="myTable" border=0 class="tablesorter">
									<thead>
									<tr>
										<th >ID</th>
										<th>Name</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									<?php  $class ='even';  ?>
									<?php foreach($data as $server): $class = ($class=='even') ? 'odd' : 'even'; ?> 
									<tr class="<?php echo $class; ?>">
										<td ><?php echo $server['ApiSetting']['id']; ?> </td> 
										<td ><?php echo $server['ApiSetting']['name']; ?> </td> 
										<td >
											 <a href="/api_settings/edit/<?php echo $server['ApiSetting']['id']; ?>"  >Edit </a> &nbsp;
											<?php echo $html->link('Delete',array('controller'=>'api_settings', 'action'=>'delete',$server['ApiSetting']['id']),
														array(),"Are you sure you wish to delete this API?");?>
												
												
										</td>
									</tr>				
									<?php endforeach; ?> 
									</tbody>
									</table>
									<?php echo "Page ".  $paginator->counter(); ?>
									<div >
									<?php 
									echo $paginator->prev()."    ";
									echo $paginator->numbers(); 
									echo "    ".$paginator->next();
									
									?> 
									</div>
									<script>
									$(document).ready(function() 
										{ 
											$("#myTable").tablesorter(); 
										} 
									); 
									 $('#message').fadeOut(3000, function() {
    // Animation complete.
  });
									</script>    
	  		  </td>
			</tr>
	</tbody>
</table>
