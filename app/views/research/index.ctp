<style>

.style4 {
 color: #CC6600;
 font-weight: bold;
 padding-left: 15px;
}
select {
	height: 30px;
}
 

.style9 {font-size: 12px; font-weight: bold; }
 tr.odd { background-color: #D7EEFB; }
 tr.even { background-color:white;}
 .heading{color:#FFF;size: 20px; }
</style>
<?php
 echo $javascript->link('prototype');
 echo $javascript->link('scriptaculous'); 
?>
<table border="0" width="100%" cellpadding="0" cellspacing="0"> <tr><td valign="bottom">
<?php echo $crumb; ?> 
</td><td width="120" align="center"> <a href="javascript: openwindow('research');" title="Help Video for reseach.">
<img border="0" src="/img/help-videos.png">
</a></td></tr>
</table>
<div align="center">
 <table background="/img/Research.png" width="884px" height="81" >
<tr><td align="right" style="padding-right:20px;">&nbsp;
 </td></tr></table>
 
<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;clear:both;width:882px">
	<?php if (isset($_SESSION['Message']['flash']['message']) && $_SESSION['Message']['flash']['message']!='') {?>
	<div id="message" ><?php $session->flash(); ?></div>
	<?php } ?>
</div>

<table width="882px" style="background:#fff;" border="0" align="center" >
  <tbody>
    <tr>
      <td width="242" height="379" valign="top" style="width: 15em;display:none;"><?php echo $this->element('menu',array('link_name' => 'research')); ?></td>
      <td width="1126" valign="top"  align="left"><form action="/research/" method="post">
          <table width="100%" border="0" style="padding-left:30px">
            <tr height="20">
              <div align="center" >
                <?php if(isset($mess)) echo $mess; ?>
              </div>
              <div id="mess" style="color:red"></div>
            </tr>
            <!-- <span class="style4">Research </span>  -->
            <tr>
              <!--<span class="style4">You have used <?php echo $plan_limit-$user_limit ;  ?> of <?php echo $plan_limit ;  ?> Report. Remaining: 
			<?php echo $plan_limit-$user_limit;  ?> in <?php echo $plan_name;  ?> plan .To get more <a href="/users/plans/" >
			Upgrade here</a>
		 </span> -->
              <span class="style4">Remaining: <?php echo $plan_limit-$user_limit;  ?> reports out of <?php echo $plan_limit;  ?> in <?php echo $plan_name;  ?> plan.<?php if ($plan_name != "Gold" ) { ?> To get more <a href="/users/plans/" >step up here</a><?php } ?></span> </tr>
          </table>
		  <br />
		  <table width="100%" border="0" >
            <tr align="center">
              <td align="right"><strong>Domain: </strong></td>
			  <!--<input type="hidden" name="data[tool]" id="tools" value="report" >-->
			  <td align="left" >
                <select name="data[tool]" id="tools" onchange="checkOptions(this)">
					<option value="speed_checker">Website Speed Checker</option>
						<option value="keyword_density">Keyword Density Calculator</option>
						<option value="domain_locator">Domain Locator</option>
						<option value="header_analyzer">Find Headers</option>
						<!--<option value="back_links">Backlinks Checker</option>-->
						<option value="domain_availability">Domain Availabilty Checker</option>	
						<option value="rank">Website Rank</option>	
						<option value="report">All in One</option>			
				</select></td>
                <!--<a href="#" style="color:blue">View Reports</a>-->
              <td align="left"><input type="text" name="data[domain]" size="70" id="domain_url" />
              </td>
              <td align="left" ><input type="image" src="/img/Run.png" alt="Run" onclick="return validate()" id='run_button'/>
                <!--<input name="button" type="button" onclick="window.location='/dashboards/'" value="Cancel" /></td>-->
				<img src="/img/cancel.png" alt="Cancel" onclick="window.location='/dashboards/'">
            </tr>
            <tr valign="top">
              <td colspan="3"><div id='choices' style="display:none;" >
                  <table width="569" border="0">
                    <tr>
                      <td width="235" height="38"><span class="style9">Ignore words of: <br />
                        </span></td>
                      <td width="324"><strong>
                        <input type="text" size="4" value="2" name="minoc">
                        &nbsp;characters in length or less. </strong></td>
                    </tr>
                    <tr>
                      <td height="34"><span class="style9">Minimum Occurence:</span></td>
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
                  <p>&nbsp;</p>
                </div></td>
            </tr>
            <!--tr valign="top"> <td height="50"> <strong>Save Research Report As : </strong></td> <td height="50"> <select name="select"> <option value="pdf">pdf</option> </select> </td> <td height="50">&nbsp;</td></tr>-->
            <tr valign="top">
              <td height="45" colspan="4" align="right"><span style="font-size:10px;"> Total Reports: <?php echo count($report_name) ;  ?> </span>
                <?php
							
					if(count($report_name)>0)
					{?>
                <div align="left">
                  <table  width="882px"  id="myTable" border=0 class="tablesorter"  >
                    <thead>
                      <tr >
                        <th   height="21" class="heading" style="font-size:13px;">S.No.</th>
                        <!-- <th width="108" class="heading" style="font-size:13px;">Creation Date</th> -->
                        <th  class="heading" style="font-size:13px;">Name</th>
                        <!--<th  class="heading" style="font-size:13px;">View Report</th>
                        <th  class="heading" style="font-size:13px;">Download Report</th>-->
						<th  class="heading" style="font-size:13px;">Action</th>
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
							$dt=explode(' ',trim($created[$key]));
							$tm=explode(' ',trim($created[$key]));
				
							$dt=explode('-',$dt[0]);
							$tm=explode(':',$tm[1]);
							$dt= date("jS_F_Y_H:i:s", mktime($tm[0],$tm[1],$tm[2],$dt[1],$dt[2],$dt[0]));
					
							echo "<tr class='$class' align='center'>";
							echo "<td >$sno</td>";
							//echo "<td>".$created[$key]."</td>";
							echo "<td>".$dt."</td>";
							
							//echo "<td><a href='/research/view_report/$value' target='_blank'>View </a></td>";
							//echo "<td><a href='/research/download_report/$value'>Download </a></td>";
							echo "<td><a href='/research/view_report/$value' target='_blank'>View </a>&nbsp;<a href='/research/download_report/$value'>Download </a>&nbsp;";
							echo $html->link('Delete',array('controller'=>'research', 'action'=>'delete',$id[$key]),array(),"Are you sure you wish to delete this report?");
							echo "</td></tr>";
						}
						?>
                      <?php  }  ?>
                    </tbody>
                  </table>
                </div>
                <span style="color:#000000;"><strong>
                <?php  if(isset($rank)) echo "Google Rank : " . $rank ; ?>
                </strong></span>
                <div>
                  <?php  if(isset($total_links))echo $total_links ." Links Found" ; ?>
                </div>
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
                <table width="876" height="37"  style="border:1px solid black;">
                  <thead>
                    <tr>
                      <td width="385" bgcolor="#0099CC"><strong>Links</strong></td>
                      <td width="479"  bgcolor="#0099CC"><strong>Title</strong></td>
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
                </table></td>
            </tr>
          </table>
        </form></td>
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
	{
		//document.getElementById('run_button').disabled=true;
		//document.getElementById('run_button').value='Please Wait..';
		return true;
	}
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
  //alert("Your domain name is too short/long");
	    message+="Your domain name is too short/long<br>";
		 return false;
}	

return true;
}
</script>
<?php
	
	echo $html->css('style',false);
?>
<script>
$(document).ready(function() 
{ 
	$("#myTable").tablesorter(); 
} 
); 
</script>
<!-- Script by hscripts.com -->
