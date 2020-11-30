@extends('layouts.app')
@section('content')
<div class="container-fluid" ng-app="salesSummary" ng-controller="salesSummaryCtrl">
    <h2>{{ __('labels.sales_summary') }}</h2>
    <div class="row">
        <div class="col-md-6 mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('labels.current_month_stats') }}</h5>
                    <div class="d-lg-flex justify-content-between flex-wrap">
                        <div class="form-group">
                            <input type="date" class="form-control" name="start_date" id="start-date" ng-model="startDateFilter" disabled>
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" name="end_date" id="end-date" ng-model="endDateFilter" disabled>
                        </div>
                    </div>
                    <table class="table table-striped text-center">
                        <thead>
                            <tr><th>Key</th><th>Value</th></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ __('labels.no_invoices')}}</td>
                                <td>{{ $no_invoices }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('labels.no_cancelled_invoices')}}</td>
                                <td>{{ $no_cancelled_invoices }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('labels.no_delivered_invoices')}}</td>
                                <td>{{ $no_delivered_invoices }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('labels.no_other_invoices')}}</td>
                                <td>{{ $no_other_invoices }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('labels.amount_used')}}</td>
                                <td>{{ convert_to_currency($amount_used) }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('labels.amount_received')}}</td>
                                <td>{{ convert_to_currency($amount_received) }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('labels.amount_to_receive')}}</td>
                                <td>{{ convert_to_currency($amount_to_receive) }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('labels.profit_received')}}</td>
                                <td>{{ convert_to_currency($profit_received) }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('labels.profit_to_receive')}}</td>
                                <td>{{ convert_to_currency($profit_to_receive) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('labels.previous_month_stats') }}</h5>
                    <div class="d-lg-flex justify-content-between flex-wrap">
                        <div class="form-group">
                            <input type="date" class="form-control" name="pre_start_date" id="pre-start-date" ng-model="preStartDateFilter" disabled>
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" name="pre_end_date" id="pre-end-date" ng-model="preEndDateFilter" disabled>
                        </div>
                    </div>
                    <table class="table table-striped text-center">
                        <thead>
                            <tr><th>Key</th><th>Value</th></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ __('labels.no_invoices')}}</td>
                                <td>{{ $pre_no_invoices }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('labels.no_cancelled_invoices')}}</td>
                                <td>{{ $pre_no_cancelled_invoices }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('labels.no_delivered_invoices')}}</td>
                                <td>{{ $pre_no_delivered_invoices }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('labels.no_other_invoices')}}</td>
                                <td>{{ $pre_no_other_invoices }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('labels.amount_used')}}</td>
                                <td>{{ convert_to_currency($pre_amount_used) }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('labels.amount_received')}}</td>
                                <td>{{ convert_to_currency($pre_amount_received) }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('labels.amount_to_receive')}}</td>
                                <td>{{ convert_to_currency($pre_amount_to_receive) }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('labels.profit_received')}}</td>
                                <td>{{ convert_to_currency($pre_profit_received) }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('labels.profit_to_receive')}}</td>
                                <td>{{ convert_to_currency($pre_profit_to_receive) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <h5 class="card-title">{{ __('labels.difference_summary')}}</h5>
                        <thead>
                            <tr><th>Key</th><th>{{ __('labels.difference') }}</th><th>{{ __('labels.remarks') }}</th></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ __('labels.no_invoices') }}</td>
                                <td>{{ $diff_no_invoices }}</td>
                                <td>{{ $no_invoices_remark }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('labels.no_cancelled_invoices')}}</td>
                                <td>{{ $diff_no_cancelled_invoices }}</td>
                                <td>{{ $no_cancelled_invoices_remark }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('labels.no_delivered_invoices')}}</td>
                                <td>{{ $diff_no_delivered_invoices }}</td>
                                <td>{{ $no_delivered_invoices_remark }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('labels.no_other_invoices')}}</td>
                                <td>{{ $diff_no_other_invoices }}</td>
                                <td>{{ $no_other_invoices_remark }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('labels.amount_used')}}</td>
                                <td>{{ convert_to_currency($diff_amount_used) }}</td>
                                <td>{{ $amount_used_remark }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('labels.amount_received')}}</td>
                                <td>{{ convert_to_currency($diff_amount_received) }}</td>
                                <td>{{ $amount_received_remark }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('labels.amount_to_receive')}}</td>
                                <td>{{ convert_to_currency($diff_amount_to_receive) }}</td>
                                <td>{{ $amount_to_receive_remark }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('labels.profit_received')}}</td>
                                <td>{{ convert_to_currency($diff_profit_received) }}</td>
                                <td>{{ $profit_received_remark }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('labels.profit_to_receive')}}</td>
                                <td>{{ convert_to_currency($diff_profit_to_receive) }}</td>
                                <td>{{ $profit_to_receive_remark }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/angular.min.js') }}"></script>
<script>
    const app = angular.module('salesSummary', []);
    app.controller('salesSummaryCtrl', function($scope) {
        $scope.startDateFilter = new Date('{{ $start_date }}');
        $scope.endDateFilter = new Date('{{ $end_date }}');
        $scope.preStartDateFilter = new Date('{{ $pre_start_date }}');
        $scope.preEndDateFilter = new Date('{{ $pre_end_date }}');
    });
</script>
@endsection