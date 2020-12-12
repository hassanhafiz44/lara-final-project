@extends('layouts.app')

@section('content')
<div>
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="text-capitalize">{{ $title }}</h2>
        <a href="{{ route('admin.feedback.customer.mark.unread', $customer->id) }}" class="btn btn-danger">{{ __('labels.mark_unread') }}</a>
    </div>
    <div class="card bg-danger mb-2 text-white">
        <div class="card-body">
            <h3 class="card-title">{{ __('labels.customer_info') }}</h3>
            <p class="card-text text-capitalize"><b>{{ __('labels.name') }}</b>: {{ $customer->name }}</p>
            <p class="card-text"><b>{{ __('labels.email') }}</b>: {{ $customer->email }}</p>
            <p class="card-text"><b>{{ __('labels.cnic') }}</b>: {{ $customer->cnic }}</p>
        </div>
    </div>
    <div class="table-responsive">
		<table id="feedbacks-table" class="table table-striped">
			<thead>
				<tr>
					<th>{{ __('labels.serial_no_short') }}</th>
					<th>{{ __('labels.message') }}</th>
					<th>{{ __('labels.received_at') }}</th>
				</tr>
			</thead>
			<tbody>
				@forelse($feedbacks as $key => $feedback)
				<tr>
					<td>{{ $key + 1}}</td>
					<td>{{ $feedback->message }}</td>
					<td>{{ $feedback->created_at }}</td>
				</tr>
				@empty
				<tr>
					<td colspan="8">@lang('messages.no_records_found')</td>
				</tr>
				@endforelse
			</tbody>
		</table>
    </div>
</div>
@endsection