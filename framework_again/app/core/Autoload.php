<?php
	
	/**
	* 
	*/
	class Autoload
	{
		private $rootDir;
		function __construct($rootDir)
		{
			$this->rootDir = $rootDir;
			spl_autoload_register([$this,'autoLoad']);
			$this->autoLoadFile();
		}

		public function autoLoad($class){

			$t = explode('\\', $class);
			$fileName = end($t);

			$filePath = $this->rootDir.'\\'.strtolower(str_replace($fileName, '', $class)).$fileName.'.php';

			if( file_exists($filePath) )
				require_once($filePath);
			else
				throw new Exception("$class does not exsits");
		}

		private function autoLoadFile(){
			foreach( $this->defaulFileLoad() as $file ){
				require_once( $this->rootDir .'/'.$file );
			}
		}

		private function defaulFileLoad(){
			return [
				'app/core/Router.php',
				'app/routers.php',
				'app/core/Token.php'
			];
		}

		// protected function autoLoadBlade(){
		// 	$views = dirname(dirname(dirname(__FILE__))). '/views/home'; 
		// 	$cache = dirname(dirname(dirname(__FILE__))). '/cache';
			
		// 	$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);
		// 	/*
		// 	echo "string";
		// 	die;*/
		// 	return $blade->run("hello", array("variable1" => "value test blade"));
		// 	/*echo $views;
		// 	die;*/
		// }

	}

?>