<?php
class Conf{

	static $debug = 1;

	static $databases = [
	'default' => [
		"host"	 	=>	"localhost",
		"database"		=> 	"fertibio",
		"login"			=>	"root",
		"password"			=>	"hunter@57661490"
	]
];
}

Router::prefix('cockpit', 'management');
Router::connect('index', 'pages/index');
Router::connect('en/index', 'en/pages');
Router::connect('actualité/:slug-:id', 'posts/view/id:([0-9]+)/slug:([a-zA-Z0-9\-]+)');
Router::connect('actualité/:action', 'posts/:action');

?>
