<?php
echo "<b>Main Article ID : $id </b><br><br>";
echo "Recommended Articles :<br>";
echo "<form method=post action='/articles/editRecommendedArticle/$id'>";
echo "<table>";
foreach($articlesID as $value)
{
	echo "<tr>";
	if(array_search($value,$relID)!==FALSE)
	echo "<td> $value : <input type=checkbox name=rel_article[] value=$value checked ></td>";
	else
	echo "<td>$value : <input type=checkbox name=rel_article[] value=$value ></td>";
	echo "</tr>";
	
}
echo "</table>";
echo "<input type=submit value=save >";
echo "<input type=button value=close onclick=\"window.close()\" >";
echo "</form>";
?>

