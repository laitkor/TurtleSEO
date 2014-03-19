<style>
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style3 {color: #006633}
</style>
<?php
//http://tetlaw.id.au/view/blog/table-sorting-with-prototype/
/*
echo $javascript->link('prototype');
echo $javascript->link('fastinit');  
echo $javascript->link('tablesort');
echo $html->css('tablesorter_prototype');
*/
?>
<?php
	echo $javascript->link('jquery-1.3.2.min',false);
	echo $javascript->link('jquery.tablesorter.min',false); 
	echo $html->css('style',false);
?>
<?php echo $crumb; ?>
<div align="center" >
 <table background="/img/articles.png" width="884px" height="81" >
<tr><td align="right" style="padding-right:20px;">&nbsp;
 </td></tr></table>

<!--<img src="/img/articles.png" alt="Articles">-->
<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px;">
		<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>
<table style="width: 882px;background: #fff" >
		<tbody>
			<tr>
				<td width="238" valign="top" style="width: 15em;display:none;">
					<?php echo $this->element('menu',array('link_name' => 'articles')); ?>				</td>
						
				<td width="981" valign="top" align="left">
		
								<!-- <span style="font-size:20px;color:#FF9900">Posts</span> -->
											
											
											 
											<table  width="100%" id="myTable" border=0 class="tablesorter">
											<thead>
												<tr > 
													<th  class="sortcol" >S.No</th> 
													<!--<th  class="sortcol" >Article ID</th> -->
													<th class="sortcol">Title</th> 
													<th class="sortcol">Action</th> 
												</tr>
											</thead>	 
												   <?php
												   	//$sno=0;
													$class ='even';
													foreach($data as $article): $sno=$sno+1;$class = ($class=='even') ? 'odd' : 'even'; ?>
													<tr class="<?php echo $class;  ?>"  >
														<td ><?php echo $sno; ?> </td> 	
														<!--<td ><?php echo $article['Article']['id']; ?> </td> -->
														<td  ><?php echo $article['Article']['title']; ?> </td> 
														<td >
														<a href='/articles/edit/<?php echo $article['Article']['id']; ?>'>Edit</a>
														&nbsp;&nbsp;
														<?php echo $html->link('Delete',array('controller'=>'articles', 'action'=>'delete',$article['Article']['id']),array(),"Are you sure you wish to delete this article?"); ?></td> 													
													</tr> 
													<?php endforeach; ?> 
				  </table> 
											<div align="left">
											<?php echo "Page ".  $paginator->counter(); ?><br>
											
											<?php 
											echo $paginator->prev()."    ";
											echo $paginator->numbers(); 
											echo "    ".$paginator->next();
											
											?> 
											</div>
											<!--<script>
											function highlight(row)
											{
												//alert(row);
												row.className="even";
											}
											function norm(row)
											{
												
												row.className="odd";
											}
											</script>-->

	  		  </td>
			</tr>
	</tbody>
</table>

<script>
$(document).ready(function() 
{ 
	$("#myTable").tablesorter(); 
} 
); 
</script>    