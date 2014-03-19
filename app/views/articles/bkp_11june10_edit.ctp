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
{width:400px;
}

</style>
<?php echo $crumb; ?>
<table width="96%" style="width: 100%;">
		<tbody>
			<tr>
				<td width="238" valign="top" style="width: 15em;display:none;">
				<?php echo $this->element('menu',array('link_name' => 'articles')); ?>
				</td>
				<td width="871" valign="top" align="center">
							
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
<?php
//echo $this->pageTitle="Article Editing Page";
echo $javascript->link('prototype');
echo $javascript->link('scriptaculous.js?load=builder,effects');  
echo $javascript->link('modalbox');
echo $html->css('modalbox');
echo $javascript->link('/ckeditor/ckeditor.js',false);
 
//SOURCE :http://particletree.com/features/lightbox-gone-wild/

//echo $javascript->link('lightbox',false); 
//echo $html->css('lightbox',false);

//echo $html->css('default',false);


echo $form->create('Article', array('action' => 'edit'));
?>

<table width="1035" border="0"  bgcolor="#FFFFFF" >
  <tr align="left">
    <td height="32" colspan="3"><span id="form_heading">Edit Article</span></td>
    </tr>
  
 
  <tr valign="top">
    <td height="65" colspan="3">
      <table width="993" border="0" >
        <tr valign="top" align="left" >
          <td height="33" ><b>Title : </b></td>
          <td width="255" ><b>Category :</b></td>
          <td width="277" align="right" ><a href="/blogs/add_category"  onclick="
Modalbox.show(this.href, {title: this.title, height:400,width: 600}); return false;">Manage Category</a> | <a href="/remoteposts/remoteForm/<?php  echo $article_id ;?>"   onclick="
Modalbox.show(this.href, {title: this.title, height:400,width: 600}); return false;">Post Article</a>&nbsp;&nbsp;<a href="#" style="display:none;">&nbsp;Select Social Network</a></td>
        </tr>
        <tr valign="top" align="left" >
          <td width="447" height="24" ><?php echo $form->input('title',array('label' => false,'size' => '70','id' =>'post_title')); ?>
            <div id="mess1"></div></td>
          <td colspan="2" ><input  type="text"  id="maincats" name="maincatsid"  value="<?php  echo $main_cat  ;?>" readonly="true">
		  <input  type="hidden"  id="maincats" name="data[Article][maincats_id]"  value="<?php  echo $main_cat_id  ;?>" readonly="true">		  </td>
        </tr>
      </table></td>
  </tr>
  
 
 
 
  <tr valign="bottom" align="left">
    <td height="21" colspan="3"><b>Description :</b> </td>
    </tr>
  <tr valign="top" align="left">
    <td height="34" colspan="3"><?php echo $form->input('content',array('label' => false,'rows' => '5', 'cols' => '80')); ?></td>
    </tr>
  <tr valign="top" align="left">
    <td width="469" height="34" align="left"><b>Meta Keywords : </b></td>
    <td colspan="2" ><b>Meta Description :</b> <span style="padding-left:20px;"><input type="text" value="100" id="limiter_text" readonly size=3> </span></td>
    </tr>
  <tr align="left"> 
    <td height="33" valign="top"> <?php echo $form->input('meta_keywords',array('label' => false,'rows' => '5', 'cols' => '50')); ?></td>
    <td colspan="2" valign="top"><?php echo $form->input('meta_desc',array('label' => false,'rows' => '5', 'cols' => '50','onkeyup'=>'limiter()')); ?></td>
  </tr>
 
  <tr style="display:none;">
    <td>&nbsp;</td>
    <td width="3">&nbsp;</td>
    <td width="513">&nbsp;</td>
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
    <td width="32">&nbsp;</td>
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
					
					/*echo "   ".$form->input("RelatedArticle.$key.id",array('label' => false,'value' =>$value,
									'type' => 'text','size'=>'3'));*/
																	
    	    	}
				else
				{
					echo "<br><br>";
					echo "   <input type=text name=RecommendedArticle[] value=$value size=5>  "; 
					$rwElement=1;
					/*echo "   ".$form->input("RelatedArticle.$key.id",
					array('label' => false,'value' =>$value ,
					'type' => 'text','size'=>'3'));*/
				}						
		    }//end if				
		}//end for
	?>	</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr valign="top" align="left">
    <td height="26">
  			   <?php  
						 echo $form->input('id', array('type'=>'hidden')); 
				?>		
			
			
						
						 <input type="submit" value="Save And Publish" onClick="return checkBlank();" />	
						 <input type="button" name="preview2" value="Preview" onClick="previewArticle(<?php  echo $article_id;        ?>)"/> 
						 <!--<input type="button" value="Post Article" onClick="window.location='/remoteposts/remoteForm/<?php  echo $article_id;  ?>'"> --><input type="button" value="Cancel" onclick="window.location='/articles/'" />						   </td>
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
							document.getElementById('mess1').innerHTML="<font color='red'>Please Enter Title.</font>";
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
					document.getElementById('limiter_text').value = count-len;
					}
					
					</script>
					<!-- Script by hscripts.com -->


	  		  </td>
			</tr>
	</tbody>
</table>
