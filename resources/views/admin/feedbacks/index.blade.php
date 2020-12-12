@extends('layouts.app')

@section('content')
<div ng-app="app" ng-controller="MainCtrl">
	<form action="{{ route('admin.feedback.index') }}" method="get">
		<div class="row">
			<div class="form-group col-sm-4 col-md-4">
				<select name="status" id="status-filter" class="form-control" ng-model="statusFilter">
					<option value="">{{ __('labels.all') }}</option>
					<option value="read">{{ __('labels.read') }}</option>
					<option value="unread">{{ __('labels.unread') }}</option>
				</select>
			</div>
			<div class="form-group col-sm-4 col-md-4">
				<input type="date" class="form-control" name="start_date" id="start-date" ng-model="startDateFilter">
			</div>
			<div class="form-group col-sm-4 col-md-4">
				<input type="date" class="form-control" name="end_date" id="end-date" ng-model="endDateFilter">
			</div>
			<div class="form-group col-sm-2">
				<button class="btn btn-success btn-block" type="submit"><i class="fa fa-filter"></i></button>
			</div>
		</div>
	</form>
	<table id="feedbacks-table" class="table table-striped">
		<thead>
			<tr>
				<th>{{ __('labels.serial_no_short') }}</th>
				<th>{{ __('labels.message') }}</th>
				<th>{{ __('labels.email') }}</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@forelse($feedbacks as $key => $feedback)
			<tr>
				<td>{{ $key + 1}}</td>
				<td>{{ $feedback->message }}</td>
				<td>{{ $feedback->customer->email }}</td>
				<td>
					<a class="btn btn-sm btn-primary" href="#" data-toggle="tooltip" data-placement="left" title="View {{ $feedback->customer->name }}'s all messages"><i class="fa fa-eye"></i></a>
					@if($feedback->status === 'unread')
					<button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="left" title="Unread message"><i class="fa fa-exclamation-triangle"></i></button>
					@endif
				</td>
			</tr>
			@empty
			<tr>
				<td colspan="8">@lang('messages.no_records_found')</td>
			</tr>
			@endforelse
		</tbody>
	</table>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/angular.min.js') }}"></script>
<script>
   const invoiceApp = angular.module('app', []);
   invoiceApp.controller('MainCtrl', function($scope) {
      $scope.statusFilter = '{{ $status }}';
      $scope.startDateFilter = new Date('{{ $start_date }}');
      $scope.endDateFilter = new Date('{{ $end_date }}');
   });
</script>
@endsection