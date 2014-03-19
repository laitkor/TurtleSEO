<style>
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style3 {color: #006633}
</style>
<?php
//http://tetlaw.id.au/view/blog/table-sorting-with-prototype/
echo $javascript->link('prototype');
echo $javascript->link('fastinit');  
echo $javascript->link('tablesort');
echo $html->css('tablesorter_prototype');
?>
<table style="width: 100%;" style="border:0px">
		<tbody>
			<tr>
				<td width="238" valign="top" style="width: 15em;">
					<?php echo $this->element('menu',array('link_name' => 'list post')); ?>				</td>
				<td width="981" valign="top" >
				<?php echo $crumb; ?>
							<span style="font-size:20px;color:#FF9900">Posts</span>
											
											
											 
											<table class="sortable" width="100%">
											<thead>
												<tr > 
													<th  class="sortcol" >S.No</th> 
													<th  class="sortcol" >Article ID</th> 
													<th class="sortcol">Title</th> 
													<th class="sortcol">Action</th> 
												</tr>
											</thead>	 
												   <?php
												   	//$sno=0;
													foreach($data as $article): $sno=$sno+1; ?>
													<tr>
														<td ><?php echo $sno; ?> </td> 	
														<td ><?php echo $article['Article']['id']; ?> </td> 
														<td  ><?php echo $article['Article']['title']; ?> </td> 
														<td ><a href='/articles/edit/<?php echo $article['Article']['id']; ?>'>Edit</a></td> 													
													</tr> 
													<?php endforeach; ?> 
											</table> 
											
											<?php echo "Page ".  $paginator->counter(); ?>
											<div id="tnt_pagination">
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

