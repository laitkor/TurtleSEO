<select  name="data[Article][subcattags_id]" size="5">
<?php
			
			//filling subcattag categories for current selected subcategories
			foreach($sub_cattag as $key => $value)
			{
				if( $key == $curr_subcat_id )
				echo "<option value=$key selected=selected >$value</option>";
				else
				echo "<option value=$key >$value</option>";
			}
?>	
</select>