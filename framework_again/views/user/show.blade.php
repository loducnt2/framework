<?php 

	use app\core\Session;
	use app\core\Registry;
	use app\core\User;

	function __construct()
	{
		$this->config = Registry::getIntance()->config;
		$this->_sessionName = $this->config['session_name'];
	}

	//echo Session::get($this->_sessionName);

	$user = new User();
	if($user->isLogIn()){
		echo "Đã đăng nhập";
		 ?>
		<p><a href="http://localhost:8080/www/framework_again/public/user/logout">Đăng xuất</a></p>
	<?php 
	}else{
	 ?>
		<p>
			Bạn có thể <a href="http://localhost:8080/www/framework_again/public/user/login">Đăng nhập</a> | hoặc 
			<a href="http://localhost:8080/www/framework_again/public/user/register"> Đăng ký</a> tại đây.
		</p>
<?php 
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>All Query Builder</title>
	<style type="text/css">
		th{
			width: 120px;
		}
	</style>
</head>
<body>
	<h1>Danh sách tài khoản</h1>

	<p>
		<a href="http://localhost:8080/www/framework_again/public/user/register">Đăng ký</a> |
		<a href="http://localhost:8080/www/framework_again/public/user/login">Đăng nhập</a>
	</p>
	<p>
		<?php 

			if (Session::exists('seccess')) {
				echo Session::flash('seccess');
			}

		 ?>
	</p>
	<br>

	<table>
		<tr>
			<th> ID </th>
			<th> Username </th>
			<th style="width: 300px;"> Password </th>
			<th>Name</th>
			<th>Tùy chọn</th>
		</tr>
	<?php 
		foreach($users as $value){
			?>
			<tr>
				<td><?php echo $value['id']; ?></td>
				<td><?php echo $value['username']; ?></td>
				<td><?php echo $value['password']; ?></td>
				<td><?php echo $value['name']; ?></td>
				<td>
					<a href="http://localhost:8080/www/framework_again/public/user/update/<?php echo $value['id'];  ?>">Sửa</a> |
					<a href="http://localhost:8080/www/framework_again/public/user/delete/<?php echo $value['id'];  ?>" onclick="return confirm('Bạn chắc muốn xóa tài khoản này?')">Xóa</a>
				</td>
			</tr>
	<?php 
		}
	 ?>
	 </table>
	 <br>
</body>
</html>