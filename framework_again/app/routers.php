<?php
	use app\core\Controller;
	use app\core\QueryBuilder;

	Router::any('/sql', function(){
		$builder = QueryBuilder::table('products')->select('name', 'price', 'description')->where('price', '>', 10)
		->get();

		foreach ($builder as $key => $value) {
			echo $value['name'] .'<br>';
		}
		//var_dump($builder);
		/*echo "<pre>";
		var_dump($builder);*/
	});

	Router::any('/user', 'UserController@index');
	Router::get('/user/register', 'UserController@getRegister');
	Router::post('/user/register', 'UserController@postRegister');
	Router::get('/user/update/{id}', 'UserController@getUpdate');
	Router::post('/user/update/{id}', 'UserController@postUpdate');
	Router::any('/user/delete/{id}', 'UserController@delete');
	Router::get('/user/login', 'UserController@getLogin');
	Router::post('/user/login', 'UserController@postLogin');
	Router::get('/user/logout', 'UserController@getLogout');


	Router::any('/product', 'HomeController@index');
	Router::get('/product/insert', 'HomeController@getInsertProduct');
	Router::post('/product/insert', 'HomeController@postInsertProduct');
	Router::get('/product/update/{id}', 'HomeController@getUpdateProduct');
	Router::post('/product/update/{id}', 'HomeController@postUpdateProduct');
	Router::any('/product/delete/{id}', 'HomeController@deleteProduct');

	Router::get('/product_orm', 'HomeController@index_orm');
	Router::get('/insert_orm', 'HomeController@getInsert');
	Router::post('/insert_orm', 'HomeController@postInsert');
	Router::get('/product/update_orm/{id}', 'HomeController@getUpdate');
	Router::post('/product/update_orm/{id}', 'HomeController@postUpdate');
	Router::any('/product/delete_orm/{id}', 'HomeController@DeleteById');
	Router::any('/product/delete_all', 'HomeController@deleteAll');

	Router::any('/product/find/{id}', 'HomeController@testFind');
	Router::any('/product/count', 'HomeController@testCount');
	Router::any('/product/first', 'HomeController@getFirst');
	Router::any('/product/last', 'HomeController@getLast');
	Router::any('/product/where', 'HomeController@getWhere');

	

	Router::any('/home', function(){
		$ct = new Controller;
		$ct->render('index', [
				'name' => 'Minh Duc',
				'age' => 12
			]);
	});
	Router::post('/user', function(){
		echo "day la trang user";
	});
	Router::get('/news', function(){
		echo "day la trang news";
	});
	Router::any('/product', function(){
		echo "day la trang product";
	});
	Router::any('*', function(){
		echo "404 not found";
	});

?>