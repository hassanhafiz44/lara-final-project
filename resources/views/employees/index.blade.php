@extends('layouts.app') @section('content')
<div>
    <div class="container">
        <a href="{{ route('admin.employees.create') }}" class="float-right btn btn-primary btn-sm">Add</a>
        <table id="employees-table" class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>CNIC</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th></th>
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
                    <td>
                        <a class="btn btn-sm btn-secondary" href="{{ route('employees.edit', $employee->id) }}"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-sm btn-secondary" href="{{ route('employees.show', $employee->id) }}"><i class="fa fa-eye"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(function() {
        $("#employees-table").DataTable();
    });
</script>
@endsection