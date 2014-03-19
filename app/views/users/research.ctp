<style>
.style4 {
	color: #CC6600;
	font-weight: bold;
	
}
</style>

<table width="96%" style="width: 100%;">
		<tbody>
			<tr>
				<td width="253" valign="top" style="width: 15em;">
				<?php echo $this->element('menu',array('link_name' => 'research')); ?>				</td>
				<td width="1109" valign="top" >
						<?php echo $crumb; ?>	
<table width="1035" border="0"  bgcolor="#EEEEEE" style="padding-left:30px">
  <tr>
    <td height="62"><span class="style4">Research </span></td>
    <td height="62"><span class="style4">You Have 0 of 5 Report Remaining In <?php echo $plan_name;  ?> Plan .To get more <a href="/users/plans/" style="color:blue"> Upgrade here </a></span></td>
    <td width="70" height="62">&nbsp;</td>
  </tr>
  
 
  <tr valign="top">
    <td height="26"><strong>Research Type :      </strong></td>
    <td width="708" height="26">
	<select name="data[tool]">
		<option value="keyword_density">Keyword Density Calculator</option>
		<option value="speed_checker">Website Speed Checker</option>
		<option value="ip_to_location">Domain Locator</option>
		<option value="header_analyzer">Find Headers</option>
		<option value="back_link">Backlinks Checker</option>

	</select>
	<a href="#" style="color:blue">View Reports</a>	</td>
    <td height="26"></td>
  </tr>
  
 
 
 
  <tr >
    <td height="38"><strong>Phrases/Words/Domain : </strong></td>
    <td height="38"><input type="text" name="data[domain]" size="40"></td>
    <td height="38">&nbsp;</td>
  </tr>
  <tr valign="top">
    <td height="50"><strong>Save Research Report As : </strong></td>
    <td height="50"><select name="select">
      <option value="pdf">pdf</option>
     </select>
	</td>
    <td height="50">&nbsp;</td>
  </tr>
  <tr valign="top">
    <td width="243" height="34">&nbsp;</td>
    <td colspan="2" >
	<!-- <input name="submit" type="submit" onclick="return checkBlank();" value="Run" /> -->
	 <input name="submit" type="submit" onclick="alert('under construction')" value="Run" /> 
      <input name="button" type="button" onclick="window.location='/wp_servers/'" value="Cancel" /></td>
    </tr>
				  </table>
					</form>
					
					
					
					<script type="text/javascript">
					function checkBlank()
					{
						authorBio=document.getElementById('AuthorBio').value;
						//alert(authorBio);
						
						if(authorBio.replace(/(\s+$)|(^\s+)/g, '')=="")
						{
						alert("Bio cannot not be left blank");
						return false;
						}
						else
						{
						document.forms[0].submit();
						return true;
						}
					}
					</script>				
					
					

	  		  </td>
			</tr>
	</tbody>
</table>
