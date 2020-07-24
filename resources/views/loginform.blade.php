<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Log in</title>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}">
</head>
<body>
	<div class="form-bg">
		<div class="container">
			<div class="row">
				<div class="col-md-offset-4 col-md-4 col-sm-offset-6 col-sm-6">
					<form id="login-form" class="form_horizontal " novalidate>
						<div class="icon"><i class="fa fa-user-circle"></i></div>
						<h3 class="title">Login here</h3>
						<div class="form-group">
							<span class="input-icon"><i class="fa fa-user"></i></span>
							<input class="form-control" type="text" name="email" placeholder="Email" required>
						</div>

						<div class="form-group">
							<span class="input-icon"><i class="fa fa-lock"></i></span>
							<input class="form-control" type="password" name="password" placeholder="Password" required>
						</div>
						<button type="submit" name="submit" class="btn signin">Log in</button>
						<ul class="form-option">
							<li><a href="#">Forget password?</a></li>
						</ul>
					</form>
				</div>
			</div>
		</div>
	</div>





	 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    	
    </script>
    <script type="text/javascript" src="{{asset('js/login.js')}}"></script>
</body>
</html>