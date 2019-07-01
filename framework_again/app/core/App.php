<?php 
	require_once(dirname(__FILE__).'/Autoload.php');

	use app\core\Registry;
	use app\core\View;
	class App
	{
		private $router;

		function __construct($config)
		{
			new Autoload($config['rootDir']);

			$this->router = new Router($config['basePath']);

			//$view = new View();

			Registry::getIntance()->config = $config;
			//Registry::getIntance()->view = $view;
		}

		public function run(){
			$this->router->run();
		}

	}
?>