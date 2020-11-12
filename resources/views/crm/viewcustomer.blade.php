@extends('layouts.app')

@section('content')
    <div class="container" ng-app="customerApp" ng-controller="CustomerCtrl">
        <div class="row">
            <div class="col-md-6">
                <table class="table">
                    <thead></thead>
                    <tbody>
                        <tr>
                            <td><b>Name</b></td>
                            <td>{{$customer->name}}</td>
                        </tr>
                        <tr>
                            <td><b>Email</b></td>
                            <td>{{$customer->email}}</td>
                        </tr>
                        <tr>
                            <td><b>Phone</b></td>
                            <td>{{$customer->phone}}</td>
                        </tr>
                        <tr>
                            <td><b>CNIC</b></td>
                            <td>{{$customer->cnic ?? ""}}</td>
                        </tr>
                        <tr>
                            <td><b>Address</b></td>
                            <td>{{$customer->address}}</td>
                        </tr>
                        <tr>
                            <td><b>Status</b></td>
                            <td>{{$customer->status}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-6 mb-2">
                        <a href="{{ route('admin.invoices.index', ['customer_id' => $customer->id, 'payment_status' => 'paid']) }}" class="col-12 btn btn-primary">Paid Invoices</a>
                    </div>
                    <div class="col-6 mb-2">
                        <a href="{{ route('admin.invoices.index', ['customer_id' => $customer->id, 'payment_status' => 'due'])}}" class="col-12 btn btn-primary">Unpaid Invoices</a>
                    </div>
                    <div class="col-6 mb-2">
                        <button disabled class="col-12 btn btn-primary">Paid: {{ number_format($amount_paid, 2)}}</button>
                    </div>
                    <div class="col-6 mb-2">
                        <button disabled class="col-12 btn btn-primary">Due: {{ number_format($amount_due, 2) }}</button>
                    </div>
                    <div ng-if="isActive === 'active'" class="col-12 mb-2">
                        <button ng-click="setInactive()" class="col-12 btn btn-danger">Set Inactive</button>
                    </div>
                    <div ng-if="isActive === 'inactive'" class="col-12 mb-2">
                        <button ng-click="setActive()" class="col-12 btn btn-success">Set Active</button>
                    </div>
                </div>
            </div>
       </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('js/angular.min.js') }}"></script>
<script>
    const customerApp = angular.module('customerApp', []);

    customerApp.controller('CustomerCtrl', function($scope, $http) {
        const customerId = '{{ $customer->id }}';
        $scope.isActive = '{{ $customer->status }}';

        $scope.setInactive = function() {
            console.log('set inactive');
            $http.post("{{ route('admin.crm.set.inactive')}}", {id: customerId}).then(function(success) {
                $scope.isActive = success.data.status;
            }, function(error) {})
        }
                
        $scope.setActive = function() {
            console.log('set active');
            $http.post("{{ route('admin.crm.set.active')}}", {id: customerId}).then(function(success) {
                $scope.isActive = success.data.status;
            }, function(error) {})
        }
    });
</script>
@endsection
