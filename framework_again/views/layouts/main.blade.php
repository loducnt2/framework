<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<link rel="stylesheet" type="text/css" href="http://localhost:8080/www/framework_again/public/assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="http://localhost:8080/www/framework_again/public/assets/bootstrap/css/bootstrap-theme.min.css">
	@yield('css')
</head>
<body>
	
	
	<div class="container">
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Title</a>
				</div>
		
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">Link</a></li>
						<li><a href="#">Link</a></li>
					</ul>
					<form class="navbar-form navbar-left" role="search">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Search">
						</div>
						<button type="submit" class="btn btn-default">Submit</button>
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#">Link</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div>
		</nav>

		<div class="row">
			<div class="col-sm-4">
				@include('views.layouts.sidebar')
			</div>
			<div class="col-sm-8">
				<!--  echo $content;  -->
				@yield('content')
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Footer</h3>
			</div>
			<div class="panel-body">
				Copyright 2019
			</div>
		</div>
	</div>
	<script src="http://localhost:8080/www/framework_again/public/assets/bootstrap/js/jquery.js"></script>
	<script src="http://localhost:8080/www/framework_again/public/assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>