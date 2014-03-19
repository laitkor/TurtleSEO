<style>
.style4 {
	color: #CC6600;
	font-weight: bold;
	
}
.style9 {font-size: 12px; font-weight: bold; }
tr.odd { background-color: #D7EEFB; }
tr.even { background-color:white; }
</style>
<?php
		echo $javascript->link('prototype');
		echo $javascript->link('scriptaculous'); 
?>

<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
		<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>
					
<table width="100%" style="width: 100%;">
		<tbody>
			<tr>
				<td width="242" height="379" valign="top" style="width: 15em;">
				<?php echo $this->element('menu',array('link_name' => 'research')); ?></td>
				<td width="1126" valign="top" >
						<?php echo $crumb; ?>	
						<form action="/research/" method="post">
						<table width="1035" border="0"  bgcolor="#EEEEEE" style="padding-left:30px">
									  <tr>
										<td width="243" height="62">
										<div style="color:#FF0000;font-size:16px;" ><?php if(isset($mess)) echo $mess; ?></div>
										<!-- <span class="style4">Research </span>  -->										 </td>
										<td height="62"><span class="style4">You Have <?php echo $user_limit ;  ?> of <?php echo $plan_limit ;  ?> Report Remaining In <?php echo $plan_name;  ?>
											 Plan .To get more <a href="/users/plans/" > Upgrade here </a>
													 </span>
													 
													 <div id="mess" style="color:red"></div>
													 </td>
										<td width="70" height="62">&nbsp;</td>
									  </tr>
									  <tr valign="top">
										<td height="26">
							<strong>Research Type :      </strong> </td>
					<td width="708" height="26">
					<select name="data[tool]" id="tools" onchange="checkOptions(this)">
					<option value="speed_checker">Website Speed Checker</option>
						<option value="keyword_density">Keyword Density Calculator</option>
						<option value="domain_locator">Domain Locator</option>
						<option value="header_analyzer">Find Headers</option>
						<option value="back_links">Backlinks Checker</option>
						<option value="domain_availability">Domain Availabilty Checker</option>	
						<option value="rank">Website Rank</option>	
						<option value="report">All in One</option>				
					</select>
				<!--<a href="#" style="color:blue">View Reports</a>-->	</td>
				<td height="26"></td>
			  </tr>
  
 
			 
			 
			  <tr >
				<td height="38"><strong>Phrases/Words/Domain : </strong></td>
				<td height="38"><input type="text" name="data[domain]" size="40" id="domain_url"></td>
				<td height="38">&nbsp;</td>
			  </tr>
			  <tr valign="top">
			    <td height="21" colspan="2">
				<div id='choices' style="display:none;" >
				<table width="569" border="0">
  <tr>
    <td width="235" height="38"><span class="style9">Ignore words of  : <br />    
      </span></td>
    <td width="324"><strong>
      <input type="text" size="4" value="2" name="minoc">
&nbsp;characters in length or less. </strong></td>
  </tr>
  <tr>
    <td height="34"><span class="style9">Minimum Occurence :</span></td>
    <td><strong>
      <input type="text" size="4" value="3" name="minlength">
      &nbsp;</strong></td>
  </tr>
  <tr>
    <td height="33"><span class="style9">Select Choices : </span></td>
    <td><strong></strong></td>
  </tr>
  <tr>
    <td height="24"><strong>
      <input type="checkbox" checked="checked" value="1" name="ikey">
      &nbsp;</strong></td>
    <td><span class="style9">Include Meta tag Keywords&nbsp;</span></td>
  </tr>
  <tr>
    <td height="24"><strong>
      <input type="checkbox" checked="checked" value="1" name="ides">
      &nbsp;</strong></td>
    <td><span class="style9">Include Meta tag Description&nbsp;</span></td>
  </tr>
  <tr>
    <td><strong>
      <input type="checkbox" value="1" checked="checked" name="stopwords">
      &nbsp;</strong></td>
    <td><span class="style9">Stop Words (ignore most common words.)&nbsp;</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

					<br>
					<p>&nbsp;</p>
				</div>				</td>
			    <td height="21">&nbsp;</td>
			    </tr>
			  <tr valign="top">
				<td height="50"><strong>Save Research Report As : </strong></td>
				<td height="50"><select name="select">
				  <option value="pdf">pdf</option>
				 </select>				</td>
				<td height="50">&nbsp;</td>
			  </tr>
			  <tr valign="top">
			    <td height="34">&nbsp;</td>
			    <td colspan="2" >
				<!-- <input name="submit" type="submit"  value="Run"  onclick="return checkOptions()"/> -->
				  <input  type="submit"  value="Run"  onclick="return validate()"/> 
				 <!-- <input  type="image"  src='/img/run.png'  onclick="return validate()"/> -->
				 
				
                  <!-- <input name="submit" type="submit"  value="Run And Save"  onclick="return false"/>-->
                <!-- <img src="/img/cancel.png" onclick="window.location='/dashboards/'" border="0" style="cursor:pointer;"> -->
				 <input name="button" type="button" onclick="window.location='/dashboards/'" value="Cancel" /></td>
			    </tr>
			  <tr valign="top">
				<td width="243" height="45" colspan="3">
				<?php
							
					if(count($report_name)>0)
					{?>
					<div align="center">	
						<table width="100%"  >
						<thead>
						<tr bgcolor='#0099CC'>
						<th width="39">S.No.</th>
						<th width="108">Creation Date</th>
						<th width="165">View Report</th>
						<th width="235">Download Report</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$sno=0;
						$class ='even';
						foreach($report_name as $key => $value)
						{
							
							$class = ($class=='even') ? 'odd' : 'even';
							$value = str_replace ("$", "&", $value);
							$sno=$sno+1;
							echo "<tr class='$class' align='center'>";
							echo "<td >$sno</td>";
							echo "<td>".$created[$key]."</td>";
							echo "<td><a href='/research/view_report/$value'>View </a></td>";
							echo "<td><a href='/research/download_report/$value'>Download </a></td>";
							echo "</tr>";
						}
						?>
						<?php  }  ?>
						</tbody>
				  </table>	
				</div>
				<span style="color:#000000;"><strong>
				<?php  if(isset($rank)) echo "Google Rank : " . $rank ; ?>
				</strong></span>
		
				<div><?php  if(isset($total_links))echo $total_links ." Links Found" ; ?></div>
					<?php
						if(isset($back_links))
						{
							if(!empty($back_links))
							{	
								
								if(isset($pre))
								{
									echo "<div align='right'><a href='/research/more_link/$pre/$url'> << Previous </a></div>";
								}
								if(isset($next))
								{
									echo "<div align='right'><a href='/research/more_link/$next/$url'> Next >> </a></div>";
								}
							}
						
					?>
							
							<table width="1000" height="37"  style="border:1px solid black;">
							<thead>
							<tr>
								
								 <td width="361" bgcolor="#0099CC"><strong>Links</strong></td>
								 <td width="565"  bgcolor="#0099CC"><strong>Title</strong></td>
							</tr>
							</thead>
							<tbody>
							<?php 
							if(!empty($back_links))
							{	
								$class = "even";
								foreach($back_links as $key => $value)
								{
									if(trim($value)!="")
									{
										$class = ($class=='even') ? 'odd' : 'even';
										$value = str_replace ("$", "&", $value);
										
										echo "<tr class='$class'>";
										echo "<td width='380' ><a href='$value' target='_blank'>".$value."</a></td>";
										echo "<td width='380' ><b>".$tit[$key]."</b></td>";
							
									}
									echo "</tr>";
								}	
							}
							}
							?>
							</tbody>
				  </table>
						
	
			   </td>
				</tr>
			  </table>
		</form>
			
	  		  </td>
			</tr>
	</tbody>
</table>

<script type="text/javascript">
var message='';
function checkOptions(obj)
{
	if(obj.value=='keyword_density')
	Effect.BlindDown('choices');
	else
	Effect.BlindUp('choices');

	//Effect.Fold('choices');	
}

function validate()
{	
	
	//return false;
	message='';
	url=document.getElementById('domain_url');
	url=url.value.replace(/(\s+$)|(^\s+)/g, '');
	
	//tomatch= /http:\/\/[A-Za-z0-9\.-]{3,}\.[A-Za-z]{3}/;
	if(url=='')
	{
		message+='Please Enter Domain.<br>';
		
	}
	checkDomain(url);
	if(message!='')
	{
		document.getElementById('mess').innerHTML=message;
		return false;
	}
	else
	return true;
}
</script>
<!-- Script by hscripts.com -->
<script type="text/javascript">

function checkDomain(nname)
{
var arr = new Array(
'.com','.net','.org','.biz','.coop','.info','.museum','.name',
'.pro','.edu','.gov','.int','.mil','.ac','.ad','.ae','.af','.ag',
'.ai','.al','.am','.an','.ao','.aq','.ar','.as','.at','.au','.aw',
'.az','.ba','.bb','.bd','.be','.bf','.bg','.bh','.bi','.bj','.bm',
'.bn','.bo','.br','.bs','.bt','.bv','.bw','.by','.bz','.ca','.cc',
'.cd','.cf','.cg','.ch','.ci','.ck','.cl','.cm','.cn','.co','.cr',
'.cu','.cv','.cx','.cy','.cz','.de','.dj','.dk','.dm','.do','.dz',
'.ec','.ee','.eg','.eh','.er','.es','.et','.fi','.fj','.fk','.fm',
'.fo','.fr','.ga','.gd','.ge','.gf','.gg','.gh','.gi','.gl','.gm',
'.gn','.gp','.gq','.gr','.gs','.gt','.gu','.gv','.gy','.hk','.hm',
'.hn','.hr','.ht','.hu','.id','.ie','.il','.im','.in','.io','.iq',
'.ir','.is','.it','.je','.jm','.jo','.jp','.ke','.kg','.kh','.ki',
'.km','.kn','.kp','.kr','.kw','.ky','.kz','.la','.lb','.lc','.li',
'.lk','.lr','.ls','.lt','.lu','.lv','.ly','.ma','.mc','.md','.mg',
'.mh','.mk','.ml','.mm','.mn','.mo','.mp','.mq','.mr','.ms','.mt',
'.mu','.mv','.mw','.mx','.my','.mz','.na','.nc','.ne','.nf','.ng',
'.ni','.nl','.no','.np','.nr','.nu','.nz','.om','.pa','.pe','.pf',
'.pg','.ph','.pk','.pl','.pm','.pn','.pr','.ps','.pt','.pw','.py',
'.qa','.re','.ro','.rw','.ru','.sa','.sb','.sc','.sd','.se','.sg',
'.sh','.si','.sj','.sk','.sl','.sm','.sn','.so','.sr','.st','.sv',
'.sy','.sz','.tc','.td','.tf','.tg','.th','.tj','.tk','.tm','.tn',
'.to','.tp','.tr','.tt','.tv','.tw','.tz','.ua','.ug','.uk','.um',
'.us','.uy','.uz','.va','.vc','.ve','.vg','.vi','.vn','.vu','.ws',
'.wf','.ye','.yt','.yu','.za','.zm','.zw');

var mai = nname;
var val = true;

var dot = mai.lastIndexOf(".");
var dname = mai.substring(0,dot);
var ext = mai.substring(dot,mai.length);
//alert(ext);
	
if(dot>2 && dot<57)
{
	for(var i=0; i<arr.length; i++)
	{
	  if(ext == arr[i])
	  {
	 	val = true;
		break;
	  }	
	  else
	  {
	 	val = false;
	  }
	}
	if(val == false)
	{
	  	 //alert("Your domain extension "+ext+" is not correct");
		 message+='Your domain extension '+ext+' is not correct<br>';
		 return false;
	}
	else
	{
		for(var j=0; j<dname.length; j++)
		{
		  var dh = dname.charAt(j);
		  var hh = dh.charCodeAt(0);
		  if((hh > 47 && hh<59) || (hh > 64 && hh<91) || (hh > 96 && hh<123) || hh==45 || hh==46)
		  {
			 if((j==0 || j==dname.length-1) && hh == 45)	
		  	 {
		 	  	 //alert("Domain name should not begin are end with '-'");
			       message+="Domain name should not begin are end with '-'<br>";
				  return false;
		 	 }
		  }
		else	{
		  	 //alert("Your domain name should not have special characters");
			    message+="Your domain name should not have special characters<br>";
			
			 return false;
		  }
		}
	}
}
else
{
  //alert("Your Domain name is too short/long");
	    message+="Your Domain name is too short/long<br>";
		 return false;
}	

return true;
}
</script>
<!-- Script by hscripts.com -->

