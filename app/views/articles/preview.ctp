<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>{article.page_title}</title>
<meta name="keywords"  content="<?php echo $article['Article']['meta_keywords'] ?>"/>
<meta name="description"  content="<?php echo $article['Article']['meta_desc'] ?>"/>
<style>
body {
	background:url(/img/bg_preview.png);
	background-repeat:repeat-x;
	color: #ffffff;
	font-family:'lucida grande',verdana,helvetica,arial,sans-serif;
	font-size:14px;
	margin: 0;
	top:0;
}

h3 {
color:#0066FF;
}

</style>
</head>

<body>
<h3>Title</h3>
<h1><?php echo $article['Article']['title'] ?></h1>
<p><?php echo $author['Author']['name'] ?></p>
<h3>Description</h3>
<p><?php echo $article['Article']['content'] ?></p>
<p><?php echo $article['Article']['tips'] ?></p>
<!--
<h2>Related Articles :</h2>
<ol >
<?php 
	foreach ($related_article as $art)
	{
		if( $art==null)
		break;
		else
		echo "<li>$art</li>";
	}
?>	
</ol>

<h2>Recommended Articles :</h2>
<ol >
<?php 
	foreach ($recommended_article as $art)
	{
		if( $art==null)
		break;
		else
		echo "<li>$art</li>";
	}
?>
</ol>
-->
<!--
<h2>About Author :</h2>
<p><?php echo $author['Author']['bio'] ?></p>
<p><?php echo $article['Article']['footer'] ?></p>
-->
</body>
</html>
