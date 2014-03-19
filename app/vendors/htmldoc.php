<?php 
class Htmldoc
{
    var $options;
    var $top = 0;
    var $left = 15;
    var $right = 15;
    var $bottom = 10;
    var $content;
    var $file;
    var $file_created = false;
    var $errarr = array();

    public function __construct( $content,$temp_file ){
        $this->content = $content;
		//$this->temp_file="/tmp/abc.pdf";
        $this->temp_file=$temp_file;
        $this->buildFile();
    }

    public function callError( $msg ){
        $this->errarr[] = $msg;
    }

    function error(){
        foreach($this->errarr as $i => $err ){
            echo $err." n";
        }
    }

    protected function buildFile(){
      // $this->file = WWW_ROOT.$this->temp_file;
     $this->file = tempnam('','');
    
	$handle = fopen($this->file, "w");
    if(fwrite($handle, $this->content)){
        $this->file_created = true;
        }
        fclose($handle);
    }

  function setMargins($top,$left,$right,$bottom){
        $this->top = $top;
        $this->left = $left;
        $this->right = $right;
        $this->bottom = $bottom;
    }

    function buildOptions(){
        //$this->options = "--footer lc/  --top {$this->top} --left {$this->left} --right {$this->right} --bottom {$this->bottom} ";
	    $this->options = "--footer .c/  --top {$this->top} --left {$this->left} --right {$this->right} --bottom {$this->bottom} ";
    
    }

    function testContent(){
        echo $this->content;
    }

    function render(){
        if ( ! $this->file_created ) {
            return false;
        }
        $this->buildOptions();
        # Tell HTMLDOC not to run in CGI mode...
       // putenv("HTMLDOC_NOCGI=1");
        # Write the content type to the client...
      //  header("Content-Type: application/pdf");
    //    flush();
       
	   //exec("htmldoc --webpage --quiet  -f  /var/www/".$this->temp_file."  /var/www/turtleseo/app/webroot/report.html");
	   //$this->log("/usr/bin/htmldoc --webpage --quiet  ".$this->options." -f  ".$this->temp_file."  $this->file");
	   exec("htmldoc --webpage --quiet  ".$this->options." -f  ".$this->temp_file."  $this->file");
	   //exec("htmldoc --webpage -f /var/www/sarang.pdf /var/www/html/bloopio_test/www/smarty/user/login.html");
	 
	    # Run HTMLDOC to provide the PDF file to the user...
        //passthru("htmldoc -t pdf --quiet --jpeg --webpage ".$this->options."'".$this->file."'"." --titlefile /var/www/header.jpg ");
        //passthru("htmldoc --logoimage /var/www/header.jpg -t pdf --quiet --jpeg --webpage --no-title --size A4 ".$this->options."'".$this->file."'");
     //   passthru("htmldoc  -t pdf --quiet --jpeg --webpage --no-title  ".$this->options."'".$this->file."'");
       
	   // delete our file from the server
        unlink( $this->file );
    }

}
?>
