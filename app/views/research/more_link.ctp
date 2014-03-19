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
<table width="89%" style="width: 100%;">
		<tbody>
			<tr>
				<td width="271" valign="top" style="width: 15em;">
				<?php echo $this->element('menu',array('link_name' => 'research')); ?></td>
				<td width="952" valign="top" >
					<div align="left"><?php  echo $total_links ." Links Found" ; ?><a href='/research/'> Back To Research   </a></div>
					<?php
						if(isset($back_links))
						{
							if(!empty($back_links))
							{	
														
								if(isset($pre))
								{
									echo "<div align='right' ><a href='/research/more_link/$pre/$url'> << Previous | </a>";
								}
								
								if(isset($next))
								{
									echo "<a href='/research/more_link/$next/$url'> Next >> </a></div>";
								}
							}
						
					?>
							
							<table width="1133"  height="37"  style="border:1px solid black;">
							<thead>
							<tr>
								
								 <td width="566" bgcolor="#0099CC" >Links</strong></td>
								 <td width="515" bgcolor="#0099CC" >Title</strong></td>
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
										echo "<tr class='$class' >";
										echo "<td width='380' ><a href='$value' target='_blank'>".$value."</a></td>";
										echo "<td width='380'><b>".$tit[$key]."</b></td>";
							
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
			  </td>
			</tr>
	</tbody>
</table>


