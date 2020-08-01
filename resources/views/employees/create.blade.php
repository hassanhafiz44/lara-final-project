@extends('layouts.app')


@section('content')
	<div class="container">
		<form method="POST" action="{{ route('employees.store') }}">
	@csrf
	<div class="row">
		<div class="form-group col-md-6">
			<label for="name">Name:</label>
			<input class="form-control" name="name" id="name"/>
		</div>
		<div class="form-group col-md-6">
			<label for="email">Email:</label>
			<input type="email" class="form-control" name="email" id="email"/>
		</div>
		<div class="form-group col-md-6">
			<label for="password">Password:</label>
			<input class="form-control" name="password" id="name"/>
		</div>
		<div class="form-group col-md-6">
			<label for="confirm-password">Confrirm Password::</label>
			<input type="email" class="form-control" name="confirm-password" id="email"/>
		</div>

		<div class="form-group col-lg-12">
			<label for="address">Address:</label>
			<input class="form-control" name="address" id="phone"/>
		</div>
		<div class="form-group col-md-4">
			<label for="phone">Phone:</label>
			<input class="form-control" name="phone" id="address"/>
		</div>
		<div class="form-group col-md-4">
			<label for="cnic">CNIC:</label>
			<input class="form-control" name="cnic" id="cnic"/>
		</div>
	</div>
		<input class="btn btn-primary" type="submit" name="submit" id="submit" />

					
	
@endsection
