<?php
class DensityChecker{
	var $minlength;
	var $minoc;
function getUrl($url)
{
	return file_get_contents($url);	
}

//parse tags function (extracting title,description , keywords of the page)
function _parseTags($page) {
	$page=strtolower($page);
    $title = $description = $keywords = '';
    if (preg_match('/<title>(.*)<\/title>/i',$page,$ar)) $title = $ar[1];
    if (preg_match('/<meta name="description" content="(.*)"/i',$page,$ar)) $description = $ar[1];
    if (preg_match('/<meta name="keywords" content="(.*)"/i',$page,$ar)) $keywords = $ar[1];
    $res = array(
		 'title'=>$title,
		 'description'=>$description,
		 'keywords'=>$keywords,
		 );
    return $res;
  } // _parseTags
 //get text from html 
function getOnlyText($text)
{
	$text=strtolower($text);
	$text=str_replace("\n\r"," ",$text);
	$text=str_replace("\n"," ",$text);
	$text=str_replace("\r"," ",$text);
    //erasing scripts
	$tmp=$this->my_preg_match_all('<script','</script>',$text);
	foreach($tmp as $k=>$v) $text=str_replace($v,'',$text);
	//erasing styles
	$tmp=$this->my_preg_match_all('<style','</style>',$text);
	foreach($tmp as $k=>$v) $text=str_replace($v,'',$text);
	
	//erasing links because we don't count text from hrefs 
	$tmp=$this->my_preg_match_all('<a','</a>',$text);
	foreach($tmp as $k=>$v) $text=str_replace($v,'',$text);
	//erasing options from select 
	$tmp=$this->my_preg_match_all('<option','</option>',$text);
	foreach($tmp as $k=>$v) $text=str_replace($v,'',$text);
	
	
	$tmp=$this->my_preg_match_all('<','>',$text);
	foreach($tmp as $k=>$v) $text=str_replace($v,'',$text);
	//print_r($tmp);
	/*$text=str_replace('>','> ',$text);
	$text=str_replace('<',' <',$text);
	$text = strip_tags($text);
	$text = str_replace("<!--", "&lt;!--", $text);
	$text = preg_replace("/(\<)(.*?)(--\>)/mi", "".nl2br("\\2")."", $text);
	while($text != strip_tags($text)) {$text = strip_tags($text);}
	$text=ereg_replace('&nbsp;'," ",$text);
	$text = ereg_replace("[^[:alpha:]]", " ", $text);*/
	while(strpos($text,'  ')!==false) $text = ereg_replace("  ", " ", $text);
	//echo $text;
	return $this->unhtmlentities($text);
}
function getNrWords($text)
{

	$text = ereg_replace("[^[:alnum:]]", " ", $text);
	while(strpos($text,'  ')!==false) $text = ereg_replace("  ", " ", $text);
	$text=$string=strtolower($text);
	$text=explode(" ",$text);
	return count($text);
}
function getCounts($text)
{

	$text = ereg_replace("[^[:alnum:]]", " ", $text);
	while(strpos($text,'  ')!==false) $text = ereg_replace("  ", " ", $text);
	$text=$string=strtolower($text);
	//echo $text;
	$text=explode(" ",$text);
	$keywords=array();
	$text=array_unique($text);
	$nr_words=$this->nr_cuvinte($string);
	foreach($text as $t=>$k)
	{
		$nr_finds=$this->nr_gasiri($k,$string);	
		//here we will need to put min of the appearencies and min length
		if($nr_finds>=$this->minoc && strlen($k)>=$this->minlength) $keywords[$k]=$nr_finds;	
	}
	arsort($keywords);
	return $keywords;
}
function getCounts_2($text)
{
	$text = ereg_replace("[^[:alnum:]]", " ", $text);
	while(strpos($text,'  ')!==false) $text = ereg_replace("  ", " ", $text);
	$text=$string=strtolower($text);
	$text=explode(" ",$text);
	$new_text=array();
	$i=0;
	foreach($text as $k=>$t)
	{
		if(strlen(trim($t))>0) $new_text[$i]=trim($t);
		$i++;
	}
	$text=$new_text;
	$keywords=array();
	//making array with 2 words
	while (list($key, $val) = each($text)) 
	{
		$tmp=$val;
		list($key, $val) = each($text);
		$tmp=$tmp." ".$val;
		$nr_finds=$this->nr_gasiri($tmp,$string);
		if($nr_finds>=$this->minoc && strlen($tmp)>=2*$this->minlength) $keywords[$tmp]=$nr_finds;	
	}
	arsort($keywords);
	return $keywords;
}
function getCounts_3($text)
{
	$text = ereg_replace("[^[:alnum:]]", " ", $text);
	while(strpos($text,'  ')!==false) $text = ereg_replace("  ", " ", $text);
	$text=$string=strtolower($text);
	$text=explode(" ",$text);
	$new_text=array();
	$i=0;
	foreach($text as $k=>$t)
	{
		if(strlen(trim($t))>0) $new_text[$i]=trim($t);
		$i++;
	}
	$text=$new_text;
	
	$keywords=array();
	//making array with 3 words
	while (list($key, $val) = each($text)) 
	{
		$tmp=$val;
		list($key, $val) = each($text);
		$tmp=$tmp." ".$val;
		list($key, $val) = each($text);
		$tmp=$tmp." ".$val;
		$nr_finds=$this->nr_gasiri($tmp,$string);
		if($nr_finds>=$this->minoc && strlen($tmp)>=3*$this->minlength) $keywords[$tmp]=$nr_finds;	
	}
	arsort($keywords);
	return $keywords;
}

function nr_cuvinte($str)
{
	$tmp=0;
	$tok = strtok ($str," ");
    while ($tok) {
	$tmp++;
    $tok = strtok (" ");
	}
	return $tmp;
}
function nr_gasiri($key,$string)
{
	$q=0;
	$nr=0;
	$key=strtolower($key);
	$string=strtolower($string);
	while($q==0)
	{

		$pos = @strpos($string,$key);
  		if ($pos===false) $q=1;
		else 
		{
			$string = substr ($string,$pos+strlen($key));
			$nr++;
		}
	}
	return $nr;
}
function my_preg_match_all($start,$end,$string)
{
	$res=array();
	while(strpos($string,$start)!==FALSE && strpos($string,$end)!==FALSE)
	{
		$first=strpos($string,$start);
		$string=substr($string,$first);
		$last=strpos($string,$end);
		$res[]=substr($string,0,$last+strlen($end));
		$length=$last;
		$string=substr($string,$length);
	}
	return $res;
}
function unhtmlentities($string)
{
   $trans_tbl = get_html_translation_table(HTML_ENTITIES);
   $trans_tbl = array_flip($trans_tbl);
   return strtr($string, $trans_tbl);
}
}
/*
while(strpos($text,'  ')!==false) $text = ereg_replace("  ", " ", $text);
	$text=$string=strtolower($text);
	$text=explode(" ",$text);
	$keywords=array();
	$text=array_unique($text);
	$nr_words=$this->nr_cuvinte($string);
	foreach($text as $t=>$k)
	{
		$nr_finds=$this->nr_gasiri($k,$string);	
		//here we will need to put min of the appearencies and min length
		if($nr_finds>=2 && strlen($k)>=3) $keywords[$k]=$nr_finds;	
	}
	arsort($keywords);
	print_r($keywords);
*/
?>
