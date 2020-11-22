@extends('layouts.app') @section('content')
<div ng-app="crm" ng-controller="CRMCtrl">
    <div class="container">
        <form action="{{ route('admin.crm.index') }}" method="get">
            <div class="row">
                <div class="form-group col-md-3 col-lg-2">
                    <select name="is_active" id="is-active-filter" class="form-control" ng-model="isActiveFilter">
                        <option value="">@lang('labels.customer_status')</option>
                        <option value="active">@lang('labels.active')</option>
                        <option value="inactive">@lang('labels.inactive')</option>
                    </select>
                </div>
                <div class="form-group col-md-3 col-lg-2">
                    <select name="payment_status" id="payment-status-filter" class="form-control" ng-model="paymentStatusFilter">
                        <option value="">@lang('labels.payment_status')</option>
                        <option value="paid">@lang('labels.paid')</option>
                        <option value="due">@lang('labels.due')</option>
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
                    <th>@lang('labels.serial_no_short')</th>
                    <th>@lang('labels.name')</th>
                    <th>@lang('labels.email')</th>
                    <th>@lang('labels.cnic')</th>
                    <th>@lang('labels.phone')</th>
                    <th>@lang('labels.address')</th>
                    <th>@lang('labels.status')</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if (count($customers) === 0)
                    <tr>
                        <td colspan="7">@lang('messages.no_records_found')</td>
                    </tr>
                @endif
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
                        <a class="btn btn-sm btn-secondary" href="{{ route('admin.crm.show', $customer->id) }}"><i class="fa fa-eye"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $customers->withQueryString()->links() }}
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
</script>
@endsection