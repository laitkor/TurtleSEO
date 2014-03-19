<?php
echo $javascript->link('jquery-1.3.2.min',false);
echo $javascript->link('jquery.tablesorter.min',false); 
echo $html->css('style',false);
echo "<form method='post' action='/key_phrase_assignments/save/$article_id' name='phraseform'>";
?>

<table width="335" border="0">
  <tr>
    <td width="128">Article ID : </td>
    <td width="191"><input type="text" readonly value="<?php echo $article_id; ?>"> <br/></td>
  </tr>
  <tr>
    <td>Article Title : </td>
    <td><input type="text" readonly value="<?php echo $article_title; ?>"></td>
  </tr>
</table>

<p >&nbsp;</p>
<table  id="myTable" border=0 class="tablesorter">
<thead>
<tr>
	<th ></th>
	<th>Phrase</th>
	<th>Frequency</th>
	<th>Global Monthly Search Vol</th>	
	<th>Raw Competition</th>
	<th>Direct Competition</th>
</tr>
</thead>
<tbody>
<?php
$odd=true;
//print_r($data);
foreach($phrases as $key => $value)
{
	if($odd)
	{
		echo "<tr class='odd'>";
		$odd=false;
	}
	else
	{
	echo "<tr >";
	$odd=true;
	}
	if(array_search($value,$assigned)!== FALSE)  
	{
		//phrase has already been assigned 
		echo "<td></td>";
	}	
	else
	{
		if($value==$assignedPhraseId)
		echo "<td><input type=\"checkbox\" value=$value  checked  name=\"phr\"  onclick=\"uncheckAll(this)\"></td>";
		else
		echo "<td><input type=\"checkbox\" value=$value   name=\"phr\" onclick=\"uncheckAll(this)\" ></td>";
	}
	
	echo "<td>". $data[$key]['p']['phrase']."</td>";
	echo "<td>". $data[$key]['ap']['freq']."</td>";
	echo "<td>". $data[$key]['gs']['month_vol']."</td>";
	echo "<td>". $data[$key]['gs']['raw_comp']."</td>";
	echo "<td>". $data[$key]['gs']['dir_comp']."</td>";
	
	echo "</tr>";
	
}
?>
</tbody>
</table>
<input type="submit" value="submit">

<script>
$(document).ready(function() 
    { 
        $("#myTable").tablesorter(
		{ 
        // pass the headers argument and assing a object 
        headers: { 
            // assign the secound column (we start counting zero) 
            0: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            }, 
            // assign the third column (we start counting zero) 
            
        } 
    }); 
}); 
 
/*
This function is used to make checkbox behaviour as radio button behaviour.
the reason for not using the radio button is that it(radio button) not fulfills
all requirements of client(mainly deletion functionality of key phrase).
*/
function uncheckAll(current_id)
{	
	//alert("going");
	boxes=document.forms.phraseform.phr;
	
	if(current_id.checked)
	{
		for(box in boxes)
		boxes[box].checked=false;
		
		current_id.checked=true;
	}
	
}
</script>
</form>
