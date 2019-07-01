<?php
	namespace app\core;

	use \App;
	use app\core\Registry;
	use app\core\View;

	class Controller extends View
	{
		private $layout = null;
		private $config;


		function __construct()
		{
			$this->config = Registry::getIntance()->config;
			$this->layout = $this->config['layout'];

		}


		public function setLayout($layout){
			$this->layout = $layout;
		}

		public function redirect($url,$isEnd=true,$resPonseCode=302){
			header('Location:'.$url,true,$resPonseCode);
			if( $isEnd )
				die();
		}


		public function view($view, $data=null)
		{
			/*echo "<pre>";
			var_dump(Registry::getIntance());*/
			/*if( is_array($data) ){
				extract($data, EXTR_PREFIX_SAME, "data");
			}else{
				$data = $data;
			}*/
			return $this->render($view, $data);
		}

		// public function render($view,$data=null){
		// 	$rootDir = $this->config['rootDir'];
			
		// 	$content = $this->getViewContent($view, $data);

		// 	if( $this->layout != null ){
		// 		$layoutPath = $rootDir.'/views/'.$this->layout.'.php';
		// 		if( file_exists($layoutPath) ){
		// 			require( $layoutPath );
		// 		}
		// 	}
		// }

		// public function getViewContent($view, $data=null){
		// 	// Goi cai bien dat ten la controler ben Router ay ra(Chính là cái tên Controller đang sử dụng)
		// 	$controller = Registry::getIntance()->controller; 

		// 	$rootDir = $this->config['rootDir'];

		// 	$folderView = strtolower(str_replace('Controller', '', $controller));
		// 	if( is_array($data) )
		// 		extract($data, EXTR_PREFIX_SAME, "data");
		// 	else
		// 		$data = $data;

		// 	$viewPath = $rootDir.'/views/'.$folderView.'/'.$view.'.php';
		// 	if( file_exists($viewPath) ){
		// 		ob_start();
		// 		require( $viewPath );
		// 		return ob_get_clean();
		// 	}
		// }

		// public function renderPatial($view,$data=null){
		// 	$rootDir = $this->config['rootDir'];

		// 	if( is_array($data) )
		// 		extract($data, EXTR_PREFIX_SAME, "data");
		// 	else
		// 		$data = $data;

		// 	$viewPath = $rootDir.'/views/'.$view.'.php';
		// 	if( file_exists($viewPath) ){
		// 		require($viewPath);
		// 	}
		// }

	}

?>