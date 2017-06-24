<?php  
class Dispatchers{

	var $request;

	function __construct(){
		$this->request = new Requests();
		Router::parse($this->request->url, $this->request);
		$controller = $this->loadController();
		$action = $this->request->action;
		if ($this->request->prefix) {
			$action = $this->request->prefix.'_'.$action;
		}
		if(!in_array($action, array_diff(get_class_methods($controller), get_class_methods('Controllers')))) {
			$this->error("le controller ".$this->request->controller." n'a pas de methods ".$action);
		}
		call_user_func_array(array($controller, $action), $this->request->params);
		$controller->render($action);
	}

	function error($message){
		$controller = new Controllers($this->request);
		$controller->e404($message);
	}

	function loadController(){
		$name = ucfirst($this->request->controller).'Controller';
		$file = CORE.DS.'Controllers'.DS.$name.'.php';
		if (!file_exists($file)) {
			$this->error('le controller '.$this->request->controller.' n\'existe pas');
		}
		require($file);
		$controller = new $name($this->request);
		
		return $controller;

	}
}