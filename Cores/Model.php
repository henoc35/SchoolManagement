<?php
class Model{

	static $connections = [];

	public $conf = 'default';
	public $table = false;
	public $db;
	public $primaryKey = "id";
	public $id;
	public $errors = [];

	public function __construct(){
	//JE ME CONNECTE A LA BASE DE DONNEE

		//J'INITIALISE QUELQUE VARIABLE
		if ($this->table === false) {
			$this->table = strtolower(get_class($this)).'s';
		}
		$conf = Conf::$databases[$this->conf];
		if (isset(Model::$connections[$this->conf])) {
			$this->db = Model::$connections[$this->conf];
			return true;
		}
		try {
			$pdo = new PDO('mysql:host='.$conf['host'].';dbname='.$conf['database'].';',$conf['login'], $conf['password'], [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']);

			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			Model::$connections[$this->conf] = $pdo;
			$this->db = $pdo;

		} catch (Exception $e) {
			if (Conf::$debug >= 1) {
				die($e->getMessage());
			}else{
				die("Impossible de se connecter a la base de donnée");
			}
		}


	}

	public function find($req = []){
		$query = 'SELECT ';

		if (isset($req['fields'])){
			if (is_array($req['fields'])) {
				$query .= implode(', ', $req['fields']);
			}else{
				$query .= $req['fields'];
			}
		}else{
			$query .= '*';
		}

		$query .= ' FROM '.$this->table.' as '.get_class($this).' ';

		// Constructions de la conditions
		if (isset($req['conditions'])) {
			$query .= 'WHERE ';
			if (!is_array($req['conditions'])) {
				$query .= $req['conditions'];
			}else{
				$cond = [];
				foreach ($req['conditions'] as $key => $value) {
					if(!is_numeric($value)){
						$value = '"'./*$this->db->quote(*/$value/*)*/.'"';
					}
					$cond[] = "$key=$value";
				}

				$query .= implode(' AND ', $cond);
			}

		}

		if (isset($req['order'])) {
			$query .= ' ORDER BY ';
			if (!is_array($req['order'])) {
				$query .= $req['order'];
			}
		}

		if (isset($req['limit'])) {
			$query .= ' LIMIT '.$req['limit'];

		}



		//die($query);
		$pre = $this->db->prepare($query);
		$pre->execute();
		return $pre->fetchAll();

	}

	public function findFirst($req){
		return current($this->find($req));

	}

	public function findCount($condition = null){
		$res = $this->findFirst([
			'fields' => 'COUNT('.$this->primaryKey.') as count',
			'conditions' => $condition
		]);

		return $res->count;

	}

	public function delete($id){
		$query = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = $id ";
		$this->db->query($query);
	}

	public function save($data){
		if ($data) {
			$key = $this->primaryKey;
			$fields = [];
			$d = [];
		foreach ($data as $k=>$v) {
			if ($k!=$this->primaryKey) {
				$fields[] = " $k=:$k";
				$d[":$k"] = $v;
			}elseif (!empty($v)) {
				$d[":$k"] = $v;
			}
		}
		if (isset($data->$key) && !empty($data->$key)) {
			$query = 'UPDATE '.$this->table.' SET '.implode(',', $fields).' WHERE '.$key.'=:'.$key;
			$this->id = $data->$key;
			$action = 'update';
		}else{
			$query = 'INSERT INTO '.$this->table.' SET '.implode(',',$fields);
			$action = 'insert';
		}
		//debug($query);
		//debug($d);
		//die();
		$pre = $this->db->prepare($query);
		$pre->execute($d);

		if ($action == 'insert') {
			$this->id = $this->db->lastInsertId();
		}
		}
	}


 	function validates($data){
		$errors = [];
		foreach ($this->validate as $key => $value) {
			if (!isset($data->$key)) {
				$errors[$key] = $value['message'];
			}else{
				if($value['rule'] == 'notEmpty') {
					if(empty($data->$key)){
						$errors[$key] = $value['message'];
					}
				}elseif (!preg_match('/^'.$value['rule'].'$/',$data->$key)) {
					$errors[$key] = $value['message'];
				}
			}
		}
		$this->errors = $errors;
		if (isset($this->Form)) {
			$this->Form->errors = $errors;
		}
		if (empty($errors)) {
			return true;
		}
		return false;
	}

	/**
	*@param $req
	*@param bool[array $params]
	*@return PDOStatement
	*/
	
	public function req($query, $params = false){
		if ($params) {
			$q = $this->db->prepare($query);
      		$q->execute($params);
		} else{
			$q = $this->db->query($query);
		}
                  
      	return $q;
	}

	public function lastInsertId(){
		return $this->db->lastInsertId();
	}

}
?>
