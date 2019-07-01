<?php 
	
	namespace app\core;

	use app\core\Session;
	/**
	* 
	*/
	session_start();
	class Token
	{
		private static $token_g;
		private static $config;
		
		function __construct()
		{
			self::$config = Registry::getIntance()->config;
			self::$token_g = self::$config['token_name'];
		}
		public static function generate(){
			return Session::put(self::$token_g, md5(uniqid()));
		}
		public static function check($token){
			$tokenName = self::$token_g;
			
			if (Session::exists($tokenName) && $token === Session::get($tokenName)) {
				Session::delete($tokenName);
				return true;
			}
			return false;
		}

	}
 ?>