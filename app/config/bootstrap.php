<?php
/* SVN FILE: $Id$ */
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 *
 * This file is loaded automatically by the app/webroot/index.php file after the core bootstrap.php is loaded
 * This is an application wide file to load any function that is not used within a class define.
 * You can also use this to include or require any files in your application.
 *
 */
/**
 * The settings below can be used to set additional paths to models, views and controllers.
 * This is related to Ticket #470 (https://trac.cakephp.org/ticket/470)
 *
 * $modelPaths = array('full path to models', 'second full path to models', 'etc...');
 * $viewPaths = array('this path to views', 'second full path to views', 'etc...');
 * $controllerPaths = array('this path to controllers', 'second full path to controllers', 'etc...');
 *
 */
//EOF
define('NO_OF_SPIN', 20);   //using when spinning articles

define('PING_API_KEY', 'ENTER YOUR PING_API_KEY');        //for ping.fm api key
define('PING_APPLICATION_KEY', 'ENTER YOUR PING_APPLICATION_KEY');        //for ping.fm application key
define('SPLIT_CONTENT',100) ;  //used when sending social content because sns allows specific no. of characters to send data
define("GEOLOCATION_SERVER", "http://www.ipinfodb.com/ip_query.php?");
define("GEOLOCATION_BACKUP_SERVER", "http://backup.ipinfodb.com/ip_query.php?");

define("YAHOO_API_KEY",'ENTER YOUR YAHOO_API_KEY');

define("COMPANY_NAME",'YOUR COMPANY NAME');

define("ACCESS_KEY_ID", "YOUR AWS ACCESS_KEY_ID");
define("SECRET_ACCESS_KEY", "YOUR AWS SECRET_ACCESS_KEY");
define("SERVICE_ENDPOINT", "http://awis.amazonaws.com?");

define("ADMIN_MAIL", "admin@yourdomain.com");  //used for sending admin mails

define('CONSUMER_KEY', 'ENTER YOUR CONSUMER_KEY');
define('CONSUMER_SECRET', 'ENTER YOUR CONSUMER_SECRET');

?>
