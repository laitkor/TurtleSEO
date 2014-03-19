<?php
//SOURCE : http://www.huddletogether.com/projects/lightbox/
//echo $javascript->link('lightbox',false); 
//echo $html->css('lightbox',false);
?>
<style>
.style4 {
	color: #CC6600;
	font-weight: bold;
	
}
input[type="text"],input[type="password"],textarea
{width:300px;
font-size:14px;
}
textarea
{width:300px;
}

</style>
<table border="0" width="100%" cellpadding="0" cellspacing="0"> <tr><td valign="bottom">
<?php echo $crumb; ?> 
</td><td width="120" align="center"> <a href="javascript: openwindow('article');" title="Help Video for articles.">
<img border="0" src="/img/help-videos.png">
</a></td></tr>
</table>

<div align="center">
 <table background="/img/edit-article.png" width="884px" height="81" >
<tr><td align="right" style="padding-right:20px;">&nbsp;
 </td></tr></table>
 </table>
<!--<img src="/img/edit-article.png" alt="Edit Article">-->
<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
		<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>
<div style="width:882px; background:#ffffff">
<table  align="center" >
		<tbody>
			<tr>
				<td valign="top" style="width: 15em;display:none;">
				<?php echo $this->element('menu',array('link_name' => 'articles')); ?>
				</td>
				<td  valign="top" align="center">
							
<script>
function previewArticle(id)
{
	window.open("http://"+window.location.host+"/articles/preview/"+id,"preWindow","location=0,directories=0,width=600,height=500,scrollbars");
}


function editRelatedArticle(id)
{
	window.open("/articles/relatedArticle/"+id,"preWindow","location=0,directories=0,scrollbars,width=600,height=500");

/*	text_field=document.createElement("input");
	text_field.type="text";
	text_field.name="RelatedArticle[]";
	text_field.size=5;
	document.getElementById(divId).appendChild(text_field);
*/	
}
function editRecommendedArticle(id)
{
	window.open("/articles/recommendedArticle/"+id,"preWindow","location=0,directories=0,scrollbars,width=600,height=500");
}

</script>

<div style="padding-left:5px; text-align:left;" class="error-message">
<?php echo $content_error; ?>
</div>

<?php
//echo $this->pageTitle="Article Editing Page";
echo $javascript->link('prototype');
echo $javascript->link('scriptaculous.js?load=builder,effects');  
echo $javascript->link('modalbox');
echo $html->css('modalbox');
echo $javascript->link('/ckeditor/ckeditor.js',false);
 
echo $form->create('Article', array('action' => 'edit'));
?>

 
<table border="0" bgcolor="#FFFFFF" width="880px">
	
  <tr align="left" style="display:none">
    <td height="32" colspan="3"><span id="form_heading">Edit Article</span></td>
    </tr>
  
        <tr valign="top" align="left" >
          <td height="33" ><b>Title: </b></td>
          <td width="220" ><b>Category:</b></td>
          <td width="310" align="right" ><a href="/blogs/add_category"  onclick="
Modalbox.show(this.href, {title: this.title, height:400,width: 600}); return false;">Manage Category</a> | <a href="/remoteposts/remoteForm/<?php  echo $article_id ;?>"   onclick="
Modalbox.show(this.href, {title: this.title, height:400,width: 600}); return false;">Post Article</a>&nbsp;&nbsp;<a href="#" style="display:none;">&nbsp;Select Social Network</a></td>
        </tr>
        <tr valign="top" align="left" >
          <td width="440" height="24" ><?php echo $form->input('title',array('label' => false,'size' => '70','id' =>'post_title')); ?>
            <div id="mess1"></div></td>
          <td colspan="2" >
		   
		  <!--<input  type="text"  id="maincats" name="maincatsid"  value="<?php  echo $main_cat  ;?>" readonly="true">-->
<select id="maincats" name="maincatsid">
<?php
//filling maincategories and making selected for articles main cat
foreach($data_maincats as $key => $value)
if($selected_cat==$key){
echo "<option value='$key' selected >$value</option>";
}else{
echo "<option value=$key >$value</option>";
}

?>
</select>  &nbsp;&nbsp;
	<!--	  <input  type="hidden"  id="maincats" name="data[Article][maincats_id]"  value="<?php  echo $main_cat_id  ;?>" readonly="true">	-->	  </td>
        </tr>
   
 
 
 
  <tr valign="bottom" align="left">
    <td height="21" colspan="3"><b>Description:</b> </td>
    </tr>
  <tr valign="top" align="left">
    <td colspan="3"><?php echo $form->input('content',array('label' => false,'rows' => '5', 'cols' => '50','error'=>false)); ?></td>
    </tr>
  <tr valign="top" align="left">
    <td  height="34" align="left"><b>Meta Keywords: </b></td>
    <td colspan="2" ><span > <b>Meta Description:</b> </span>  <span id="limiter_text" > 100 Characters Left</span></td> 
    </tr>
  <tr align="left"> 
    <td height="33" valign="top"> <?php echo $form->input('meta_keywords',array('label' => false,'rows' => '5', 'cols' => '30')); ?></td>
    <td colspan="2" valign="top"><?php echo $form->input('meta_desc',array('label' => false,'rows' => '5', 'cols' => '50','onkeyup'=>'limiter()')); ?></td>
  </tr>
 
  <tr valign="top" style="display:none;">
    <td height="30">Related Articles : </td>
    <td align="right">&nbsp;</td>
    <td align="right"><input type="button" value="Edit" onClick="editRelatedArticle(<?php  echo $article_id;        ?>)"></td>
  </tr>
  <tr valign="top" style="display:none;">
    <td height="35" colspan="3" >
	<div id="rel_article_id">
	<?php
		$rowElement=1;
		foreach($relatedArticle as $key  => $value)
		{
			if(!empty($value))
			{
			   if($rowElement<=10) //used for display : display 10 element in a row 
			   {
			
					echo "   <input type=text name=RelatedArticle[] value=$value size=5> "; 
					$rowElement=$rowElement+1;
					
					/*echo "   ".$form->input("RelatedArticle.$key.id",array('label' => false,'value' =>$value,
									'type' => 'text','size'=>'3'));*/
																	
    	    	}
				else
				{
					echo "<br><br>";
					echo "   <input type=text name=RelatedArticle[] value=$value size=5>  "; 
					$rowElement=1;
					/*echo "   ".$form->input("RelatedArticle.$key.id",
					array('label' => false,'value' =>$value ,
					'type' => 'text','size'=>'3'));*/
				}						
		    }//end if				
		}//end for
	?>
	</div>	</td>
     
  </tr>
  <tr valign="top" style="display:none;">
    <td height="31">Recommended Articles : </td>
    <td align="right">&nbsp;</td>
    <td align="right"><input type="button" value="Edit" onClick="editRecommendedArticle(<?php  echo $article_id;        ?>)"></td>
  </tr>
  <tr>
    <td height="27" colspan="3" valign="top">
	<?php
		$rwElement=1;
		foreach($recommendedArticle as $key  => $value)
		{ 
			if(!empty($value))
			{
			   if($rwElement<=10) //used for display : display 10 element in a row 
			   {
			
					echo "   <input type=text name=RecommendedArticle[] value=$value size=5> "; 
					$rwElement=$rwElement+1;
					
					
																	
    	    	}
				else
				{
					echo "<br><br>";
					echo "   <input type=text name=RecommendedArticle[] value=$value size=5>  "; 
					$rwElement=1;
					
				}						
		    }//end if				
		}//end for
	?>	</td>
   
  </tr>
  
  <tr valign="top" align="left">
    <td height="26">
  			   <?php  
						 echo $form->input('id', array('type'=>'hidden')); 
				?>		
			
			
						
						 <!--<input type="submit" value="Save" onClick="return checkBlank();" />-->
						 <!--<input type="button" name="preview2" value="Preview" onClick="previewArticle(<?php  echo $article_id;        ?>)"/> -->
						 <!--<input type="button" value="Post Article" onClick="window.location='/remoteposts/remoteForm/<?php  echo $article_id;  ?>'"> -->
						 <!--<input type="button" value="Cancel" onclick="window.location='/articles/'" />	-->
						 <input type="image" src="/img/save.png" alt="Save" onClick="return checkBlank();" />
						 <img src="/img/preview.png" alt="Preview" name="preview2" onClick="previewArticle(<?php  echo $article_id;        ?>)"/>
						 <img src="/img/cancel.png" alt="Cancel" onclick="window.location='/articles/'" />
					   </td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
		  </tr>
				  </table>
					</form>
					
					
					<script type="text/javascript">
									//<![CDATA[
					
										// This call can be placed at any point after the
										// <textarea>, or inside a <head><script> in a
										// window.onload event handler.
					
										// Replace the <textarea id="editor"> with an CKEditor
										// instance, using default configurations.
										CKEDITOR.replace( 'ArticleContent' );
										//CKEDITOR.replace( 'ArticleTips' );
										//CKEDITOR.replace( 'ArticleFooter' );
					
									//]]>
									
					</script>
					
					<script type="text/javascript">
					/*messageObj = new DHTML_modalMessage();
					messageObj.setSource("/articles/edit");
					messageObj.display();					
					*/
					
					function checkBlank()
					{	
						
						
						title=document.getElementById('post_title').value;
						
						//authorBio=document.getElementById('AuthorBio').value;
						//alert(authorBio);
						if(title.replace(/(\s+$)|(^\s+)/g, '')=="")
						{
							//alert("Bio cannot not be left blank");
							document.getElementById('mess1').innerHTML="<font color='red'>Please enter title.</font>";
							return false;
						}
						else
						{
							document.forms[0].submit();
							return true;
						}
				
						/*if(authorBio.replace(/(\s+$)|(^\s+)/g, '')=="")
						{
						alert("Bio cannot not be left blank");
						return false;
						}*/
					}
					</script>				
					
					<!-- Script by hscripts.com -->
					<script type="text/javascript">
					//Edit the counter/limiter value as your wish
					var count = "100";   //Example: var count = "175";
					function limiter(){
					var tex = document.getElementById('ArticleMetaDesc').value;
					var len = tex.length;
					if(len > count){
							tex = tex.substring(0,count);
							document.getElementById('ArticleMetaDesc').value =tex;
							return false;
					}
					document.getElementById('limiter_text').innerHTML = count-len+' Characters left';
					}
					
					</script>
					<!-- Script by hscripts.com -->


	  		  </td>
			</tr>
	</tbody>
</table>
</div>
</div>