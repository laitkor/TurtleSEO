<?php
	echo $javascript->link('jquery-1.3.2.min',false);
	echo $javascript->link('jquery.tablesorter.min',false); 
	echo $html->css('style',false);
?>
<?php echo $crumb; ?>
<div align="center" >
 <table background="/img/categories.png" width="884px" height="81" >
<tr><td align="right" style="padding-right:20px;">&nbsp;
 </td></tr></table>
<!--<img src="/img/categories.png" alt="Categories">-->

<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
		<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>

<!--<h2>Main Category</h2>-->
<div align="left" style="background:#fff;width:882px">
<!--<ul class="actions">
<li style="padding-top:5px"><?php //echo $html->link('Add a Main Category', '/maincats/add')?></li>
<li style="padding-top:5px"><?php //echo $html->link('Articles', '/articles/')?></li>
</ul>-->
</div>
<div style="background:#fff;width:882px;">
<?php if (count($maincats) <> 0) { ?>
<table border=0 id="myTable" class="tablesorter" align="center" width="880px" >
       <thead>
	    <tr bgcolor="#6893ff" height="25px">
                <th width="25%" align="left">Sr. No.</th>
                <th align="left" >Category Name</th>
                <th width="25%" align="left" >Action</th>
               
			    <!--<th >Tips</th>
                <th >Keywords</th>
                <th >Short Name</th>-->
				
                <!-- <th width="57">Action</th> -->
        </tr>
	</thead>	
        <!-- Here is where we loop through our $maincats array, printing out maincatsinfo -->
	<?php  $class ='even';  
		   $i=1; foreach ($maincats as $maincat): 
  		   $class = ($class=='even') ? 'odd' : 'even'; ?>
        <tr class= '<?php echo $class; ?>'>
                <td align="left"><?php echo $i; ?></td>
                <td align="left"><strong><?php echo $maincat['Maincat']['name']; ?></strong></td>
				<td style=" cursor:pointer; font:bold;" align="left">
				<a href='/maincats/edit/<?php echo $maincat['Maincat']['id']; ?>'>Edit</a>
				<!--<a href='/maincats/edit/<?php echo $maincat['Maincat']['id']; ?>'  onclick="
Modalbox.show(this.href, {title: this.title, height:400,width: 600}); return false;">Edit</a>-->
				</td>
<!--                <td><?php //echo $maincat['Maincat']['edb_name']; ?></td>
                <td><?php //echo $maincat['Maincat']['tips']; ?></td>
                <td><?php //echo $maincat['Maincat']['meta_keywords']; ?></td>
                <td><?php //echo $maincat['Maincat']['short_name']; ?></td>-->
           <!--     <td><?php //echo $html->link('Delete','/maincats/delete/' . $maincat['Maincat']['id'], null, 'Are you sure you want to delete this category ' . $maincat['Maincat']['name'])?></td> -->      </tr>
        <?php $i++; endforeach; ?>
</table>
<?php } else { ?>
<p>Please <a href="/maincats/add">add a category</a> to your account.<br /><br></p>
<?php } ?>

</div>

<script>
$(document).ready(function() 
	{ 
		$("#myTable").tablesorter(); 
	} 
); 
$('#message').fadeOut(3000, function()
{
    // Animation complete.
});
									    
</script>    
