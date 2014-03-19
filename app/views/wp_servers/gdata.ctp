<?php if($close =="1"){ ?>
<script language="javascript">
window.close();
</script>
<?php die;} ?>
<div id="wrapper" style="background:url(/img/bg.png) repeat-x; margin:0; padding:0;">
<img src="/img/logo.png"  border="0"/>
<div class="header">
	<img src="/img/blogpress.png" alt="Blog.press (Blogger Client)" width=1 height=1/>
    
	<div id="loginNotice" style="color:#fff; display:none">
	  Because this is a third-party app that uses your Google account authentication, you'll need to grant access to it by clicking the "Login" button. 
	</div>
    <div align="right" style="width:200px;">
    <input id="authButton" type="button" value="Authenticate" onClick="loginOrLogout()"/>&nbsp;&nbsp;
    <input id="close" type="button" value="Close" onClick="javascript:window.close();"/>&nbsp;&nbsp;	
    </div>
</div>
<br><br>
<?php if($myact == "add"){?>
<script language="javascript">
	function initApp(){
		init();
	}
</script>
<form method="POST">
<input type="hidden" name="data[user_id]" value="<?php echo $userid; ?>"/> 
<?php echo $hiddenfield; ?>
<div id="statusDiv" class="centered"></div>
</form>
<?php } ?>

<?php if($myact == "post"){?>
<script language="javascript" src="http://code.jquery.com/jquery-1.4.2.min.js"></script>
<script language="javascript">
	function initApp(){
		initPost();
		switchView(1);
	}
</script>
<div style="display:none">
<span class="sublink" id="sublink0">
<a href="javascript:switchView(0)" id="sublink0a">Show All Posts</a></span>&nbsp;&nbsp;
<span class="sublink" id="sublink1"><a href="javascript:switchView(1)" id="sublink1a">Create New Post</a></span>
</div>
<br />	
<div id="statusDiv" class="centered"></div>
<div id="createOrEditDiv" class="centered" style="display: none;">
  <input type="hidden" id="blogPostEditUri"></input>

  <table style="width:100%">
  <tr><td><span class="title">Title</span></td></tr>
  <tr><td>
  <input type="text" id="blogPostTitleInput" value="<?php echo $ptitle;?>" style="width:100%" />
  </td></tr>
  <tr><td><span class="title">Content </span></td></tr>
  <tr><td>
  <textarea rows="10" id="blogPostTextArea" style="width:100%"><?php echo $description;?></textarea>

  </td></tr>
  <tr><td><span class="title"> Meta Tags</span></td></tr>
  <tr><td>
  <input type="text" id="blogPostCategoriesInput" style="width:100%" value="<?php echo $meta_desc;?>" />
  </td></tr>
  <tr><td style="text-align: right">
  <input type="button" id="draftButton" value="Save Draft" style="display:none" onClick="insertOrUpdatePostEntry(true);" />
  <input type="button" id="showbtn" value="Show All" onClick="switchView(0);" />
  <input type="button" id="publishButton" value="Publish" onClick="insertOrUpdatePostEntry();" />

  </td></tr>
  </table>
</div>
<div id="showAllPostsDiv" style="display: none;"></div>
<?php } ?>
</div>