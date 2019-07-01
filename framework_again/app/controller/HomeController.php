<?php
	namespace app\controller;

	use app\core\Controller;
	use \App;
	use app\core\QueryBuilder;
	use app\core\Input;
	use app\core\Validate;
	use app\core\Registry;
	use app\models\Product;

	class HomeController extends Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function index()
		{
			$products = QueryBuilder::table('products')->get();
			$all = Product::all();
			/*foreach ($products as $key => $value) {
				echo $value['id']."<br>";
				echo $value['name']."<br>";
				echo $value['price']."<br>";
				echo "<br>";
			}
			die();*/
			//$this->autoLoadBlade('all_query', ['products' => $products]);
			echo $this->view('views.home.all_query', ['products' => $products, 'abc' => 'abcd']);
		}
		
		public function deleteProduct($id)
		{
			$builder = QueryBuilder::table('products')
					->where('id', '=', $id)
					->delete();
			$this->redirect('http://localhost:8080/www/framework_again/public/product');
		}
		/*--------------   PRODUCTS    ---------------------*/
		public function getInsertProduct()
		{
			echo $this->view('views.home.insert_query', ['abc' => 'abc']);
		}
		public function postInsertProduct()
		{
			$name = $_POST['name'];
			$price = $_POST['price'];
			$description = $_POST['description'];
			$builder = QueryBuilder::table('products')
					->insert(
						['name' => $name, 'price' => $price, 'description' => $description]
					);
			$this->redirect('http://localhost:8080/www/framework_again/public/product');
		}

		public function getUpdateProduct($id)
		{
			$products = QueryBuilder::table('products')
					->find($id);
			$this->render('update_query', ['products' => $products]);
		}
		public function postUpdateProduct($id){
			$builder = QueryBuilder::table('products')
					->where('id', '=', $id)
					->update(
						['name' => $_POST['name'], 'price' => $_POST['price'], 'description' => $_POST['description']]
					);
			$this->redirect('http://localhost:8080/www/framework_again/public/product');
		}
		/*--------------------      ORM       -------------------------*/

		public function index_orm(){
			$all = Product::all();
			$this->render('index', ['bienall' => $all]);
		}

		public function getInsert(){
		    $this->render('insert_orm');
		}
		public function postInsert(){
		    $product = new Product();
			$product->name = $_POST['name'];
			$product->price = $_POST['price'];
			$product->description = $_POST['description'];
			$product->save();
			$this->redirect('http://localhost:8080/www/framework_again/public/all');
		}
		
		public function DeleteById($id){
			$item = Product::deleteById($id);
			$this->redirect('http://localhost:8080/www/framework_again/public/all');
		}

		/*public function getUpdate($id){
			$abc = Product::find($id);
			$this->render('update_orm', ['products' => $abc]);
		}
		public function postUpdate($id){
			$product = Product::find($id);
			
			$product->name = $_POST['name'];
			$product->price = $_POST['price'];
			$product->description = $_POST['description'];
			$product->update();

			//$this->redirect('http://localhost:8080/www/framework_again/public/all');
			//echo "post Update";
		}*/

		public function testFind($id){
			$abc = Product::find($id);
			echo "Dữ liệu in ra: " . "<br/>";
			foreach ($abc as $key => $value) {
				echo $value['id'] .'<br>';
				echo $value['name'] .'<br>';
				echo $value['price'] .'<br>';
				echo $value['description'] .'<br>';
			}
		}
		public function getFirst(){
			$pro = Product::first();
			foreach ($pro as $key => $value) {
				echo $value['name'] .'<br>';
				echo $value['price'] .'<br>';
				echo $value['description'] .'<br>';
			}
		}
		public function getLast(){
			$pro = Product::last();
			foreach ($pro as $key => $value) {
				echo $value['name'] .'<br>';
				echo $value['price'] .'<br>';
				echo $value['description'] .'<br>';
			}
		}
		public function getWhere(){
			$pro = Product::where('name', 'Dep');
			foreach ($pro as $key => $value) {
				echo $value['name'] .'<br>';
				echo $value['price'] .'<br>';
				echo $value['description'] .'<br>';
			}
		}

		public function testCount(){
			$abc = Product::count();
			print_r($abc);
		}
		
		public function deleteAll(){
			$pro = Product::delete();
		}

	}
?>
