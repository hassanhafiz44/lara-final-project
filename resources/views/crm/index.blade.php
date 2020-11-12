@extends('layouts.app') @section('content')
<div ng-app="crm" ng-controller="CRMCtrl">
    <div class="container">
        <form action="{{ route('admin.crm.index') }}" method="get">
            <div class="row">
                <div class="form-group col-md-3 col-lg-2">
                    <select name="is_active" id="is-active-filter" class="form-control" ng-model="isActiveFilter">
                        <option value="">Customer Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="form-group col-md-3 col-lg-2">
                    <select name="payment_status" id="payment-status-filter" class="form-control" ng-model="paymentStatusFilter">
                        <option value="">Payment Status</option>
                        <option value="paid">Paid</option>
                        <option value="due">Due</option>
                    </select>
                </div>
                <div class="form-group col-md-2 col-lg-1">
                    <button class="btn btn-success btn-block" type="submit">
                        <i class="fa fa-filter"></i>
                    </button>
                </div>
            </div>
        </form>
        <table id="customers-table" class="table table-striped">
            <thead>
                <tr>
                    <th>SL</th>
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
                @foreach($customers as $key => $customer)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->cnic }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->status }}</td>
                    <td>
                        {{-- <a class="btn btn-sm btn-primary" href="{{ route('admin.crm.edit', $customer->id) }}"><i class="fa fa-edit"></i></a> --}}
                        <a class="btn btn-sm btn-secondary" href="{{ route('admin.crm.show', $customer->id) }}"><i class="fa fa-eye"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/angular.min.js') }}"></script>
<script>
    const app = angular.module('crm', []);
    app.controller('CRMCtrl', function($scope) {
        $scope.isActiveFilter = '{{ $is_active }}';
        $scope.paymentStatusFilter = '{{ $payment_status }}';
    });

    $(function() {
        $("#customers-table").DataTable();
    });
</script>
    
@endsection