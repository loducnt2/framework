<?php 

	namespace app\core;
	use app\core\Registry;
	use app\core\QueryBuilder;
	use app\core\Session;
	/**
	* 
	*/
	class User
	{
		protected $_sessionName;
		protected $_newSessionName;
		private $_data;

		private $_isLoggedIn;
		function __construct()
		{
			$this->config = Registry::getIntance()->config;
			$this->_sessionName = $this->config['session_name'];


	
				if (Session::exists($this->_sessionName)) {
					$user = Session::get($this->_sessionName);
					$this->_newSessionName = "'".Session::get($this->_sessionName)."'";

					$find_user = QueryBuilder::table('users')
							->find($this->_newSessionName);

					$count_User = 0;
					foreach ($find_user as $key => $value) {
						$count_User++;
					}
					if ($count_User > 0) {
						$this->_isLoggedIn  = true;
					}else{
						// Logout
					}
				}else{

				}

			
		}

		/*public function find($user = null){
				//$field = (is_numeric($user)) ? 'id' : 'username';

				$new_user = "'".$user."'";
				$new_password = "'".$password."'";
				$builder =  QueryBuilder::table('users')
								->where('username', '=', $new_user)
								->where('password', '=', $new_password)
								->get();
				$dem = 0;
				foreach ($builder as $key => $check) {
					$dem++;
				}
				if ($dem > 0) {
					$this->_data = $builder;
					return true;
				}
			return false;
		}*/
		public function login($username = null, $password = null){
			$new_user = "'".$username."'";
			$new_password = "'".$password."'";
			$builder =  QueryBuilder::table('users')
					->where('username', '=', $new_user)
					->where('password', '=', $new_password)
					->get();

			$dem = 0;
			foreach ($builder as $key => $check) {
				$dem++;
				$id = $check['id'];
				$username = $check['username'];
				$password = $check['password'];
				$name = $check['name'];
			}
			if ($dem > 0) {
				Session::put($this->_sessionName, $id);
				return true;
			}
			return false;
		}

		public function logout(){
			Session::delete($this->_sessionName);
		}

		public function isLogIn(){
			return $this->_isLoggedIn;
		}


	}

 ?>