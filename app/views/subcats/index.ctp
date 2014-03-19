<!-- File: /app/views/subcats/index.ctp -->
<h1>Sub Category</h1>
<table>
	<tr>
		<th>Id</th>
		<th>Main Cat ID</th>
		<th>Name</th>
		<th>Edit Name</th>
		<th>URL</th>
		<th>Tips</th>
		<th>Footer</th>
		<th>Keywords</th>
		<th>Description</th>
		
		
		
	</tr>

	<!-- Here is where we loop through our $subcats array, printing out subcatsinfo -->

	<?php foreach ($subcats as $subcat): ?>
	<tr>
		<td><?php echo $subcat['Subcat']['id']; ?></td>
		<td><?php echo $subcat['Subcat']['maincats_id']; ?></td>
		<td><?php echo $subcat['Subcat']['name']; ?></td>
		<td><?php echo $subcat['Subcat']['edb_name']; ?></td>
		<td><?php echo $subcat['Subcat']['url']; ?></td>
		<td><?php echo $subcat['Subcat']['tips']; ?></td>
		<td><?php echo $subcat['Subcat']['footer']; ?></td>
		<td><?php echo $subcat['Subcat']['meta_keywords']; ?></td>
		<td><?php echo $subcat['Subcat']['meta_desc']; ?></td>
		
	</tr>
	<?php endforeach; ?>

</table>