@extends('layouts.app')

@section('content')
    <div ng-app="customerApp" ng-controller="CustomerCtrl">
        <div class="row">
            <div class="col-md-6">
                <table class="table">
                    <thead></thead>
                    <tbody>
                        <tr>
                            <td><b>@lang('labels.name')</b></td>
                            <td>{{$customer->name}}</td>
                        </tr>
                        <tr>
                            <td><b>@lang('labels.email')</b></td>
                            <td>{{$customer->email}}</td>
                        </tr>
                        <tr>
                            <td><b>@lang('labels.phone')</b></td>
                            <td>{{$customer->phone}}</td>
                        </tr>
                        <tr>
                            <td><b>@lang('labels.cnic')</b></td>
                            <td>{{$customer->cnic ?? ""}}</td>
                        </tr>
                        <tr>
                            <td><b>@lang('labels.address')</b></td>
                            <td>{{$customer->address}}</td>
                        </tr>
                        <tr>
                            <td><b>@lang('labels.status')</b></td>
                            <td>{{$customer->status}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-6 mb-2">
                        <a href="{{ route('admin.invoices.index', ['customer_id' => $customer->id, 'payment_status' => 'paid']) }}" class="col-12 btn btn-primary">@lang('labels.paid_invoices')</a>
                    </div>
                    <div class="col-6 mb-2">
                        <a href="{{ route('admin.invoices.index', ['customer_id' => $customer->id, 'payment_status' => 'due'])}}" class="col-12 btn btn-primary">@lang('labels.unpaid_invoices')</a>
                    </div>
                    <div class="col-6 mb-2">
                        <button disabled class="col-12 btn btn-primary">@lang('labels.paid'): {{ number_format($amount_paid, 2)}}</button>
                    </div>
                    <div class="col-6 mb-2">
                        <button disabled class="col-12 btn btn-primary">@lang('labels.unpaid'): {{ number_format($amount_due, 2) }}</button>
                    </div>
                    <div ng-if="isActive === 'active'" class="col-12 mb-2">
                        <button ng-click="setInactive()" class="col-12 btn btn-danger">@lang('labels.set_inactive')</button>
                    </div>
                    <div ng-if="isActive === 'inactive'" class="col-12 mb-2">
                        <button ng-click="setActive()" class="col-12 btn btn-success">@lang('labels.set_active')</button>
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
			$("body").LoadingOverlay('show');
            $http.post("{{ route('admin.crm.set.inactive')}}", {id: customerId}).then(function(success) {
                $scope.isActive = success.data.status;
                showNotification(success.data.message, 'Success', 'success');
            }, function(error) {
                showNotification(error.data.message, 'Error', 'error');
            }).finally(function(){
				$("body").LoadingOverlay('hide');
            });
        }
                
        $scope.setActive = function() {
			$("body").LoadingOverlay('show');
            $http.post("{{ route('admin.crm.set.active')}}", {id: customerId}).then(function(success) {
                $scope.isActive = success.data.status;
                showNotification(success.data.message, 'Success', 'success');
            }, function(error) {
                showNotification(error.data.message, 'Error', 'error');
            }).finally(function() {
				$("body").LoadingOverlay('hide');
            })
        }
    });
</script>
@endsection
