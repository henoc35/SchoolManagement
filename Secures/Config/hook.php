<?php
	if ($this->request->prefix == 'management') {
		$this->layout = 'admin';

		/*if (!$this->Session->isLogged(SESSION_NAME)) {
			if ($this->Session->user('role') != 'administrateur' || $this->Session->user('role') != 'redacteur' || $this->Session->user('role') != 'contributeur') {
				$this->Session->write('forwardingUrl', $_SERVER['REQUEST_URI']);
				$this->Session->setFlash('Vous devez être authentifié', 'warning');
				$this->redirect('auths/index');
			}
			
		}*/
	}
?>
