<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past 
		header('Content-type: application/pdf');
		header('Content-Disposition: attachment; filename="turtleSEO_brochure.pdf"');
		readfile("http://turtleseo.com/brochure/turtleSEO_brochure.pdf");			
		exit;	
 ?>
