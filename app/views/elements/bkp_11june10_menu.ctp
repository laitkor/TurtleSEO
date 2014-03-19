<style>
/*
	Source of css : http://wiki.hudson-ci.org/display/HUDSON/Dashboard+View
*/
.menuheading {
/*background-color:#223323;*/
background-color:#666666;

border-bottom-style:solid;
border-bottom-width:1px;

padding-bottom:2px;
padding-left:4px;
padding-right:4px;
padding-top:4px;
color:#FF9900;
cursor:pointer;
font-weight:bold;

}
.panelHeader, .menuheading, .pageheader, .sectionbottom {
border-bottom-color:#6699CC;
cursor:pointer;
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

<div style="margin-right: 2em; float: left;border:1px solid #005900;background-color:#FFFFFF;width:80%;" class="navmenu">
	<div class="menuheading" >Blog Manager</div>
  <div class="menuitems"  id="menu1">
		<div class="optionPadded">
		  <a class="link" href="/blogs/create_blog">Create Blog</a>
		</div>
		<!--<ul >
			  	<li ><a href="http://hudson-ci.org/download/">Add</a></li>
			  	<li><a href="http://hudson-ci.org/download/">Edit</a></li>
			  	<li><a href="http://hudson-ci.org/download/">Delete</a></li>
				<li><a href="http://hudson-ci.org/download/">List</a></li>
		  </ul>-->
		<div class="optionPadded">
		
	  <a href="/blogs/add" class="link">Add Blog</a>
	</div>
	<div class="optionPadded">
	  <!-- <a href="/dashboards/" class="link"> -->
	  <a href="/blogs/" class="link"> 
	    <?php if($link_name=='blogs')
			  echo "<font color='red'>Blogs</font>";
			  else
			  echo "Blogs";
			  
		  ?></a>
	</div>
	</div>
	<div class="menuheading" >Manage Article</div>
	<div class="menuitems"  id="menu2">
			<div class="optionPadded">
	  <a href="/articles/add/" class="link">Add Article</a>
	</div>
	
		<div class="optionPadded">
	  <!--<a href="#">List Posted </a>-->
	</div>
			<div class="optionPadded">
	  <a href="/articles/" class="link">
	   <?php if($link_name=='articles')
			  echo "<font color='red'>Articles</font>";
			  else
			  echo "Articles";
			  
		  ?>
	  </a>
	  </div>
	</div>
	<div class="menuheading" >Manage Pages</div>
	<div class="menuitems" id="menu3" >
			<div class="optionPadded">
	  <a href="/blogs/add_page/" class="link">Add Page</a>
	</div>
		<!--	<div class="optionPadded">
	  <a href="#">Edit Page</a>
	</div>-->
			<div class="optionPadded">
	  <a href="/blogs/delete_page" class="link">Delete Page</a>
	</div>
		<!--	<div class="optionPadded">
	  <a href="#">List All</a>
	</div>-->
 </div>
<!-- <div class="menuheading" >Manage Category</div>
	<div class="menuitems" id="menu3" >
			<div class="optionPadded">
	  <a href="#">Add Category</a>
	</div>
	<div class="optionPadded">
	  <a href="#">Delete Category</a>
	</div>
 </div>-->
	<div class="menuheading" >User</div>
	
	
	<div class="menuitems" id="menu4" >
	
	
			<div class="optionPadded">
	  <a href="/users/" class="link">List Profile</a>
	</div>
	<div class="optionPadded">
	  <a href="/users/edit/" class="link">Edit Profile</a>
	</div>
		<!-- <div class="optionPadded">
		  <a href="#">Check Limit</a>
		</div> -->
		<div class="optionPadded">
		  <a href="/users/plans/" class="link">View Plans</a>
		</div>
		<!-- <div class="optionPadded">
		  <a href="/users/change_plan/" class="link">Change Plan</a>
		</div> -->
		<div class="optionPadded">
		  <a href="/users/tell_friend/" class="link">Tell a Friend</a>
		</div>
		<div class="optionPadded">
		  <a href="/users/support/" class="link">Support</a>
		</div>
	</div><!--end  menu item  -->

	<div class="menuheading" >Research</div>
	<div class="menuitems" id="menu5" >
	 <div class="optionPadded">
		  <a href="/research/" class="link">Research</a></div>
	</div><!-- menu item  -->

	<div class="menuheading" >Api Settings</div>
	<div class="menuitems" id="menu6" >
	 
	 <div class="optionPadded">
		  <a href="/api_settings/add" class="link">Add API</a>
		</div>
			<div class="optionPadded">
	  <a href="/api_settings/" class="link" >
		  <?php if($link_name=='list api')
			  echo "<font color='red'>APIs</font>";
			  else
			  echo "APIs";
			  
		  ?>
	  </a>
	</div>
		
		    <!--<div class="optionPadded">
		  <a href="#">Upgrade Plan</a>
		</div>
		-->
	</div><!-- menu item  -->
		
</div><!-- end box -->

<script>
elements=document.getElementsByClassName('link');
for (var i in elements)
{
	if( "<?php echo $link_name ;?>" == elements[i].innerHTML.toLowerCase())
	{
		//alert('glinh');
		elements[i].innerHTML="<font color='red'>"+elements[i].innerHTML+"</font>";
		break;
	}	
}
</script>
