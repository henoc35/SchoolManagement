<?php
class Router{

	static $routes = [];
	static $prefixes = [];

	static function prefix($url, $prefix){
		self::$prefixes[$url] = $prefix;
	}
/**
* permet de parser une url
* @params $url Url a perser
* @return tableau contenant les paramètres
*/
	static function parse($url, $request){
		$url = trim($url, '/');

		if (empty($url)) {
			$url = Router::$routes[0]['url'];
		}else{
			foreach (Router::$routes as $v) {
				if (preg_match($v['catcher'], $url, $match)) {
					$request->controller = $v['controller'];
			$request->action = isset($match['action']) ? $match['action'] : $v['action'];
					$request->params = [];
					foreach ($v['params'] as $key => $v) {
						$request->params[$key] = $match[$key];
					}
					if (!empty($match['args'])) {
						$request->params += explode('/',trim($match['args'],'/'));
					}
					return $request;
				}
			}
		}

		

		$params = explode('/', $url);
		if (in_array($params[0], array_keys(self::$prefixes))) {
			$request->prefix = self::$prefixes[$params[0]];
			array_shift($params);
		}
		//debug($request); die();
		$request->controller = $params[0];
		$request->action = isset($params[1]) ? $params[1] : 'index';
		foreach (self::$prefixes as $k => $v) {
			if (strpos($request->action, $v.'_') === 0) {
				$request->prefix = $v;
				$request->action = str_replace($v.'_', '', $request->action);
			}
		}
 		$request->params = array_slice($params, 2);
		return true;
	}

	/**
	*Connect
	*/
	static function Connect($redir, $url){
		$r = [];

		$r['params'] = [];

		$r['url'] = $url;

		$r['redir'] = $redir;

		$r['origin'] = str_replace(':action', '(?P<action>([a-zA-Z0-9\-]+))', $url);

		$r['origin'] = preg_replace('/([a-zA-Z0-9]+):([^\/]+)/', '${1}:(?P<${1}>${2})', $r['origin']);

		$r['origin'] = '/^'.str_replace('/', '\/', $r['origin']).'(?P<args>\/?.*)$/';

		$params = explode('/', $url);
		foreach ($params as $key => $value) {
			if (strpos($value, ':')) {
				$p = explode(':', $value);
				$r['params'][$p[0]] = $p[1];
			}else{
				if ($key == 0) {
					$r['controller'] = $value;
				}elseif ($key == 1) {
					$r['action'] = $value;
				}
			}
		}

		$r['catcher'] = $redir;

		$r['catcher'] = str_replace(':action', '(?P<action>([a-zA-Z0-9\-]+))', $r['catcher']);

		foreach ($r['params'] as $key => $value) {
			$r['catcher'] = str_replace(":$key", "(?P<$key>$value)", $r['catcher']);
		}

		$r['catcher'] = '/^'.str_replace('/', '\/', $r['catcher']).'(?P<args>\/?.*)$/';

		self::$routes[] = $r;
	}

	/**
	*
	*/
	static function url($url){
		foreach (self::$routes as $v) {
			if (preg_match($v['origin'], $url, $match)) {
				foreach ($match as $key => $w) {
					if (!is_numeric($key)) {
						$v['redir'] = str_replace(":$key", $w, $v['redir']);
					}
				}
				return BASE_URL.str_replace('//', '/', $v['redir']).$match['args'];
			}
		}
		foreach (self::$prefixes as $key => $value) {

			if (strpos($url, $value) === 0) {
				$url = str_replace($value, $key, $url);
			}
		}
		$a = str_replace('\\', '/', BASE_URL) ;
		//return BASE_URL.$url; default
		return $a.$url;
	}

	static function webroot($url){
		trim($url, '/');
		return BASE_URL.$url;
	}
}