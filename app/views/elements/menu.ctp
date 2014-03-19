<style>
/*
	Source of css : http://wiki.hudson-ci.org/display/HUDSON/Dashboard+View

*/
.link{
margin-left:10px;

}
#m1-div{
background-image:url(/img/Blog-Manager.png);
background-repeat:no-repeat;
text-align:center;
padding-left:0px;
}
#m2-div{
background-image:url(/img/Article.png);
background-repeat:no-repeat;
text-align:center;
padding-left:0px;
}
#m3-div{
background-image:url(/img/Page.png);
background-repeat:no-repeat;
text-align:center;
padding-left:0px;
}

#m4-div{
background-image:url(/img/Categories_icon.png);
background-repeat:no-repeat;
text-align:center;
padding-left:0px;
}
#m5-div{
background-image:url(/img/User.png);
background-repeat:no-repeat;
text-align:center;
padding-left:0px;
}
#m6-div{
background-image:url(/img/User.png);
background-repeat:no-repeat;
text-align:center;
padding-left:0px;
}
#m8-div{
background-image:url(/img/Research_icon.png);
background-repeat:no-repeat;
text-align:center;
padding-left:0px;
}
#m9-div{
background-image:url(/img/google.png);
background-repeat:no-repeat;
text-align:center;
padding-left:0px;
}
#m10-div{
background-image:url(/img/network_icon.png);
background-repeat:no-repeat;
text-align:center;
padding-left:0px;
}
.menuheading {
background-color:#6893ff;

border-bottom-style:solid;
border-bottom-width:1px;

padding-bottom:2px;
padding-left:0px;
padding-right:4px;
padding-top:4px;
color:#ffffff;
/*cursor:pointer;*/
font-weight:bold;

}
.panelHeader, .menuheading, .pageheader, .sectionbottom {
border-bottom-color:#6699CC;
/*cursor:pointer;*/
}
.menuitems {
padding-bottom:20px;
padding-left:4px;
padding-right:4px;
padding-top:4px;
}
.optionPadded {
padding-bottom:2px;
padding-left:2px;
padding-right:2px;
padding-top:2px;
}

.optionPadded a{
color:#000000;
}
.optionPadded a:hover{
color:blue;
}
</style>
<div align="left" style="margin-right: 2em; float: left;border:1px solid #005900;background-color:#FFFFFF;width:95%;" class="navmenu">
  <!--added by Manish-->
  <?php if($show_admin_tab=='1'){ ?>
  <div class="menuheading" >
    <table id="m2-div">
      <tr>
        <td width="25">&nbsp;</td>
        <td>Administrator</td>
      </tr>
    </table>
  </div>
  <div class="menuitems"  id="menu2">
    <div class="optionPadded"> <a href="/users/usersdetaild/" class="link">User Details</a> </div>
    <div class="optionPadded">
      <!--<a href="#">List Posted </a>-->
    </div>
    <div class="optionPadded"> <a href="/users/users_plandetails/" class="link">Plan Details</a> </div>
  </div>
  <!--End added by Manish-->
  <?php } ?>
  <div class="menuheading" >
    <table id="m1-div">
      <tr>
        <td width="25">&nbsp;</td>
        <td>Blog Manager</td>
      </tr>
    </table>
  </div>
  <div class="menuitems"  id="menu1">
    <div class="optionPadded"> <a class="link" href="/blogs/create_blog">Create Blog</a> </div>
    <!--<ul >
			  	<li ><a href="http://hudson-ci.org/download/">Add</a></li>
			  	<li><a href="http://hudson-ci.org/download/">Edit</a></li>
			  	<li><a href="http://hudson-ci.org/download/">Delete</a></li>
				<li><a href="http://hudson-ci.org/download/">List</a></li>
		  </ul>-->
    <div class="optionPadded"> <a href="/blogs/add" class="link">Add Blog</a> </div>
    <div class="optionPadded">
      <!-- <a href="/dashboards/" class="link"> -->
      <a href="/blogs/" class="link">
      <?php if($link_name=='blogs')
			  echo "<font color='red'>Blogs</font>";
			  else
			  echo "Blogs";
			  
		  ?>
      </a> </div>
  </div>
  <div class="menuheading" >
    <table id="m2-div">
      <tr>
        <td width="25">&nbsp;</td>
        <td>Manage Article</td>
      </tr>
    </table>
  </div>
  <div class="menuitems"  id="menu2">
    <div class="optionPadded"> <a href="/articles/add/" class="link">Add Article</a> </div>
    <div class="optionPadded">
      <!--<a href="#">List Posted </a>-->
    </div>
    <div class="optionPadded"> <a href="/articles/" class="link">
      <?php if($link_name=='articles')
			  echo "<font color='red'>Articles</font>";
			  else
			  echo "Articles";
			  
		  ?>
      </a> </div>
  </div>
  <div class="menuheading" >
    <table id="m3-div">
      <tr>
        <td width="25">&nbsp;</td>
        <td>Manage Pages</td>
      </tr>
    </table>
  </div>
  <div class="menuitems" id="menu3" >
    <div class="optionPadded"> <a href="/blogs/add_page/" class="link">Add Page</a> </div>
    <!--	<div class="optionPadded">
	  <a href="#">Edit Page</a>
	</div>-->
    <div class="optionPadded"> <a href="/blogs/delete_page" class="link">Delete Page</a> </div>
    <!--	<div class="optionPadded">
	  <a href="#">List All</a>
	</div>-->
  </div>
  <div class="menuheading" >
    <table id="m4-div">
      <tr>
        <td width="25">&nbsp;</td>
        <td>Manage Categories</td>
      </tr>
    </table>
  </div>
  <div class="menuitems" id="menu3" >
    <div class="optionPadded"> <a href="/maincats/add" class="link">Add Category</a> </div>
    <div class="optionPadded"> <a href="/maincats/" class="link">Categories</a> </div>
  </div>
  <div class="menuheading" >
    <table id="m5-div">
      <tr>
        <td width="25">&nbsp;</td>
        <td align="left">User</td>
      </tr>
    </table>
  </div>
  <div class="menuitems" id="menu4" >
    <!--			<div class="optionPadded">
	  <a href="/users/" class="link">List Profile</a>
	</div>-->
    <div class="optionPadded"> <a href="/users/edit/" class="link">Edit Profile</a> </div>
    <!-- <div class="optionPadded">
		  <a href="#">Check Limit</a>
		</div> -->
    <div class="optionPadded"> <a href="/users/plans/" class="link">Change Plans </a>
      <!--<img src='/img/new_logo.gif' border='0'>-->
    </div>
    <!-- <div class="optionPadded">
		  <a href="/users/change_plan/" class="link">Change Plan</a>
		</div> -->
    <div class="optionPadded"> <a href="/users/tell_friend/" class="link">Tell a Friend</a> </div>
    <div class="optionPadded"> <a href="/users/support/" class="link">Support</a> </div>
  </div>
  <!--end  menu item  -->
  <div class="menuheading" >
    <table id="m8-div">
      <tr>
        <td width="25">&nbsp;</td>
        <td>Research</td>
      </tr>
    </table>
  </div>
  <div class="menuitems" id="menu5" >
    <div class="optionPadded"> <a href="/research/" class="link">Research</a></div>
  </div>
  <!-- menu item  -->
  <!--added by Navneet-->
  <div class="menuheading" >
    <table id="m10-div">
      <tr>
        <td width="25">&nbsp;</td>
        <td>Social Networks</td>
      </tr>
    </table>
  </div>
  <div class="menuitems" id="menu3" >
    <!--<div class="optionPadded">
	  <a href="/users/dashboard/" class="link">Post Status</a>
	</div>-->
    <div class="optionPadded"> <a href="/users/networks/" class="link">Post Updates</a> </div>
  </div>
  <!--End added by Navneet-->
  <div class="menuheading" >
    <table id="m9-div">
      <tr>
        <td width="25">&nbsp;</td>
        <td>Google Analytics API</td>
      </tr>
    </table>
  </div>
  <div class="menuitems" id="menu6" >
    <div class="optionPadded"> <a href="/api_settings/add" class="link">Add API</a> </div>
    <div class="optionPadded"> <a href="/api_settings/" class="link" >
      <?php if($link_name=='list api')
			  echo "<font color='red'>APIs</font>";
			  else
			  echo "APIs";
			  
		  ?>
      </a> </div>
    <!--<div class="optionPadded">
		  <a href="#">Upgrade Plan</a>
		</div>
		-->
  </div>
  <!-- menu item  -->
</div>
<!-- end box -->
<script>
// Manish commented : 25june : Page is giving error in case for this code below. thats what commented.
//elements=document.getElementsByClassName('link');
//for (var i in elements)
//{
//	if( "<?php echo $link_name ;?>" == elements[i].innerHTML.toLowerCase())
//	{
//			alert(elements);
//		elements[i].innerHTML="<font color='red'>"+elements[i].innerHTML+"</font>";
//		break;
//	}	
//}
</script>
