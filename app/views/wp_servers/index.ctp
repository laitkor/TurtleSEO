<style>
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style3 {color: #006633}
</style>
<?php echo $crumb; ?>
<div align="center">
 <table background="/img/blogs.png" width="884px" height="81" >
<tr><td align="right" style="padding-right:20px;">&nbsp;
 </td></tr></table>
<!--<img src="/img/blogs.png" alt="Articles">-->
<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
	<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>

<table width="882px" style="background:#fff;">
		<tbody>
			
			<tr>
				<td  valign="top" style="width: 15em;display:none;" >
					<?php echo $this->element('menu',array('link_name' => 'blogs')); ?>				</td>
				<td   valign="top"  >
							
								
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
									
									<table width="100%" style="background:#fff;visibility:<?php if($blog>0) echo 'visible'; else  echo 'hidden'; ?>;">
									<tr style="display:none;">
									<td width="874" height="21" style="font-size:20px;"><h4 style="color:#FF9900;">&nbsp;</h4></td>
									<!--<td width="91"><a href="/wp_servers/edit_page/"  >Edit Page </a></td>-->
									<!--<td width="113"><a href="/wp_servers/delete_page/"  >Delete Page </a></td>-->
									<!--<td width="133"><a href="/wp_servers/add/"  >Add Server </a></td>-->
									</tr>
									</table>
									
									<table width="608" border=0 class="tablesorter"  id="myTable" >
									<thead>
									<tr>
										<!--<th width="20" >ID</th>-->
										<th width="40">Name</th>
										<th width="448">RPC URL</th>
										<th width="82">Action</th>
									</tr>
									</thead>
									<tbody>
									<?php  $class ='even';  ?>
									<?php foreach($data as $server): ?> 
									<?php  $class = ($class=='even') ? 'odd' : 'even'; ?>
									<tr class= '<?php echo $class; ?>' > 
										<!--<td ><?php echo $server['WpServer']['id']; ?> </td> -->
										<td ><?php echo $server['WpServer']['name']; ?> </td> 
										<td ><?php echo $server['WpServer']['rpc_url']; ?></td> 
										<td >
											<a href="/blogs/edit/<?php echo $server['WpServer']['id']; ?>"  >Edit </a>
											<?php echo $html->link('Delete',array('controller'=>'blogs', 'action'=>'delete',$server['WpServer']['id']),array(),"Are you sure you wish to delete this server?");?>
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
