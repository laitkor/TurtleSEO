<style>
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style3 {color: #006633}
</style>

<table style="width: 100%;">
		<tbody>
			<tr>
				<td width="238" valign="top" style="width: 15em;display:none;" >
					<?php echo $this->element('menu',array('link_name' => 'blogs')); ?>				</td>
				<td width="981" valign="top" style="visibility:<?php if($blog>0) echo 'visible'; else  echo 'hidden'; ?>;" align="left">
							
								
									<style>
									a{
									/*color:#000000;
									text-decoration:none;
									*/
									margin:5px;
									}
									a:hover{
									color:#003366;
									}
									</style>
									<?php echo $crumb; ?>
									<table width="100%">
									<tr style="display:none;">
									<td width="874" height="21" style="font-size:20px;"><h4 style="color:#FF9900;">&nbsp;</h4></td>
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
										<th>RPC URL</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									<?php  $class ='even';  ?>
									<?php foreach($data as $server): ?> 
									<?php  $class = ($class=='even') ? 'odd' : 'even'; ?>
									<tr class= '<?php echo $class; ?>' > 
										<td ><?php echo $server['WpServer']['id']; ?> </td> 
										<td ><?php echo $server['WpServer']['name']; ?> </td> 
										<td ><?php echo $server['WpServer']['rpc_url']; ?></td> 
										<td >
											<a href="/wp_servers/edit/<?php echo $server['WpServer']['id']; ?>"  >Edit </a>
											<?php echo $html->link('Delete',array('controller'=>'wp_servers', 'action'=>'delete',$server['WpServer']['id']),
														array(),"Are you sure you wish to delete this server?");?>
												<!--<a href="/wp_servers/add_page/<?php echo $server['WpServer']['id']; ?>"  >Add Page </a>-->
												
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
									<?php
									echo $javascript->link('jquery-1.3.2.min',false);
									echo $javascript->link('jquery.tablesorter.min',false); 
									echo $html->css('style',false);
								?>
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
