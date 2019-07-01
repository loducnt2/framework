<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Insert ORM</title>
	<style type="text/css">
		th{
			width: 150px;
		}
	</style>
</head>
<body>
	<form action="/www/framework_again/public/insert_orm" method="POST">
		Tên: <input type="text" name="name" placeholder="Tên sản phẩm...">
		<br><br>
		Giá: <input type="text" name="price" placeholder="Giá...">
		<br><br>
		Miêu tả: <input type="text" name="description" placeholder="Miêu tả...">
		<br><br>
		<input type="submit" value="Tạo mới">
	</form>
</body>
</html>