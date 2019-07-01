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
		foreach ($products as $key => $value) { 
		 ?>
		<form action="http://localhost:8080/www/framework_again/public/product/update/<?php echo $value['id']; ?>" method="POST">
			Tên: <input type="text" name="name" placeholder="Tên sản phẩm..." value="<?php echo $value['name']; ?>">
			<br><br>
			Giá: <input type="text" name="price" placeholder="Giá..." value="<?php echo $value['price']; ?>">
			<br><br>
			Miêu tả: <input type="text" name="description" placeholder="Miêu tả..." value="<?php echo $value['description']; ?>">
			<br><br>
			<input type="submit" value="Cập nhật">
		</form>
	<?php 
	}
	 ?>
</body>
</html>