<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Update query</title>
	<style type="text/css">
		th{
			width: 150px;
		}
	</style>
</head>
<body>
	<?php 
		foreach ($users as $key => $value) { 
		 ?>
		<form action="http://localhost:8080/www/framework_again/public/user/update/<?php echo $value['id']; ?>" method="POST">
			Username: <input type="text" name="username" placeholder="Tên sản phẩm..." value="<?php echo $value['username']; ?>">
			<br><br>
			Name: <input type="text" name="name" placeholder="Giá..." value="<?php echo $value['name']; ?>">
			<br><br>
		
			<input type="submit" value="Cập nhật">
		</form>
	<?php 
	}
	 ?>
</body>
</html>