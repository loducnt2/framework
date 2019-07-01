@extends('views.layouts.main')

@section('title')
    Danh sách sản phẩm
@endsection

@section('content')
	<h1>hello blade</h1>
	
	@if($abc == 'abc')
		{{ $abc }}
	@else
		{{ 'Vào else nhé' }}
	@endif
@endsection