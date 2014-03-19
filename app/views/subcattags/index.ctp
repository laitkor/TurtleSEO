<!-- File: /app/views/Subcatstags/index.ctp -->
<h1>Sub Category Tag</h1>
<table>
	<tr>
		<th>Id</th>
		<th>Sub Cat ID</th>
		<th>Name</th>
		<th>Order</th>
		<th>Tips</th>
		<th>Footer</th>
		<th>Keywords</th>
		<th>Description</th>
		
		
	</tr>

	<!-- Here is where we loop through our $Subcatstags array, printing out Subcatstagsinfo -->

	<?php foreach ($subcatstag as $tag): ?>
	<tr>
		<td><?php echo $tag['Subcattag']['id']; ?></td>
		<td><?php echo $tag['Subcattag']['subcats_id']; ?></td>
		<td><?php echo $tag['Subcattag']['name']; ?></td>
		<td><?php echo $tag['Subcattag']['tips']; ?></td>
		<td><?php echo $tag['Subcattag']['footer']; ?></td>
		<td><?php echo $tag['Subcattag']['meta_keywords']; ?></td>
		<td><?php echo $tag['Subcattag']['meta_desc']; ?></td>
		
	</tr>
	<?php endforeach; ?>

</table>