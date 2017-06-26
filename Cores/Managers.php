<?php 
	/**
	* Class Pour la Connexion et l'enregistrement
	*/
	class Manager extends Controllers
	{
		public function __construct(){
			$this->Session = new Session();
		}

		public function connect($user){
			$this->Session->write(WEBSITE_NAME, $user);
		}
		
		public function login($email, $password, $remember = null)
		{
			$this->loadModel('Officer');
			$user = $this->Officer->findFirst([
				'conditions' => ['email'=> $email, 'online' => 1]
			]);

			if ($user) {
				if (password_verify($password, $user->password)) {
		        	$this->connect($user);
		        	return $user;

		        } else{
		        	return false; 
		        }
			}
			
		}

		public function sigin($name, $lastname, $username = null, $email, $password, $birthDate, $sexe, $role)
		{
			$this->loadModel('Officer');
			$passwords = password_hash($password, PASSWORD_BCRYPT);
			$admin = (object) [
						'name' => $name,
						'lastname' => $lastname,
						'username' => $username,
						'email' => $email,
						'password' => $passwords,
						'birthDate' => $birthDate,
						'sexe' => $sexe,
						'created_at' => date("Y-m-d H:i:s"),
						'role' => $role
					];
			
			//Sauvegarde les info de l'utilisateur en sans activation du compte
			$admin->online = 0;
			$good = $this->Officer->save($admin);
			if(!$good){
				return false;
			}
			// Envoie de mail pour vérification de compte
				$destinataire = e($admin->email);
				$expediteur   = 'henocdjabia@districtyakro.ci';
				$reponse      = $expediteur;
				$subject = "Vérification de compte";
				$headers = "MINE-Version: 1.0 \r\n";
				$headers .= "Reply-To: $reponse\r\n";
				$headers .= "From: $expediteur\r\n";
				$headers .= "Content-Type: text/html; charset=\"UTF-8\"\r\n";
				
				$names = e($name).' '.$lastname;
				/*		
				ob_start();
				require(ROOT.DS.'/views/tmpls/emails/articleAdd.tmpl.php');
				$content = ob_get_clean();
				mail($destinataire, $subject, $content, $headers);*/
				return true;
		}

		public function activation(){

		}

		public function isUsed($field, $value, $model = 'Officer'){
			$this->loadModel($model);
			$a = $this->{$model}->findFirst([
				'conditions' =>[$field => $value]
			]);

			return $a;
		}

		public function is_logged_in(){
			if (!$this->session->read('mediasusers')) {
				return false;
			} 
				return $this->session->read('mediasusers');

		}

		public function getMessages($receiver, $sender){
			$this->loadModel('Message');
			$msgs = $this->Message->req("SELECT * FROM messages WHERE (receiver = :membre AND sender = :membre2) OR (receiver = :membre2 AND sender = :membre) ORDER BY id ASC",[
				'membre' => $sender,
				'membre2' => $receiver
				])->fetchAll();
			if ($msgs) {
				return $msgs;
			}else{
				return false;
			}
		}
	}
?>