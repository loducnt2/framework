<?php

	namespace app\core;
	/**
	* 
	*/
	class Registry
	{
		private static $intance;
		private $storage; // Registry : quản lý các biến toàn cục

		private function __construct()
		{
		}
		public static function getIntance(){ // Singleon -  Khởi tạo đ.tượng (Nếu có rồi thì thôi)
			if( !isset(self::$intance) )
				self::$intance = new Registry;
			return self::$intance;
		}

		// Registry : quản lý các biến toàn cục
		public function __set($name,$value){
			if( !isset($this->storage[$name]) )
				$this->storage[$name] = $value;
			else
				die("Can't not set \"$value\" to \"$name\", $name already exists");
		}
		public function __get($name){
			if( isset($this->storage[$name]) )
				return $this->storage[$name];
			return null;
		}
	}

?>