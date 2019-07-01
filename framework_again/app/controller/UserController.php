<?php
	namespace app\controller;

	use app\core\Controller;
	use \App;
	use app\core\QueryBuilder;
	use app\core\Input;
	use app\core\Validate;
	use app\core\Registry;
	use app\models\Product;

	use app\core\Token;
	use app\core\Session;
	use app\core\Hash;
	use app\core\User;
	class UserController extends Controller
	{
		//protected $_sessionName;

		// private $_username;
		// private $_password;
		// private $_newPassword;
		function __construct()
		{
			parent::__construct();
		}
		
		public function index()
		{
			$users = QueryBuilder::table('users')->get();
			return $this->render('show', ['users' => $users]);
		}
		public function getLogin(){
			$this->render('login');
		}
		public function postLogin(){
			if (Input::exists()) {
				//echo Input::get('username');
				$token = Input::get('token');
				if (Token::check($token)) {

					$validate = new Validate();

					$validation = $validate->check($_POST, array(
						'username' => array(
							'required' => true
						),
						'password' => array(
							'required' => true
						)
					));
					if ($validation->passed()) {
						$user = new User();
						$login = $user->login(Input::get('username'), md5(Input::get('password')));
						if ($login) {
							$this->redirect('http://localhost:8080/www/framework_again/public/user');
						}else{
							die('Dang nhap khong thanh cong');
						}

					}else{
						print_r($validation->errors());
					}
				}
			}
		}
		
		public function getLogout(){
			$user = new User();
			$logout = $user->logout();
			return $this->redirect('http://localhost:8080/www/framework_again/public/user');
		}
		public function getUpdate($id)
		{
			$users = QueryBuilder::table('users')
					->find($id);
			return $this->render('update_user', ['users' => $users]);
		}
		public function postUpdate($id){
			$user = QueryBuilder::table('users')
					->where('id', '=', $id)
					->update(
						['username' => md5($_POST['password']), 'name' => $_POST['name']]
					);
			$this->redirect('http://localhost:8080/www/framework_again/public/user');
		}
		public function delete($id)
		{
			$builder = QueryBuilder::table('users')
					->where('id', '=', $id)
					->delete();
			$this->redirect('http://localhost:8080/www/framework_again/public/user');
		}
		

		public function getRegister(){
			$this->render('register');
		}
		public function postRegister(){
			if (Input::exists()) {
				//var_dump(Token::check(Input::get('token')));
				$token = Input::get('token');
				if (Token::check($token)) {

					//echo "run ne";

					$validate = new Validate();

					$validation = $validate->check($_POST, array(
						'username' => array(
							'required' => true,
							'min' => 2,
							'max' => 10,
							'unique' => 'users'
						),
						'password' => array(
							'required' => true,
							'min' => 2
						),
						'password_again' => array(
							'required' => true,
							'matches' => 'password'
						),
						'name' => array(
							'required' => true
						)
					));
					if ($validation->passed()) {
						$username = $_POST['username'];
						$password = md5($_POST['password']);
						$name = $_POST['name'];
						$builder = QueryBuilder::table('users')
								->insert(
									['username' => $username, 'password' => $password, 'name' => $name]
								);
						
						Session::flash('seccess', 'Bạn đã đăng ký tài khoản thành công !!!');
						$this->redirect('http://localhost:8080/www/framework_again/public/user');
					}else{
						//print_r($validation->errors());
						foreach ($validation->errors() as $error) {
							echo $error ."<br>";
						}
					}
				}
			}
		}
		
	}
?>
