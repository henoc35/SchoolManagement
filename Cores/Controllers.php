<?php  
	/**
	* 
	*/
	class Controllers
	{
	public $request;				// Objet Request
	private $vars     = [];			// Variable a passer a la vue
	public $layout    = 'default'; 	// le layout a utiliser pour rendre la vue
	private $rendered = false;		// Si la vue a été rendu ou pas 

	/**
	* Constructeur
	* @param $request Objet request de notre application	
	**/
	function __construct($request = null){
		$this->Session = new Session();
		//$this->Form = new Form($this);

		if ($request) {
			$this->request = $request; // On stock la request dans l'instance
			require(ROOT.DS.'Secures'.DS.'config'.DS.'hook.php');
		}

		
		
	}

	/**
	* Permet de rendre une vue
	* @param $view Fichier à rendre (chemin depuis view ou nom de la vue)
	**/
	public function render($view){
		//var_dump($this->request);die();
		if ($this->rendered) {
			return false;
		}
		extract($this->vars);
		if($this->request->prefix){
			if (strpos($view, '/') === 0) {
				$view = ROOT.DS.'App'.DS.$this->request->prefix.DS.$view.'.php';
			} else{
				$view = ROOT.DS.'App'.DS.$this->request->prefix.DS.$this->request->controller.DS.$view.'.php';
			}
		}else{
			if (strpos($view, '/') === 0) {
				$view = ROOT.DS.'App'.DS.'clients'.DS.$view.'.php';
			} else{
				$view = ROOT.DS.'App'.DS.'clients'.DS.$this->request->controller.DS.$view.'.php';
			}
		}
			
		ob_start();
		
		require($view);
		/*if (!file_exists($view)) {
			$this->e404('la page demandée n\'existe pas. ');
		}*/
		$content_for_layout = ob_get_clean();
		require ROOT.DS.'App'.DS.'layouts'.DS.$this->layout.'.php';

		$this->rendered = true;
		
	}


	/**
	* Permet d'envoyer les variables $vars à la vue
	*
	**/
	public function setVars($key, $value = null){
		if (is_array($key)) {
			$this->vars += $key;
		} else{
			$this->vars[$key] = $value;
		}
	}

	/**
	*Permet de charger un model
	*/
	function loadModel($name){
		$file = CORE.DS.'Models'.DS.$name.'.php';
		require_once($file);
		if (!isset($this->$name)) {
			$this->$name = new $name;
			if (isset($this->Form)) {
				$this->$name->Form = $this->Form;
			}
		}
	}

	/**
	*Permet de gerer les erreurs 404
	*/
	function e404($message){
		header("HTTP/1.0 404 Not Found");
		$this->setVars('message', $message);
		//$this->layout = "errors";
		$this->render('/errors/404');
		die();
	}

	/**
	*Permet de gerer les erreurs 403
	*/
	function e403($message){
		header("HTTP/1.0 403 Forbidden");
		$this->setVars('message', $message);
		$this->layout = "errors";
		$this->render('/errors/403');
		die();
	}

	/**
	*Permet D'appeler un controller depuis une vue
	*/
	function request($controller, $action){
		$controller .= 'Controller';
		require_once(CORE.DS.'controllers'.DS.$controller.'.php');
		$c = new $controller();
		return $c->$action();
	}

	/**
	*Permet rediriger
	*/
	function redirect($url, $code = null){
		if ($code == 301) {
			header("HTTP/1.1 301 Moved Permanently");
		}
		header("Location: ".Router::url($url));
	}

	/**
	* Permet de faire des rediections internes
	* @param $defaultUrl
	*/
	function redirectIntent($defaultUrl){
		if ($this->Session->read('forwardingUrl')) {
			$url = $this->Session->read('forwardingUrl');
		}else{
			$url = $defaultUrl;
		}
		$url = trim($url, '/');
		$_SESSION['forwardingUrl'] = null;
		$this->redirect($url);
	}
	}
?>