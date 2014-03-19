<script>
function previewArticle(id)
{
	window.open("http://"+window.location.host+"/articles/preview/"+id,"preWindow","location=0,directories=0,width=600,height=500");
}
</script>
<input  type="button"  value="Save" onclick="forms[0].submit()"/>
<input name="preview" type="button"  value="Preview"  onclick="previewArticle(<?php  echo $article_id;        ?>)"/>
<input name="button23" type="button"  value=" &lt;&lt; PRE" />
<input name="button2" type="button"  value=" NEXT &gt;&gt; " />

<?php
echo $form->create('Article', array('action' => 'edit'));
?>
<br / >  
Article ID : <input type="text" name="textfield" disabled="disabled"  size="7"  value="<?php echo $this->data['Article']['id']  ?>" />
<br / >  
<?php echo $form->input('title'); ?>
<?php echo $form->input('page_title'); ?>
         

<br />
<table width="663" border="1">
  <tr valign="top">
    <td width="190">Main Category </td>
    <td width="178">Sub Category </td>
    <td width="273">SubCategory Tags </td>
  </tr>
  <tr>
    <td><select  name="select" size="5">
    </select>    </td>
    <td><select  name="select2" size="5">
    </select>    </td>
    <td><select  name="select3" size="5">
    </select>    </td>
  </tr>
  <tr>
    <td><input name="button3" type="button"  value="Go" /></td>
    <td><input name="button4" type="button"  value="Go" /></td>
    <td><input name="button5" type="button"  value="Go" /></td>
  </tr>
  <tr>
    <td>Author Name: </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Name :</td>
    <td><input type="text" name="textfield3" /></td>
    <td><input name="button" type="button"  value="Go" /></td>
  </tr>
  <tr>
    <td>Bio :</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><textarea name="textarea" rows="4" cols="30"></textarea></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

   
  
  
  <?php echo $form->input('meta_keywords',array('rows' => '5', 'cols' => '30')); ?><?php echo $form->input('meta_desc',array('rows' => '5', 'cols' => '50')); ?>
   <?php echo $form->input('content',array('rows' => '5', 'cols' => '60')); ?>
 
   <?php echo $form->input('tips',array('rows' => '5', 'cols' => '75')); ?>
 
 <?php echo $form->input('footer',array('rows' => '5', 'cols' => '75')); ?>
  Related Articles : 
  <input name="textfield32" type="text" size="5" />
    Recommended Articles : 
  <input name="textfield322" type="text" size="5" />
    <?php echo $form->input('custom_url'); ?>
   
    <?php echo $form->input('origin_url'); ?>
     <?php  
			 echo $form->input('id', array('type'=>'hidden')); 
	?>		
			
			
	
	 <input type="submit" value="Save"  />	
     <input type="button" name="preview2" value="Preview" onclick="previewArticle(<?php  echo $article_id;        ?>)"/> 
	 <input type="button"  value=" << PRE" />
	 <input type="button"  value=" NEXT >> " />	
</form>
<script>
/*labelsOfForm=document.getElementsByTagName("label");

for(element in labelsOfForm)
{
//labelsOfForm[element].style.display='none';
labelsOfForm[element].innerHTML= "";
//labelsOfForm[element].style.visibility = "hidden";
}*/
</script>

