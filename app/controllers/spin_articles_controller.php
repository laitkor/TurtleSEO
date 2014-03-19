<?php
class SpinArticlesController extends AppController {

	var $name = 'spin_articles';
	var $helpers = array('Html','Ajax','Javascript');
	var $uses ="";
	
	
	function index()
	{
		$this->render('index');
	}
	
	function multipleVersions()
	{
		$message="";
		$string=trim($this->data['content']);
		if($string!="")
		{
			for($i=1;$i<=50;$i++)
			$message.= $this->_nested_spin($string, false).'<br /><br />'; 
			$this->set('message',$message);
		}	
		$this->render('index');
	}	
	
	/**************************Working ******************************************************************/

	
	/**
	Source :http://www.paul-norman.co.uk/2009/06/spin-text-for-seo/
	$string = '{{The|A}} {{quick|speedy|fast}} {{brown|black|red}} {{fox|wolf}} {{jumped|bounded|hopped|skipped}} over the
				{{lazy|tired}}{{dog|hound}}';

		echo '<p><b>'.$this->_spin2($string, false, true).'</b> permutations...</p><p>';

		for($i = 1; $i <10; $i++)
		{
			echo $this->_spin2($string, false).'<br />';
		}

		echo '</p>';
	
	*/
	/*
	function _spin2($string, $seedPageName = true, $calculate = false, $openingConstruct = '{{', $closingConstruct = '}}')
	{
		# Choose whether to return the string or the number of permutations
		$return = 'string';
		if($calculate)
		{
			$permutations   = 1;
			$return         = 'permutations';
		}

		# If we have nothing to spin just exit (don't use a regexp)
		if(strpos($string, $openingConstruct) === false)
		{
			return $$return;
		}
   
		if(preg_match_all('!'.$openingConstruct.'(.*?)'.$closingConstruct.'!s', $string, $matches))
		{
			# Optional, always show a particular combination on the page
			if($seedPageName)
			{
				mt_srand(crc32($_SERVER['REQUEST_URI']));
			}

			$find       = array();
			$replace    = array();

			foreach($matches[0] as $key => $match)
			{
				$choices = explode('|', $matches[1][$key]);

				if($calculate)
				{
					$permutations *= count($choices);
				}
				else
				{
					$find[]     = $match;
					$replace[]  = $choices[mt_rand(0, count($choices) - 1)];
				}
			}
		
			if(!$calculate)
			{
				# Ensure multiple instances of the same spinning combinations will spin differently
				$string = $this->_str_replace_first($find, $replace, $string);
				//$string=str_replace($find,$replace,$string);
			}
		
		}
		return $$return;
	}  //end _spin2

	
	# Similar to str_replace, but only replaces the first instance of the needle
	function _str_replace_first($find, $replace, $string)
	{
		# Ensure we are dealing with arrays
		if(!is_array($find))
		{
			$find = array($find);
		}

		if(!is_array($replace))
		{
			$replace = array($replace);
		}

		foreach($find as $key => $value)
		{
			if(($pos = strpos($string, $value)) !== false)
			{
				# If we have no replacement make it empty
				if(!isset($replace[$key]))
				{
					$replace[$key] = '';
				}
				$string = mb_substr($string, 0, $pos).$replace[$key].mb_substr($string, $pos + mb_strlen($value));
			}
		}	
		return $string;
	}
	
	
		
		
	function multipleVersions()
	{
		
		
	  // $string = '{{The|A}} {{quick|speedy|fast}} {{brown|black|red}} {{fox|wolf}} //{{jumped|bounded|hopped|skipped}} over the
	//			{{lazy|tired}}{{dog|hound}}';
				
		//$string = '{{The|A}}       {{brown|black|red}} {{fox|wolf}} //{{jumped|bounded|hopped|skipped}} over the
				//{{lazy|tired}}{{dog|hound}}';   
			
			
		$string=trim($this->data['content']);
		$permutations=$this->_spin2($string, false, true);
		
		// for showing only 50 variations
		if($permutations>=50)
		$different=50;
		else
		$different=$permutations;
		$message="";
		//echo $this->_spin2($string, false);
        //exit;
		//echo '<p><b>'.$permutations.'</b> permutations...</p><br><br><p style="line-height:10px">';
		for($i = 1; $i <= $different; $i++)
		{
			$message.= $this->_spin2($string, false).'<br /><br />';
		}
	
		// '</p>';
		$this->set('message',$message);
		$this->render('index');
		
	}
	
	 
    */

 

}//end class
	

?>