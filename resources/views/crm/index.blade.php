@extends('layouts.app') @section('content')
<div>
    <div class="container">
        <table id="customers-table" class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>CNIC</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->cnic }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->status }}</td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.crm.edit', $customer->id) }}"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-sm btn-secondary" href="{{ route('admin.crm.show', $customer->id) }}"><i class="fa fa-eye"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(function() {
        $("#customers-table").DataTable();
    });
</script>
@endsection