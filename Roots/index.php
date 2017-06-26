<?php 
define('WEBROOT' ,dirname(__FILE__));
define('ROOT' ,dirname(WEBROOT));
define('DS', DIRECTORY_SEPARATOR);
define('CORE', ROOT.DS.'Cores');

define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
define('BASE', dirname($_SERVER['SCRIPT_NAME']));
define('WEBSITE_NAME', 'NathanSchool');

require(CORE.DS.'Includes.php');
new Dispatchers();
?>
