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
	}
?>