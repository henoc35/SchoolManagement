<?php  
class Session{
	
	public function __construct(){
		if(!isset($_SESSION)){
			session_start();
		}
	}

	public function setFlash($message, $type = info){
		$_SESSION['flash'] = [
			'message' => $message,
			'type'    => $type
		];
	}

	public function flash(){
		if (isset($_SESSION['flash']['message'])) {
			$flash = '';
	
		if($_SESSION['flash']['type'] == 'notif'){
			$flash .= '<div id="card-alert" class="card light-blue">
                      <div class="card-content white-text">
                        <p><i class="mdi-social-notifications"></i> NEWS : '.$_SESSION['flash']['message']
				.'</p>
                      </div>
                    </div>';
		}elseif ($_SESSION['flash']['type'] == 'info') {
			$flash .= '<div id="card-alert" class="card deep-purple">
                      <div class="card-content white-text">
                        <p><i class="mdi-action-info-outline"></i> INFO : '.$_SESSION['flash']['message']
				.'</p>
                      </div>

                        <span aria-hidden="true">×</span>
                      </button>
                    </div>';
		}elseif ($_SESSION['flash']['type'] == 'success') {
			$flash .= '<div id="card-alert" class="card green">
                      <div class="card-content white-text">
                        <p><i class="mdi-navigation-check"></i> SUCCESS : '.$_SESSION['flash']['message']
				.'</p>
                      </div>

                        <span aria-hidden="true">×</span>
                      </button>
                    </div>';
		}elseif ($_SESSION['flash']['type'] == 'danger') {
			$flash .= '<div id="card-alert" class="card red">
                      <div class="card-content white-text">
                        <p><i class="mdi-alert-error"></i> DANGER : '.$_SESSION['flash']['message']
				.'</p>
                      </div>

                        <span aria-hidden="true">×</span>
                      </button>
                    </div>';
		}elseif ($_SESSION['flash']['type'] == 'warning') {
			$flash .= '<div id="card-alert" class="card orange">
                      <div class="card-content white-text">
                        <p><i class="mdi-alert-warning"></i> WARNING : '.$_SESSION['flash']['message']
				.'</p>
                      </div>

                        <span aria-hidden="true">×</span>
                      </button>
                    </div>';
		}
			
			$_SESSION['flash'] = [];
			return $flash;
		}
			
	}

	public function read($key = null){
		if ($key) {
			if (isset($_SESSION[$key])) {
				return $_SESSION[$key];
			}else{
				return false;
			}
		}else{
			return $_SESSION;
		}
	}

	public function write($key, $value){
		$_SESSION[$key] = $value;
	}

	public function delete($key){
		unset($_SESSION[$key]);
	}

	public function isLogged($keu){
		return isset($_SESSION[$keu]->role);
	}

	public function user($key){
		if ($this->read(WEBSITE_NAME)) {
			if (isset($this->read(WEBSITE_NAME)->$key)) {
				return $this->read(WEBSITE_NAME)->$key;
			}else{
				return false;
			}
		}
		return false;
	} 
	
}
?>