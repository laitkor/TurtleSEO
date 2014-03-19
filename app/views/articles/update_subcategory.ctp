<select name="data[Article][subcats_id]" size="5" id="subcats">
<?php

	//filling subcategories for current selected maincategories
  	foreach($sub_cat as $key => $value)
	{
		if( $key == $curr_sub_id )
		echo "<option value=$key selected=selected >$value</option>";
		else
		echo "<option value=$key >$value</option>";
	}
?>	
</select>
<?php	echo $ajax->observeField('subcats', 
			array('url' => array( 'action' => 'updateSubcattags'),
        		'frequency' => 0.2,
				'update' => 'subcattag'
				
			)); 
		?>
		
<script>
document.getElementById('subcattag').innerHTML="";
</script>