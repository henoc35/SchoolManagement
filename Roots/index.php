<?php 
define('WEBROOT' ,dirname(__FILE__));
define('ROOT' ,dirname(WEBROOT));
define('DS', DIRECTORY_SEPARATOR);
define('CORE', ROOT.DS.'Cores');

define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
define('BASE', dirname($_SERVER['SCRIPT_NAME']));
define('SESSION_NAME', 'fertibioAdministration'.date("Y-m"));
define('SESSION_COOKIE', 'fertibioAdministration'.date("Y-m"));


//require(CORE.DS.'includes.php');
//new Dispatcher();
?>
<pre>
	<?php var_dump($_SERVER); ?>
</pre>