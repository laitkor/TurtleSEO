<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Google App</title>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
</head>

<body>
<script language="javascript" type="text/javascript">
google.load("gdata", "1.x");
google.setOnLoadCallback(initApp);

function initApp(){	
	getMyPosts();
}
var scope =  "http://www.blogger.com/feeds";
function logMeIn() {
  var token = google.accounts.user.login(scope);
}

function setupMyService() {
  //var myService =  new google.gdata.blogger.BloggerService('exampleCo-exampleApp-1');
  var myService = new google.gdata.blogger.BloggerService('Laitkor-postBlogger-1.0');
  if (google.accounts.user.checkLogin(scope)) {
	
  }else{
	logMeIn();    
  }
  return myService;
}

function getMyPosts(){
	
	var bloggerService = setupMyService();
	// The feed URI ued to retrieve a list of blogs for a particular logged-in user
	var feedUri = 'http://www.blogger.com/feeds/default/blogs';
	
	// The callback method invoked when getBlogFeed() returns the list of our blogs
	var handleBlogFeed = function(blogFeedRoot) {
		alert(blogFeedRoot)
	  var blogEntries = blogFeedRoot.feed.getEntries();
	
	  // Get list of posts for each blog
	  for (var i = 0, blogEntry; blogEntry = blogEntries[i]; i++) {
		var postsFeedUri = blogEntry.getEntryPostLink().getHref();
		var query = new google.gdata.blogger.BlogPostQuery(postsFeedUri);
	
		// Set the maximum number of blog posts to return
		query.setMaxResults(25);
		
		bloggerService.getBlogPostFeed(query, handleBlogPostFeed, handleError);
	  }
	};
	
	// A callback method invoked getBlogPostFeed() returns data
	var handleBlogPostFeed = function(postsFeedRoot) {
	  var posts = postsFeedRoot.feed.getEntries();
	  
	  // Display blog's title
	  PRINT('Blog title: ' + postsFeedRoot.feed.getTitle().getText());
	  
	  for (var i = 0, post; post = posts[i]; i++) {
		var postTitle = post.getTitle().getText();
		var postURL = post.getHtmlLink().getHref();
	 
		PRINT('post: <b><a href="' + postURL + '" target="_blank">' + postTitle + '</a></b>');
	  }
	  PRINT('');
	};
	
	var handleError = function(error) {
	  alert(error);
	};
	
	bloggerService.getBlogFeed(feedUri, handleBlogFeed, handleError);	
}
</script>
</body>
</html>