<?php  
	/**
	* 
	*/
	class AuthentificationsController extends Controllers
	{
		function index(){

		}

		function manager(){
			if ($this->Session->read(WEBSITE_NAME)) {
				$this->redirect('management/pages/dashboard');
				exit();
			}
			if (!empty($_POST)) {
				extract($_POST);
				$login = e($email);
				$passord = e($passord);
				if (!preg_match("/^([a-zA-Z0-9\-._]+)@([a-zA-Z0-9\-.]+)\.[a-zA-Z]{2,3}$/", $login)) {
					echo "mail pas valid";
					$d['errors']['email'] = 'l\'adrese email est incalide';
				}

				if (!$d['errors']) {
					$manager = new Manager();
					$admin = $manager->login($email, $password);
					if ($admin) {
						$this->Session->setFlash('Connexion réussite', 'success');
						$this->redirectIntent('management/pages/dashboard');
							
					}else{	
						$this->Session->setFlash('Combinaisson identifiant mot de passe incorecte', 'warning');
					}	
				}

			}

			$this->setVars(isset($d));
		}
	}
?>