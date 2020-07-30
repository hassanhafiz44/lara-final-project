@extends('layouts.app')


@section('content')

<form method="POST" action="{{ route('employees.update', $employee->id) }}">
	@csrf
	<div class="form-group">
		<label for="name">Name</label>
		<input class="form-control" name="name" id="name" value="{{ $employee->name }}"/>
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}"/>
	</div>
	<div class="form-group">
		<label for="phone">Phone</label>
		<input class="form-control" name="phone" id="phone" value="{{ $employee->phone }}" />
	</div>
	<div class="form-group">
		<label for="address">Address</label>
		<input class="form-control" name="address" id="address" value="{{ $employee->address }}" />
	</div>
	<div class="form-group">
		<label for="cnic">CNIC</label>
		<input class="form-control" name="cnic" id="cnic" value="{{ $employee->cnic }}" />
	</div>
	<input class="btn btn-primary" type="submit" name="submit" id="submit" />
	<input type="hidden" name="_method" value="PUT">
</form>
@endsection
