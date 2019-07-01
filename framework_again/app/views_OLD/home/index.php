<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>All ORM</title>
	<style type="text/css">
		th{
			width: 150px;
		}
	</style>
</head>
<body>
	<h1>Danh sách sản phẩm</h1>
	<p><a href="http://localhost:8080/www/framework_again/public/insert_orm">Thêm mới sản phẩm ORM</a></p>
	<br>
	<table>
		<tr>
			<th>ID</th>
			<th >Tên sản phẩm</th>
			<th>Giá sản phẩm</th>
			<th>Miêu tả</th>
			<th>Tùy chọn</th>
		</tr>
	<?php 
		foreach($bienall as $value){
			?>
			<tr>
				<td><?php echo $value['id']; ?></td>
				<td><?php echo $value['name']; ?></td>
				<td><?php echo $value['price']; ?></td>
				<td><?php echo $value['description']; ?></td>
				<td>
					<a href="http://localhost:8080/www/framework_again/public/product/update/<?php echo $value['id']; ?>">Sửa</a> |
					<a href="http://localhost:8080/www/framework_again/public/product/delete_orm/<?php echo $value['id'];  ?>" onclick="return confirm('Bạn chắc muốn xóa chứ?')">Xóa</a>
				</td>
			</tr>
	<?php 
		}
	 ?>
	 	<tr>
	 		<td>
	 			<a href="http://localhost:8080/www/framework_again/public/product/delete_all/" onclick="return confirm('Bạn chắc muốn xóa tất cả các sản phẩm hiện có?')">Xóa tất cả</a>
 			</td>
	 	</tr>
	 </table>
</body>
</html>