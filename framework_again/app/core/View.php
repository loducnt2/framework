<?php 
	namespace app\core;
	Use eftec\bladeone\BladeOne;
	/**
	* 
	*/
	class View
	{
		
		function __construct()
		{
			$this->render();
		}

		public function render($view, $data=null){
			$views = dirname(dirname(dirname(__FILE__))). '/'; 
			$cache = dirname(dirname(dirname(__FILE__))). '/cache';
			
			$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

			
			//var_dump($data);
			return $blade->run($view, $data);

		}

	}

 ?>