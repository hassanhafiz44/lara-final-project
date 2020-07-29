@extends('layouts.app')


@section('content')

<form method="POST" action="{{ route('employees.store') }}">
	@csrf
	<div class="form-group">
		<label for="name">Name</label>
		<input class="form-control" name="name" id="name"/>
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" name="email" id="email"/>
	</div>
	<div class="form-group">
		<label for="phone">Phone</label>
		<input class="form-control" name="phone" id="phone"/>
	</div>
	<div class="form-group">
		<label for="address">Address</label>
		<input class="form-control" name="address" id="address"/>
	</div>
	<div class="form-group">
		<label for="cnic">CNIC</label>
		<input class="form-control" name="cnic" id="cnic"/>
	</div>
	<input class="btn btn-primary" type="submit" name="submit" id="submit" />
</form>
@endsection
