@extends('layouts.app')


@section('content')
<div class="container pb-4">
<form method="POST" action="{{ route('employees.update', $employee->id) }}">
	@csrf
	<div class="row">
	<div class="form-group col-md-6">
		<label for="name">Name:</label>
		<input class="form-control" name="name" id="name" value="{{ $employee->name }}"/>
	</div>
	<div class="form-group col-md-6">
		<label for="email">Email:</label>
		<input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}"/>
	</div>
	<div class="form-group col-md-12">
		<label for="address">Address:</label>
		<input class="form-control" name="address" id="address" value="{{ $employee->address }}" />
	</div>
	<div class="form-group col-md-4">
		<label for="phone">Phone:</label>
		<input class="form-control" name="phone" id="phone" value="{{ $employee->phone }}" />
	</div>
	<div class="form-group col-md-4">
		<label for="cnic">CNIC:</label>
		<input class="form-control" name="cnic" id="cnic" value="{{ $employee->cnic }}" />
	</div>
</div>
	<input class="btn btn-primary" type="submit" name="submit" id="submit" />
	<input type="hidden" name="_method" value="PUT">
</form>
</div>
</div>
</div>
@endsection
