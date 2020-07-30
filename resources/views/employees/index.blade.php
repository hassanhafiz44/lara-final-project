@extends('layouts.app') @section('content')
<div>
    <div class="container">
        <table id="employees-table" class="table table-striped">
			<thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>CNIC</th>
                <th>Phone</th>
                <th>Address</th>
            </tr>
			</thead>
			<tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->user->email }}</td>
                <td>{{ $employee->cnic }}</td>
                <td>{{ $employee->phone }}</td>
                <td>{{ $employee->address }}</td>
            </tr>
            @endforeach
			</tbody>
        </table>
    </div>
</div>

<script>
	$(function () {
		$("#employees-table").DataTable();
	});
</script>
@endsection
