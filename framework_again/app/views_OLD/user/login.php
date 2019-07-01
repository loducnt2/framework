<?php 

	use app\core\Token;

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<body>
	<form action="http://localhost:8080/www/framework_again/public/user/login" method="POST">
		Tên đăng nhập: <br>
			<input type="text" name="username" placeholder="Tên đăng nhập...">
		<br><br>
		Mật khẩu:<br>
		 	<input type="password" name="password" placeholder="Mật khẩu ...">

		<br><br>
		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
		<input type="submit" value="Đăng ký">
	</form>
</body>
</html>