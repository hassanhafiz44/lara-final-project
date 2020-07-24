<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Dashboard</title>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <style>
    	#menu ul li a:hover{
    		background-color: white;
    		color: black;
    		border-radius: 10px;
    		transition: .5s ease;
    	}
    </style>
</head>
<body>

	<div class="head">
		@section('head')
		<nav class="navbar navbar-expand-md navbar-dark bg-dark">
			<a href="#" class="navbar-brand text-warning">&nbsp; &nbsp;
				<i class="fa fa-laptop mr-1"></i>Bilal computers
			</a>
			<button class="navbar-toggler" data-toggle="collapse" data-target="#menu">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="menu">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a href="dashboard" class="nav-link active">
							<i class="fa fa-dashboard"></i>Dashboard
						</a>
					</li>

					<li class="nav-item">
						<a href="inventory" class="nav-link">
							<i class="fa fa-product"></i>Products
						</a>
					</li>

					<li class="nav-item">
						<a href="orders" class="nav-link">
							<i class="fa fa-product"></i>Orders
						</a>
					</li>

					<li class="nav-item">
						<a href="#" class="nav-link">
							<i class="fa fa-account"></i>Account
						</a>
					</li>

					<li class="nav-item ">
						<a href="#" class="nav-link">
							<i class="fa fa-users"></i>Users
						</a>
					</li>
				</ul>

				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<div class="dropdown">
							<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-id-badge">tech</i>
							</a>
							<div class="dropdown-menu">
								<a href="#" class="dropdown-item">Profile</a>
								<a href="#" data-toggle="modal" data-target="#changepassword" class="dropdown-item">Change password</a>
							</div>
						</div>
					</li>

					<li class="nav-item">
						<a href="login" class="nav-link"><i class="fa fa-sign-out"></i> Logout</a>
					</li>
					
				</ul>
			</div>
		</nav>

		@show
	</div>
	

	<div class="content">
		@section('content')
		@show
	</div>





	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>