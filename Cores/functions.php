<?php  
function debug($var){
	if (Conf::$debug > 0) {
		$debug = debug_backtrace();
	echo '<p>&nbsp;</p><p><a href="#" onclick="$(this).parent().next(\'ol\').slideToggle(); return false;"><strong>'.$debug[0]['file'].' </strong> 1.'.$debug[0]['line'].'</a></p>';
	echo "<ol style='display: none;'>";
	foreach ($debug as $key => $value) {
		if ($key > 0) {
			echo "<li><strong>".$value['file'].' </strong> 1.'.$value['line']."</li>";
		}
	}
	echo "</ol>";
	echo "<pre>";
	print_r($var);
	echo "</pre>";
	}
}

function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}

function e($string){
	return htmlspecialchars($string);
}


?>