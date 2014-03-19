<!-- remote postings form  -->

<!--
<script src="/js/prototype.js" type="text/javascript"></script>
<script src="/js/scriptaculous.js" type="text/javascript"></script>
-->
<style>
div.message{
height:50px;
}
</style>
<cake:nocache>

<!--<div class="message" id="flashMessage">-->
<?php
/*clearCache();
print_r($_SESSION); 
if(isset($_SESSION['msg2'])){
echo $_SESSION['msg2'];
}
unset($_SESSION['msg2']);*/
?>
<!--</div>-->
<h3 style="display:inline">Select blogs to Post Article</h3>
<br><br>
<div class="form">


<form  method="post" id="postform">

<?php

echo "Please check the box to select a blog and uncheck the box to delete article from the blog.";
echo "<br />";

//detecting already posted server ids
foreach($servers as $key => $value)
{
	$id=$servers[$key]['WpServer']['id'];
	$name=$servers[$key]['WpServer']['name'];

	if(array_search($id,$posted) !== FALSE)
	{
		//checked
		echo "<input type='checkbox' value=$id checked name='servers[]'>";
		echo "  <b>$name</b><br>";
	}
	else
	{
		echo "<input type='checkbox' value=$id  name='servers[]'>";
		echo "  <b>$name</b><br>";
	}
}

?>

<input type="hidden" value="<?php echo $article_id; ?>" name="article_id" />
<input type="hidden" value="<?php echo $category; ?>" name="category" />

<br>
<?php if(!empty($servers)) {?>
<input type="image" src="/img/submit.png" alt="Submit" onclick="Modalbox.show('/remoteposts/sendPost', {params: Form.serialize('postform'), method: 'post'},'height:200'); return false;" class="MB_focusable">
<?php }?>

<!--<input type="submit" value="Post" name="submit"  />-->
</form>
<br />
<table>
   	<tr>
    	<td><img src="/img/blogger_icon.png" />&nbsp;</td><td>
         <?php echo $html->link('Post in Blogspot Blogs', "#", array('onclick'=>"Modalbox.hide(); window.open ('/blogs/gdata/post/".$article_id."','mywindow','location=1,status=1,scrollbars=1, width=600,height=300,location=no,menubar=no,toolbar=no,status=yes,scrollbars=yes,resizable=yes,left=,top=');"));	?>      
       <!-- <a href="">Add Blogspot Blogs</a>--></td>
    </tr>
 </table>  

	</div>
	</cake:nocache>
<script>
//Effect.Fade('message',{ duration: 3.0 });
</script>
