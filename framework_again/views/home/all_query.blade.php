@extends('views.layouts.main')

@section('title')
    Danh sách sản phẩm
@endsection

@section('css')
    <style type="text/css">
    	th{
    		padding-right: 70px;
    	}
    </style>
@endsection

@section('content')
	<h1>Danh sách sản phẩm</h1>
	<p><a href="http://localhost:8080/www/framework_again/public/product/insert">Thêm mới sản phẩm</a></p>
	<br>
	<table>
		<tr>
			<th> ID </th>
			<th> Username </th>
			<th> Password </th>
			<th>Name</th>
			<th>Tùy chọn</th>
		</tr>
	
	 @foreach($products as $value)
	 	<tr>
	 		<td>{{ $value['id'] }}</td>
	 		<td>{{ $value['name'] }}</td>
	 		<td>{{ $value['price'] }}</td>
	 		<td>{{ $value['description'] }}</td>
	 		<td>
				<a href="http://localhost:8080/www/framework_again/public/product/update/<?php echo $value['id'];  ?>">Sửa</a> |
				<a href="http://localhost:8080/www/framework_again/public/product/delete/<?php echo $value['id'];  ?>" onclick="return confirm('Bạn chắc muốn xóa tài khoản này?')">Xóa</a>
			</td>
	 	</tr>
	 @endforeach
	</table>

@endsection