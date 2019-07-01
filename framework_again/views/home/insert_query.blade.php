@extends('views.layouts.main')

@section('title')
    Danh sách sản phẩm
@endsection

@section('content')
	<form action="/www/framework_again/public/product/insert" method="POST">
		Tên: <input type="text" name="name" placeholder="Tên sản phẩm...">
		<br><br>
		Giá: <input type="text" name="price" placeholder="Giá...">
		<br><br>
		Miêu tả: <input type="text" name="description" placeholder="Miêu tả...">
		<br><br>
		<input type="submit" value="Tạo mới">
	</form>
@endsection